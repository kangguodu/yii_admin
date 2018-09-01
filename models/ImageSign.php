<?php

namespace app\models;

use Yii;
use Endroid\QrCode\QrCode;

/**
 * This is the model class for table "image_sign".
 *
 * @property int $id
 * @property string $title 立牌標題
 * @property string $description 立牌描述
 * @property string $cover 立牌封面圖片
 * @property string $image_config 立牌打印配置
 * @property string $start_at 開始日期
 * @property string $end_at 結束日期
 * @property string $created_at 創建時間
 * @property string $price 价格
 */
class ImageSign extends \yii\db\ActiveRecord
{
    public $background;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image_sign';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_at', 'end_at', 'created_at'], 'safe'],
            [['price','can_apply','showat_download'], 'number'],
            [['title'], 'string', 'max' => 150],
            [['title'], 'required'],
            [['description', 'cover'], 'string', 'max' => 255],
            [['image_config'], 'string', 'max' => 1000],
            [['cover'], 'file',  'skipOnEmpty' => true,'extensions'=>'jpg,jpeg, png'],
            [['background'], 'file',  'skipOnEmpty' => true,'extensions'=>'jpg,jpeg, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'imageSign Title'),
            'description' => Yii::t('app', 'Description'),
            'cover' => Yii::t('app', 'Cover'),
            'image_config' => Yii::t('app', 'Image Config'),
            'start_at' => Yii::t('app', 'imageSign Start At'),
            'end_at' => Yii::t('app', 'imageSign End At'),
            'created_at' => Yii::t('app', 'Created At'),
            'price' => Yii::t('app', 'imageSign Price'),
            'background' => Yii::t('app', 'imageSign Background'),
            'can_apply' => Yii::t('app', 'imageSign Can Apply'),
            'showat_download' => Yii::t('app','imageSign Showat Download'),
        ];
    }

    public function setImageConfigAttribute($background)
    {
        $this->image_config = json_encode([
            'background' => $background,
            'qr_code_size' => 503,
            'qr_code_position_x' => 92,
            'qr_code_position_y' => 943,
            'qr_code_rotate' => 0,
            'store_code_font_size' => 50,
            'store_code_position_x' => 0,
            'store_code_position_y' => 0,
            'store_name_font_size' => 12,
            'store_name_position_x' => 0,
            'store_name_position_y' => 0,
            'store_code_font' => '/upload/download/wryh.ttf',
            'logo_path' => '/upload/download/logo.png',
            'logo_size' => 200,
        ]);
    }

    /**
     *
     * @param $store_id
     * @param $id
     * @return array
     */
    public function getDownloadAreaDetail($store_id,$id){
        $imageSign = self::findOne($id);
        if($imageSign != null){
            $start_date = strtotime($imageSign->start_at);
            $end_date = strtotime($imageSign->end_at);
            $time = time();
            if($time > $start_date && $time > $end_date){
                return false;
            }
            $config = json_decode($imageSign->image_config,TRUE);
            $publicPath = \Yii::getAlias('@meme_public');

            $logoPath = $publicPath.$config['logo_path'];
            $store = Store::findOne($store_id);
            if($store){
                $code = $store->code;
                $storeName = $store->name;
                //$imageSign = $imageSign->toArray();
                $targetImagePath = 'image_sign/tv2'.md5($store_id.$imageSign->id).'.png';
                if(!file_exists($publicPath.'/upload/'.$targetImagePath)){
                    if(!is_dir($publicPath.'/upload/image_sign')){
                        mkdir($publicPath.'/upload/image_sign');
                        chmod($publicPath.'/upload/image_sign',777);
                    }
                    try{
                        $qrCode = new QrCode();
                        $qrCode->setEncoding('UTF-8');
                        $qrCode->setText('https://office.techrare.com/memecoins-register-h5/#/register/'.$code);
                        $qrCode->setSize(intval($config['qr_code_size']));
                        $qrCode->setMargin(0);
                        $qrCode->setErrorCorrectionLevel('high');
                        $qrCode->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0));
                        $qrCode->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0));
                        //$qrCode->setRoundBlockSize(false);
                        if(file_exists($logoPath)){
                            $qrCode->setLogoPath($logoPath);
                        }
                        
                        $qrCode->setLogoWidth(intval($config['logo_size']));
                        $qrCodePath = $publicPath.'/upload/temp/t'.$store_id.date('ymdHis').'.png';
                        $qrCode->writeFile($qrCodePath);
                        $backendimage = $publicPath.$config['background'];

                        if(file_exists($backendimage)){

                            $backend_image_create = imagecreatefrompng($backendimage);
                            $qrcode_image_create = imagecreatefrompng($qrCodePath);

                            if(isset($config['qr_code_rotate']) && intval($config['qr_code_rotate']) > 0){
                                $transparency = imagecolorallocatealpha( $qrcode_image_create,255,255,255,0 );
                                $rotated = imagerotate( $qrcode_image_create, $config['qr_code_rotate'], $transparency, 1);
                                $background = imagecolorallocate($rotated , 255,  255,  255);
                                imagecolortransparent($rotated,$background);
                                imagealphablending( $rotated, false );
                                imagesavealpha( $rotated, true );
                                $rwidth=imagesx($rotated);
                                $rheight=imagesy($rotated);
                                imagecopymerge(
                                    $backend_image_create,
                                    $rotated,
                                    $config['qr_code_position_x'],
                                    $config['qr_code_position_y'],
                                    0,
                                    0,
                                    $rwidth,
                                    $rheight,
                                    100
                                );
                            }else{
                                imagecopymerge(
                                    $backend_image_create,
                                    $qrcode_image_create,
                                    $config['qr_code_position_x'],
                                    $config['qr_code_position_y'],
                                    0,
                                    0,
                                    $config['qr_code_size'],
                                    $config['qr_code_size'],
                                    100
                                );

                                if(isset($config['number']) && $config['number'] == 4){
                                    imagecopymerge(
                                        $backend_image_create,
                                        $qrcode_image_create,
                                        $config['qr_code_position_x']+1185,
                                        $config['qr_code_position_y'],
                                        0,
                                        0,
                                        $config['qr_code_size'],
                                        $config['qr_code_size'],
                                        100
                                    );
                                    imagecopymerge(
                                        $backend_image_create,
                                        $qrcode_image_create,
                                        $config['qr_code_position_x'],
                                        $config['qr_code_position_y']+1750,
                                        0,
                                        0,
                                        $config['qr_code_size'],
                                        $config['qr_code_size'],
                                        100
                                    );
                                    imagecopymerge(
                                        $backend_image_create,
                                        $qrcode_image_create,
                                        $config['qr_code_position_x']+1185,
                                        $config['qr_code_position_y']+1750,
                                        0,
                                        0,
                                        $config['qr_code_size'],
                                        $config['qr_code_size'],
                                        100
                                    );
                                }
                            }

                            $fontPath = $publicPath.$config['store_code_font'];
                            if($config['store_code_position_x'] > 0){

                                imagettftext(
                                    $backend_image_create,
                                    $config['store_code_font_size'],
                                    0,
                                    $config['store_code_position_x'],
                                    $config['store_code_position_y'],
                                    20,
                                    $fontPath,
                                    $code
                                );
                            }
                            if($config['store_name_position_x'] > 0){
                                imagettftext(
                                    $backend_image_create,
                                    $config['store_name_font_size'],
                                    0,
                                    $config['store_name_position_x'],
                                    $config['store_name_position_y'],
                                    20,
                                    $fontPath,
                                    $storeName
                                );
                            }
                            $merge = '/upload/'.$targetImagePath;
                            imagepng($backend_image_create,$publicPath.$merge);
                            imagedestroy($backend_image_create );
                            imagedestroy($qrcode_image_create );
                            if(isset($rotated)){
                                imagedestroy($rotated);
                            }
                            unlink($qrCodePath);
                        }
                    }catch (\Exception $e){
                        \Yii::error("generate download image detail fail:".$e->getMessage().' '.$e->getLine());
                         return false;
                    }
                }
                return true;
            }
        }
       return true;
    }
}

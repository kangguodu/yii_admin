<?php

namespace App\Services;
use yii\helpers\Html;

class ImageToolService
{

	static private $host = 'http://localhost/memecoinsapi/public';
    static private $imageType = [
        'banner' => 'banner/',
        'store' => 'store/',
        'transfer' => 'transfer/',
        'activity' => 'activity/',
    ];

    static $defaultImage = [
        'banner' => 'banner/banner.jpg', //店铺默认Logo
        'download' => 'download/example1.png',
        'image_sign' => 'download/example1.png',//立牌
        'member' => 'notice_icon.png',//会员头像
        'store' => 'notice_icon.png',
        'transfer' => 'notice_icon.png',
    ];

    public static function getViewImageLink($image,$altText = ''){
        $image_path = self::getUrlWithDefaultPath($image);
        return Html::a(Html::img($image_path,['alt' => $altText,'style' => 'max-height:40px;']),$image_path,[
            'class' => 'index-fancybox'
        ]);
    }

    public static function getDefaultImageByType($type){
        return isset(self::$defaultImage[$type])?self::$defaultImage[$type]:'';
    }

    public static function getImageTypeFolder($type){
        return isset(self::$imageType[$type])?self::$imageType[$type]:'other/';
    }

    public static function getImageTypes(){
        return self::$imageType;
    }


    public static function getUrlWithDefaultPath($imagePath,$type = 'store', $default = ''){
        $httpIndex = strpos($imagePath,'http');
        if($httpIndex !== false){
            return $imagePath;
        }
        if(empty($imagePath)){
            $imagePath = self::getDefaultImageByType($type);
            if(empty($imagePath) && !empty($default)){
                $imagePath = $default;
            }else if(empty($imagePath) && empty($default)){
            	$imagePath = self::getDefaultImageByType($type);
            }
        }
        $uploadIndex = strpos($imagePath,'upload');
        if($uploadIndex === 0){
            $imagePath = str_replace('upload/','',$imagePath);
        }
        $uploadIndex2 = strpos($imagePath,'/upload/');
        if($uploadIndex2 === 0){
            $imagePath = str_replace('/upload/','',$imagePath);
        }
        //var_dump(self::$host.'/upload/'.$imagePath)."<br/>";
        return empty($imagePath)?'':self::$host.'/upload/'.$imagePath;
    }

    public static function getImageNameFromTempUrl($imageUrl){
        $tempIndex = strpos($imageUrl,'temp/');
        $uploadIndex = strpos($imageUrl,'upload/');
        if($tempIndex){
            $imageName = mb_substr($imageUrl,$tempIndex + 5);
            return $imageName;
        }else if($uploadIndex){
            $imageName = mb_substr($imageUrl,$uploadIndex + 7);
            return $imageName;
        }
        return $imageUrl;
    }


    public static function getTargetFileName($type,$fileName){
        $targetDir = isset(self::$imageType[$type])?self::$imageType[$type]:'other/';
        $dateFolder = '';
        return $targetDir.$dateFolder.$fileName;
    }



    public static function removeOldImage($path){
        try{
            if(empty($path)){
                return true;
            }
            $public_path = \Yii::getAlias('@meme_public'); 
            $imagePath = $public_path.'/upload/'.$path;
            if(file_exists($imagePath)){
                unlink($imagePath);
            }
        }catch (\Exception $e){
            \Yii::error("删除旧图片失败: ".$e->getFile().' '.$e->getLine().' '.$e->getCode().' '.$e->getMessage());
            return false;
        }
        return true;
    }
}

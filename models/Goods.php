<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property int $id
 * @property int $store_id 店铺id
 * @property string $goods_name 食品名称
 * @property string $image 图片
 * @property int $price 原价
 * @property int $prom_price 优惠价
 * @property int $created_at
 */
class Goods extends \yii\db\ActiveRecord
{
    private $goods_limit = 3;

    public $store_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id','goods_name','price'], 'required'],
            [['store_id', 'price', 'prom_price', 'created_at'], 'integer'],
            [['goods_name', 'image'], 'string', 'max' => 255],
            [['image'], 'image',  'skipOnEmpty' => true,'extensions'=>'jpg,jpeg, png','minWidth' => 400,'maxWidth' => 400, 'minHeight' => 400, 'maxHeight' => 400],
            ['store_id', 'checkStoreGoodsLimit'],
        ];
    }

    function checkStoreGoodsLimit($attribute,$params){

        $id = intval($this->id);
        $store_id = $this->store_id;
        $count = self::find()->where(['store_id' => $store_id])->count();
        if($id > 0 ){
            $currentData = self::findOne($id);
            if($currentData->store_id == $this->store_id){
                $count = $count - 1;
            }
        }

        if($count >= $this->goods_limit){
            $this->addError($attribute,sprintf("該店鋪已有%s份特色菜了",$this->goods_limit));
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'store_id' => Yii::t('app', 'Store ID'),
            'goods_name' => Yii::t('app', 'Goods Name'),
            'image' => Yii::t('app', 'Image'),
            'price' => Yii::t('app', 'Price'),
            'prom_price' => Yii::t('app', 'Prom Price'),
            'created_at' => Yii::t('app', 'Created At'),
            'store_name' => Yii::t('app', 'Store Name'),
        ];
    }
}

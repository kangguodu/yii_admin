<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store_banner".
 *
 * @property int $id
 * @property int $store_id 店鋪id
 * @property string $image 图片
 * @property int $rank 权重
 */
class StoreBanner extends \yii\db\ActiveRecord
{
    public $store_name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['store_id'],'required'],
            [['store_id', 'rank'], 'integer'],
            [['image'], 'image','skipOnEmpty' => true, 'extensions'=>'jpg,jpeg, png','minWidth' => 500,'maxWidth' => 500, 'minHeight' => 300, 'maxHeight' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'store_id' => Yii::t('app', 'Store ID'),
            'image' => Yii::t('app', 'Image'),
            'rank' => Yii::t('app', 'Rank'),
            'store_name' => Yii::t('app', 'Store Name'),
        ];
    }
}

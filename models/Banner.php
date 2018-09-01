<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property int $id
 * @property int $type 活動類型 1:活動 2:店鋪
 * @property int $store_id type爲2，需要填入店鋪編號
 * @property int $region_id
 * @property string $image_url 图片
 * @property int $use_type 首頁大banner為1,小banner為2
 * @property string $url 鏈接
 * @property string $app_page App内页页面
 * @property int $rank 排序
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_url', 'url', 'app_page'], 'string', 'max' => 255],
            [['type', 'store_id', 'region_id', 'use_type', 'rank'], 'integer'],
            [['type','use_type'],'required'],
            ['url', 'required', 'when' => function($model) {
                    return $model->type == 1;
             }, 'enableClientValidation' => false],
            ['store_id', 'required', 'when' => function($model) {
                    return $model->type == 2;
             }, 'enableClientValidation' => false],
            ['app_page', 'required', 'when' => function($model) {
                    return $model->type == 4;
             }, 'enableClientValidation' => false],
            [['image_url'], 'image',  'skipOnEmpty' => true,'extensions'=>'jpg,jpeg, png','minWidth' => 400,'maxWidth' => 500, 'minHeight' => 200, 'maxHeight' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'store_id' => Yii::t('app', 'Store ID'),
            'region_id' => Yii::t('app', 'Region ID'),
            'image_url' => Yii::t('app', 'Image Url'),
            'use_type' => Yii::t('app', 'Banner Use Type'),
            'url' => Yii::t('app', 'Url'),
            'app_page' => Yii::t('app', 'App Page'),
            'rank' => Yii::t('app', 'Rank'), 
        ];
    }
}

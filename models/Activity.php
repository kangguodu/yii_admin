<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property string $title
 * @property string $content 内容，1文本2鏈接
 * @property string $description 描述
 * @property int $type 活动类型 1:文章 2 活动
 * @property string $created_at 活动創建时间
 * @property string $created_by
 * @property string $start_at 活動開始時間
 * @property string $expire_at 结束时间
 * @property int $checked 發佈
 * @property int $platform_type 平台类型 1 普通 2 商家 3 网红
 * @property string $posters_pictures 图片
 * @property int $discount 活动折数/回赠
 * @property string $url 鏈接
 * @property string $show_time 推出時間
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','type','platform_type','show_time','start_at','expire_at'],'required'],
            [['content'], 'string'],
            [['created_at', 'start_at', 'expire_at', 'show_time','discount','platform_type','type','checked'], 'safe'],
            [['show_time'], 'required'],
            [['title', 'description', 'url'], 'string', 'max' => 255],
            // [['created_by'], 'string', 'max' => 30],
            ['content', 'required', 'when' => function($model) {
                    return $model->type == 1;
             }, 'enableClientValidation' => false],
            ['url', 'required', 'when' => function($model) {
                    return $model->type == 2;
             }, 'enableClientValidation' => false],
            [['posters_pictures'], 'file',  'skipOnEmpty' => true,'extensions'=>'jpg,jpeg, png'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Activity Title'),
            'content' => Yii::t('app', 'Activity Content'),
            'description' => Yii::t('app', 'Description'),
            'type' => Yii::t('app', 'Type'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'start_at' => Yii::t('app', 'Start At'),
            'expire_at' => Yii::t('app', 'Expire At'),
            'checked' => Yii::t('app', 'Checked'),
            'platform_type' => Yii::t('app', 'Platform Type'),
            'posters_pictures' => Yii::t('app', 'Posters Pictures'),
            'discount' => Yii::t('app', 'Discount'),
            'url' => Yii::t('app', 'Url'),
            'show_time' => Yii::t('app', 'Show Time'),
        ];
    }
}

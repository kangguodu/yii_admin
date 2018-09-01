<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notice".
 *
 * @property int $id
 * @property string $title 主題，標題
 * @property string $description 簡短描述
 * @property int $type_id 類型，1主題活動2錢包更新3系統更新
 * @property string $content 內容
 * @property string $icon 圖片
 * @property string $url 鏈接
 * @property int $point_id 指向活動或訂單獲取其他id
 * @property int $member_id 會員id
 * @property string $created_at
 * @property string $updated_at
 */
class Notice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','type_id', 'updated_at'], 'required'],
            [['content'], 'string'],
            [['point_id', 'member_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'description', 'icon', 'url'], 'string', 'max' => 255],
            [['type_id'], 'string', 'max' => 2],
            [['icon'], 'file',  'skipOnEmpty' => true,'extensions'=>'jpg,jpeg, png'],
            ['content', 'required', 'when' => function($model) {
                return $model->type_id == 3;
            }, 'enableClientValidation' => false],
            ['point_id', 'required', 'when' => function($model) {
                return $model->type_id == 1;
            }, 'enableClientValidation' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'type_id' => Yii::t('app', 'Type ID'),
            'content' => Yii::t('app', 'Content'),
            'icon' => Yii::t('app', 'Icon'),
            'url' => Yii::t('app', 'Url'),
            'point_id' => Yii::t('app', 'Point ID'),
            'member_id' => Yii::t('app', 'Member ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}

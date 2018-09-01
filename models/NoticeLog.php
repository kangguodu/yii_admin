<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notice_log".
 *
 * @property int $id
 * @property int $platform_type 2：店铺，3：网红
 * @property string $title
 * @property string $description
 * @property int $type 推送类型：1系统，2活动
 * @property string $content
 * @property string $url
 * @property int $point_id
 * @property string $created_at
 * @property string $updated_at
 */
class NoticeLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notice_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['platform_type', 'title', 'type'], 'required'],
            [['point_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['platform_type', 'type'], 'string', 'max' => 4],
            [['title', 'description', 'content', 'url'], 'string', 'max' => 255],
            ['content', 'required', 'when' => function($model) {
                return $model->type == 1;
            }, 'enableClientValidation' => false],
            ['point_id', 'required', 'when' => function($model) {
                return $model->type == 2;
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
            'platform_type' => Yii::t('app', 'Platform Type'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'type' => Yii::t('app', 'Type'),
            'content' => Yii::t('app', 'Content'),
            'url' => Yii::t('app', 'Url'),
            'point_id' => Yii::t('app', 'Point ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}

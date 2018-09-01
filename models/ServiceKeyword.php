<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_keyword".
 *
 * @property int $id
 * @property string $keyword
 * @property string $content
 * @property string $type
 */
class ServiceKeyword extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_keyword';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['keyword', 'content'], 'required'],
            [['content'], 'string'],
            [['keyword'],'unique'],
            [['keyword'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'keyword' => Yii::t('app', 'Service Keyword'),
            'content' => Yii::t('app', 'Service Content'),
            'type' => Yii::t('app', 'Type'),
        ];
    }
}

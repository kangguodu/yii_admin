<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "keyword".
 *
 * @property int $id
 * @property string $hot_word 關鍵詞
 * @property int $number 搜索次數
 */
class Keyword extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'keyword';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hot_word', 'number'], 'required'],
            [['number'], 'integer'],
            [['hot_word'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hot_word' => Yii::t('app', 'Hot Word'),
            'number' => Yii::t('app', 'Keyword Number'),
        ];
    }
}

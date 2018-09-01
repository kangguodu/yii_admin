<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hot_word".
 *
 * @property int $id
 * @property string $hot_word 热搜词
 * @property int $number 搜索次数
 */
class HotWord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hot_word';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number'], 'integer'],
            [['hot_word'], 'string', 'max' => 255],
            [['hot_word'],'unique'],
            [['hot_word'],'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hot_word' => Yii::t('app', 'Hot Word'),
            'number' => Yii::t('app', 'Hot Word Search Count'),
        ];
    }
}

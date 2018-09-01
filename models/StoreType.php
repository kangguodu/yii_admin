<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store_type".
 *
 * @property int $id
 * @property string $name 名稱
 * @property int $published 发布
 */
class StoreType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','published'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['published'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Store Type Name'),
            'published' => Yii::t('app', 'Published'),
        ];
    }
}

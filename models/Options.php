<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property int $id
 * @property string $option_name
 * @property string $option_value
 * @property int $is_autoload
 */
class Options extends \yii\db\ActiveRecord
{
    const CUNSTOM_AUTOLOAD_NO = 0;
    const CUSTOM_AUTOLOAD_YES = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%options}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['option_name'], 'required'],
            [['option_name', 'option_value'], 'string', 'max' => 255],
            [['option_name'], 'unique'],
            [['option_value'], 'string'],
            [['is_autoload'], 'string', 'max' => 1],
            [['is_autoload'], 'default', 'value' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'option_name' => Yii::t('app', 'Option Name'),
            'option_value' => Yii::t('app', 'Option Value'),
            'is_autoload' => Yii::t('app', 'Is Autoload'),
        ];
    }

    /**
     * @return array
     */
    public function getNames()
    {
        return array_keys($this->attributeLabels());
    }
}

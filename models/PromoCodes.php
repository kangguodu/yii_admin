<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "promo_codes".
 *
 * @property int $id
 * @property string $code
 * @property int $used
 */
class PromoCodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promo_codes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'used'], 'required'],
            [['used'], 'integer'],
            [['code'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'used' => Yii::t('app', 'Used'),
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "image_sign_apply_detail".
 *
 * @property int $id
 * @property int $image_sign_id
 * @property int $quantity 数量
 * @property int $apply_id
 * @property string $amount 价格
 */
class ImageSignApplyDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image_sign_apply_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_sign_id', 'apply_id'], 'required'],
            [['image_sign_id', 'quantity', 'apply_id'], 'integer'],
            [['amount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image_sign_id' => Yii::t('app', 'Image Sign ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'apply_id' => Yii::t('app', 'Apply ID'),
            'amount' => Yii::t('app', 'Amount'),
        ];
    }
}

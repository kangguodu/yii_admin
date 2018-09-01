<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "image_sign_apply".
 *
 * @property int $id
 * @property int $store_id 店铺id
 * @property string $other_remark
 * @property string $created_at
 * @property string $updated_at
 * @property int $status 处理状态 1:待处理 2: 处理中 3 处理完成 4 取消
 * @property string $cancel_reason 取消原因
 * @property string $address 寄送地址
 * @property string $imagesign_carriage 运费
 */
class ImageSignApply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image_sign_apply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['imagesign_carriage'], 'number'],
            [['other_remark'], 'string', 'max' => 500],
            [['status'], 'string', 'max' => 4],
            [['cancel_reason', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'store_id' => Yii::t('app', 'Store ID'),
            'other_remark' => Yii::t('app', 'Other Remark'),
            'created_at' => Yii::t('app', 'ImageSignApply Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'ImageSignApply Status'),
            'cancel_reason' => Yii::t('app', 'Cancel Reason'),
            'address' => Yii::t('app', 'Address'),
            'imagesign_carriage' => Yii::t('app', 'Imagesign Carriage'),
        ];
    }

}

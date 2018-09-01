<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store_transfer".
 *
 * @property int $id
 * @property int $store_id 店铺id
 * @property string $transfer_date 转账日期
 * @property string $accounts_no 银行卡末五位
 * @property string $amount 汇款金额
 * @property string $attachment 附件
 * @property string $status 处理状态
 * @property int $created_by 申请人
 * @property string $created_at
 * @property string $updated_at 更新时间
 * @property int $updated_by 后台审批用户id
 */
class StoreTransfer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store_transfer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'transfer_date', 'accounts_no', 'created_at'], 'required'],
            [['store_id', 'created_by', 'updated_by'], 'integer'],
            [['transfer_date', 'created_at', 'updated_at'], 'safe'],
            [['amount'], 'number'],
            [['status'], 'string'],
            [['accounts_no'], 'string', 'max' => 30],
            [['attachment'], 'string', 'max' => 255],
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
            'transfer_date' => Yii::t('app', 'Transfer Date'),
            'accounts_no' => Yii::t('app', 'Accounts No'),
            'amount' => Yii::t('app', 'Amount'),
            'attachment' => Yii::t('app', 'Attachment'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'ST Created By'),
            'created_at' => Yii::t('app', 'ST Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}

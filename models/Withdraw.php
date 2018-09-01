<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "withdrawl".
 *
 * @property int $id
 * @property int $store_id 店鋪編號
 * @property int $uid 店家id或者網紅id
 * @property int $type 類型，1店家提現2網紅提現
 * @property float $amount 提現金額
 * @property string $service_charge 手续费
 * @property int $status 提現狀態 0:提现中，1完成，2失败
 * @property string $remark 提現備註
 * @property string $bank_name 銀行名稱
 * @property string $receiver_name 收款人
 * @property string $bank_account 收款银行账户
 * @property string $bank_phone 收款人电话
 * @property string $handle_note 處理備註
 * @property string $handle_date 处理時間
 * @property string $created_at 申請時間
 */
class Withdraw extends \yii\db\ActiveRecord
{
    public $store_name;
    public $nickname;
    public $object_id;
    public $object_name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'withdrawl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'uid','type', 'status'], 'integer'],
            [['amount', 'service_charge'], 'number'],
            [['bank_name', 'created_at'], 'required'],
            [['handle_date', 'created_at'], 'safe'],
            [['remark', 'handle_note'], 'string', 'max' => 500],
            [['bank_name'], 'string', 'max' => 255],
            [['receiver_name', 'bank_account', 'bank_phone'], 'string', 'max' => 50],
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
            'uid' => Yii::t('app', 'Uid'),
            'type' => Yii::t('app', 'Type'),
            'amount' => Yii::t('app', 'Withdraw Amount'),
            'service_charge' => Yii::t('app', 'Service Charge'),
            'status' => Yii::t('app', 'Status'),
            'remark' => Yii::t('app', 'Withdraw Remark'),
            'bank_name' => Yii::t('app', 'Bank Name'),
            'receiver_name' => Yii::t('app', 'Receiver Name'),
            'bank_account' => Yii::t('app', 'Bank Account'),
            'bank_phone' => Yii::t('app', 'Bank Phone'),
            'handle_note' => Yii::t('app', 'Handle Note'),
            'handle_date' => Yii::t('app', 'Handle Date'),
            'created_at' => Yii::t('app', 'Created At'),
            'object_id' => Yii::t('app', 'Withdraw ID'),
            'object_name' => Yii::t('app', 'Withdraw Name'),
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member_credits_log".
 *
 * @property int $id
 * @property int $type 類型 1:收入 2;:支出 3:
 * @property string $trade_type
 * @property string $date 日期
 * @property string $log_date 時間
 * @property string $log_no
 * @property string $amount 金額
 * @property string $balance 異動前餘額
 * @property int $status 狀態
 * @property string $remark
 * @property int $member_id
 * @property int $order_id
 * @property string $order_sn
 */
class MemberCreditsLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member_credits_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'date', 'log_date'], 'required'],
            [['type', 'status', 'member_id', 'order_id'], 'integer'],
            [['date', 'log_date'], 'safe'],
            [['amount', 'balance'], 'number'],
            [['trade_type'], 'string', 'max' => 20],
            [['log_no'], 'string', 'max' => 100],
            [['remark'], 'string', 'max' => 191],
            [['order_sn'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'trade_type' => 'Trade Type',
            'date' => 'Date',
            'log_date' => 'Log Date',
            'log_no' => 'Log No',
            'amount' => 'Amount',
            'balance' => 'Balance',
            'status' => 'Status',
            'remark' => 'Remark',
            'member_id' => 'Member ID',
            'order_id' => 'Order ID',
            'order_sn' => 'Order Sn',
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rebate_orders".
 *
 * @property int $id
 * @property int $order_id 訂單編號
 * @property int $member_id 會員編號
 * @property string $cycle_point 返利積分
 * @property string $cycle_start 返利開始時間
 * @property string $cycle_end 返利結束時間
 * @property string $interest_remain 剩餘沒返的金額
 * @property int $cycle_days_remain 返利天數剩餘
 * @property string $cycle_status 狀態 0 取消 1 待返利 2 返利中 3 返利完成
 * @property string $interest_ever 每天返利金額
 * @property int $cycle_days
 */
class RebateOrders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rebate_orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'member_id', 'cycle_days_remain', 'cycle_days'], 'integer'],
            [['cycle_point', 'interest_remain', 'interest_ever'], 'number'],
            [['cycle_start', 'cycle_end', 'cycle_days_remain'], 'required'],
            [['cycle_start', 'cycle_end'], 'safe'],
            [['cycle_status'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'member_id' => Yii::t('app', 'Member ID'),
            'cycle_point' => Yii::t('app', 'Cycle Point'),
            'cycle_start' => Yii::t('app', 'Cycle Start'),
            'cycle_end' => Yii::t('app', 'Cycle End'),
            'interest_remain' => Yii::t('app', 'Interest Remain'),
            'cycle_days_remain' => Yii::t('app', 'Cycle Days Remain'),
            'cycle_status' => Yii::t('app', 'Cycle Status'),
            'interest_ever' => Yii::t('app', 'Interest Ever'),
            'cycle_days' => Yii::t('app', 'Cycle Days'),
        ];
    }
}

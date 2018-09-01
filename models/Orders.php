<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $order_no 序号
 * @property string $order_sn 订单序号
 * @property string $month 月份2018-07
 * @property string $date 下單日期
 * @property int $store_id 店鋪id
 * @property string $store_name 店铺名称
 * @property int $member_id 用家id
 * @property int $amount 消费总金額
 * @property string $credits 积分折扣
 * @property int $coupons_id 优惠券id
 * @property string $coupons_money 優惠券金額
 * @property string $prate 平臺回贈
 * @property string $mfixedrate 會員固定回贈
 * @property string $mrate 會員回贈
 * @property string $promoreate 推廣回贈
 * @property int $status 狀態,--1已取消，0待處理,1已完成，2退货
 * @property string $checkout_at 处理时间
 * @property int $checkout_user_id 结账人员
 * @property string $refund_at 退貨時間
 * @property int $refund_user_id 退货人员
 * @property string $created_at 下單時間
 * @property string $updated_at 更新時間
 * @property int $updated_by
 * @property int $number 今日第幾單
 * @property int $is_evaluate 是否已評價1是0否
 */
class Orders extends \yii\db\ActiveRecord
{

    public $nickname;
    public $username;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_no', 'date', 'store_id', 'store_name', 'member_id'], 'required'],
            [['date', 'checkout_at', 'refund_at', 'created_at', 'updated_at'], 'safe'],
            [['store_id', 'member_id', 'amount', 'coupons_id', 'status', 'checkout_user_id', 'refund_user_id', 'updated_by', 'number', 'is_evaluate'], 'integer'],
            [['credits', 'coupons_money', 'prate', 'mfixedrate', 'mrate', 'promoreate'], 'number'],
            [['order_no', 'store_name'], 'string', 'max' => 255],
            [['order_sn'], 'string', 'max' => 20],
            [['month'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_no' => Yii::t('app', 'Order No'),
            'order_sn' => Yii::t('app', 'Order Sn'),
            'month' => Yii::t('app', 'Month'),
            'date' => Yii::t('app', 'Date'),
            'store_id' => Yii::t('app', 'Store ID'),
            'store_name' => Yii::t('app', 'Store Name'),
            'member_id' => Yii::t('app', 'Member ID'),
            'amount' => Yii::t('app', 'Amount'),
            'credits' => Yii::t('app', 'Credits'),
            'coupons_id' => Yii::t('app', 'Coupons ID'),
            'coupons_money' => Yii::t('app', 'Coupons Money'),
            'prate' => Yii::t('app', 'Prate'),
            'mfixedrate' => Yii::t('app', 'Mfixedrate'),
            'mrate' => Yii::t('app', 'Mrate'),
            'promoreate' => Yii::t('app', 'Promoreate'),
            'status' => Yii::t('app', 'Status'),
            'checkout_at' => Yii::t('app', 'Checkout At'),
            'checkout_user_id' => Yii::t('app', 'Checkout User ID'),
            'refund_at' => Yii::t('app', 'Refund At'),
            'refund_user_id' => Yii::t('app', 'Refund User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'number' => Yii::t('app', 'Number'),
            'is_evaluate' => Yii::t('app', 'Is Evaluate'),
            'username' => Yii::t('app', 'Username'),
            'nickname' => Yii::t('app', 'Member Nickname'),
        ];
    }
}

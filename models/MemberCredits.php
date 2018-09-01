<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member_credits".
 *
 * @property int $id
 * @property int $member_id 用戶id
 * @property float $total_credits 總積分
 * @property float $grand_total_credits 累計返利
 * @property float $wait_total_credits 待返利
 * @property float $freeze_credits 冻结金额
 * @property float $promo_credits 推廣積分
 * @property float $promo_credits_total 獲得的所有積分
 */
class MemberCredits extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member_credits';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member_id'], 'required'],
            [['member_id'], 'integer'],
            [['total_credits', 'grand_total_credits', 'wait_total_credits', 'freeze_credits', 'promo_credits', 'promo_credits_total'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => 'Member ID',
            'total_credits' => 'Total Credits',
            'grand_total_credits' => 'Grand Total Credits',
            'wait_total_credits' => 'Wait Total Credits',
            'freeze_credits' => 'Freeze Credits',
            'promo_credits' => 'Promo Credits',
            'promo_credits_total' => 'Promo Credits Total',
        ];
    }
}

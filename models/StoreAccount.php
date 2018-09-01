<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store_account".
 *
 * @property int $id
 * @property int $store_id
 * @property string $business_income 营业收入
 * @property string $credits_income 积分收入
 * @property string $return_credits 可回贈的積分額度
 * @property int $probability 单笔消费回赠点数
 * @property int $fixed_probability 单笔固定回赠点数
 * @property int $feature_probability 修改回贈的回贈點數
 * @property int $feature_probability_time 修改下次生效時間
 * @property int $feature_fixed_probability
 * @property int $feature_fixed_probability_time
 */
class StoreAccount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['store_id'], 'required'],
            [['store_id', 'probability', 'fixed_probability', 'feature_probability', 'feature_probability_time', 'feature_fixed_probability', 'feature_fixed_probability_time'], 'integer'],
            [['business_income', 'credits_income', 'return_credits'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_id' => 'Store ID',
            'business_income' => 'Business Income',
            'credits_income' => 'Credits Income',
            'return_credits' => 'Return Credits',
            'probability' => 'Probability',
            'fixed_probability' => 'Fixed Probability',
            'feature_probability' => 'Feature Probability',
            'feature_probability_time' => 'Feature Probability Time',
            'feature_fixed_probability' => 'Feature Fixed Probability',
            'feature_fixed_probability_time' => 'Feature Fixed Probability Time',
        ];
    }
}

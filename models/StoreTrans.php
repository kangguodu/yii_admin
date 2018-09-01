<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store_trans".
 *
 * @property int $id
 * @property int $store_id 店鋪ID
 * @property int $trans_type 交易類型:1 收入 2:支出
 * @property int $trans_category 交易分類
 * @property string $trans_category_name 交易分類名稱
 * @property string $trans_description 交易描述
 * @property string $trans_date 交易日期
 * @property string $trans_datetime 交易時間
 * @property string $amount 交易金額
 * @property string $balance 異動前金額
 * @property string $created_at 創建時間
 * @property int $created_by 創建人
 * @property string $created_name 創建名稱
 * @property string $custom_field1 自定義字段1
 */
class StoreTrans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_trans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['store_id', 'trans_type', 'trans_description', 'trans_date', 'trans_datetime', 'created_at', 'created_by', 'created_name'], 'required'],
            [['store_id', 'trans_type', 'trans_category', 'created_by'], 'integer'],
            [['trans_date', 'trans_datetime', 'created_at'], 'safe'],
            [['amount', 'balance'], 'number'],
            [['trans_category_name', 'created_name', 'custom_field1'], 'string', 'max' => 50],
            [['trans_description'], 'string', 'max' => 255],
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
            'trans_type' => 'Trans Type',
            'trans_category' => 'Trans Category',
            'trans_category_name' => 'Trans Category Name',
            'trans_description' => 'Trans Description',
            'trans_date' => 'Trans Date',
            'trans_datetime' => 'Trans Datetime',
            'amount' => 'Amount',
            'balance' => 'Balance',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'created_name' => 'Created Name',
            'custom_field1' => 'Custom Field1',
        ];
    }
}

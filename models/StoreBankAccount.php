<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store_bank_account".
 *
 * @property int $id
 * @property int $store_id 店家編號
 * @property string $bank_name 銀行名稱
 * @property string $receiver_name 收款人
 * @property string $bank_account 賬號
 * @property string $bank_phone 手機號
 * @property string $branch_name
 * @property string $region
 * @property int $status 是否使用1是0否
 * @property string $created_at
 */
class StoreBankAccount extends \yii\db\ActiveRecord
{
    public $store_name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store_bank_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id'], 'integer'],
            [['created_at'], 'safe'],
            [['bank_name', 'receiver_name', 'bank_account', 'branch_name', 'region'], 'string', 'max' => 255],
            [['bank_phone'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 1],
            [['store_id','bank_name','receiver_name','bank_account','bank_phone','status'],'required'],
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
            'bank_name' => Yii::t('app', 'Bank Name'),
            'receiver_name' => Yii::t('app', 'Receiver Name'),
            'bank_account' => Yii::t('app', 'Bank Account'),
            'bank_phone' => Yii::t('app', 'Bank Phone'),
            'branch_name' => Yii::t('app', 'Branch Name'),
            'region' => Yii::t('app', 'Region'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'store_name' => Yii::t('app', 'Store Name'),
        ];
    }
}

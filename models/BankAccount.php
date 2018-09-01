<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank_account".
 *
 * @property int $id
 * @property int $member_id 會員編號
 * @property string $bank_name 銀行名稱
 * @property string $receiver_name 收款人
 * @property string $bank_account 賬號
 * @property string $bank_phone 手機號
 * @property int $status 是否使用1是0否
 * @property string $created_at
 */
class BankAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id'], 'integer'],
            [['created_at'], 'required'],
            [['created_at'], 'safe'],
            [['bank_name', 'receiver_name', 'bank_account'], 'string', 'max' => 255],
            [['bank_phone'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'member_id' => Yii::t('app', 'Member ID'),
            'bank_name' => Yii::t('app', 'Bank Name'),
            'receiver_name' => Yii::t('app', 'Receiver Name'),
            'bank_account' => Yii::t('app', 'Bank Account'),
            'bank_phone' => Yii::t('app', 'Bank Phone'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}

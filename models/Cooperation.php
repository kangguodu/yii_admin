<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cooperation".
 *
 * @property int $id
 * @property string $username 姓名
 * @property string $phone 電話
 * @property string $company_name 公司名稱
 * @property string $company_tax_no 統一編號
 * @property string $type_name 合作類別
 * @property string $direction 合作方向
 * @property int $status 狀態，0申請中1已處理
 * @property string $created_at
 */
class Cooperation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cooperation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['username', 'type_name'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 25],
            [['company_name'], 'string', 'max' => 120],
            [['company_tax_no'], 'string', 'max' => 30],
            [['direction'], 'string', 'max' => 255],
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
            'username' => Yii::t('app', 'Username'),
            'phone' => Yii::t('app', 'Phone'),
            'company_name' => Yii::t('app', 'Company Name'),
            'company_tax_no' => Yii::t('app', 'Company Tax No'),
            'type_name' => Yii::t('app', 'Type Name'),
            'direction' => Yii::t('app', 'Direction'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}

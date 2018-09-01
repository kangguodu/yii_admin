<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store_apply".
 *
 * @property int $id
 * @property string $name 姓名
 * @property string $province
 * @property string $city 城市
 * @property string $address 地址
 * @property string $phone 电话
 * @property string $email
 * @property string $company_name 公司名称
 * @property string $company_tax_no 统一编号
 * @property string $type_name 營業類別
 * @property int $status 狀態，0申請中,1同意
 * @property string $created_at
 * @property string $other 其他
 */
class StoreApply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store_apply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'phone', 'company_name', 'company_tax_no', 'type_name', 'created_at', 'other'], 'required'],
            [['created_at'], 'safe'],
            [['other'], 'string'],
            [['name', 'city', 'type_name'], 'string', 'max' => 50],
            [['province', 'phone'], 'string', 'max' => 25],
            [['address', 'email'], 'string', 'max' => 255],
            [['company_name'], 'string', 'max' => 120],
            [['company_tax_no'], 'string', 'max' => 30],
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
            'name' => Yii::t('app', 'Name'),
            'province' => Yii::t('app', 'Province'),
            'city' => Yii::t('app', 'City'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'company_name' => Yii::t('app', 'Company Name'),
            'company_tax_no' => Yii::t('app', 'Company Tax No'),
            'type_name' => Yii::t('app', 'Type Name'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'other' => Yii::t('app', 'Other'),
        ];
    }
}

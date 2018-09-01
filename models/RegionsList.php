<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "regions_list".
 *
 * @property int $region_id 區域編號
 * @property string $region_name 區域名稱
 * @property int $region_type 区域类型
 * @property int $parent_id 父区域
 * @property int $is_free 1包郵0不包郵
 */
class RegionsList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regions_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_name'], 'required'],
            [['region_type', 'parent_id', 'is_free'], 'integer'],
            [['region_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'region_id' => Yii::t('app', 'Region ID'),
            'region_name' => Yii::t('app', 'Region Name'),
            'region_type' => Yii::t('app', 'Region Type'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'is_free' => Yii::t('app', 'Is Free'),
        ];
    }
}

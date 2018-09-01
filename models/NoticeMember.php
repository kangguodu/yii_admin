<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notice_member".
 *
 * @property int $id
 * @property int $notice_id
 * @property int $member_id
 * @property int $status 狀態，1已讀2未讀
 */
class NoticeMember extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notice_member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notice_id', 'member_id'], 'required'],
            [['notice_id', 'member_id'], 'integer'],
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
            'notice_id' => Yii::t('app', 'Notice ID'),
            'member_id' => Yii::t('app', 'Member ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}

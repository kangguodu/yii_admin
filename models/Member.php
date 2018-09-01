<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property int $id
 * @property string $phone 手機號碼
 * @property string $zone 區號
 * @property string $password
 * @property string $username 姓名
 * @property string $nickname
 * @property string $email 信箱
 * @property int $gender 性别,1男2女
 * @property string $avatar
 * @property string $birthday 生日
 * @property string $id_card ID
 * @property int $status 用户状态
 * @property int $groupid 会员组groupid
 * @property int $user_type 认证类型 0  未认证 1 个人 2 網紅
 * @property int $secure_status 安全碼開關
 * @property string $secure_password 安全碼
 * @property string $invite_code 推廣碼
 * @property string $promo_code 綁定推廣碼
 * @property int $invite_count 邀請數量
 * @property string $created_at
 * @property string $updated_at
 * @property int $number 是否新用户，0是其他不是
 * @property string $token
 * @property int $code_type 綁定邀請碼類型，1網紅會員2店家
 * @property int $honor 网红头衔，0无1普通网红2校园大使
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['birthday', 'created_at', 'updated_at','avatar'], 'safe'],
            [['invite_count'], 'integer'],
            [['phone', 'nickname'], 'string', 'max' => 50],
            [[ 'username', 'email'], 'string', 'max' => 255],
            [['gender', 'status', 'user_type'], 'string', 'max' => 1],
            [['avatar'], 'image',  'skipOnEmpty' => true,'extensions'=>'jpg,jpeg, png','minWidth' => 160,'maxWidth' => 160, 'minHeight' => 160, 'maxHeight' => 160, 'maxSize' => 1024 * 1024],
        ];
    }

    public function upload()
    {
        if($this->validate()){
            $this->avatar->saveAs('uploads/' . $this->avatar->baseName . '.' . $this->avatar->extension);
            return true;
        }else{
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'phone' => Yii::t('app', 'Phone'),
            'zone' => Yii::t('app', 'Zone'),
            'password' => Yii::t('app', 'Password'),
            'username' => Yii::t('app', 'Username'),
            'nickname' => Yii::t('app', 'Nickname'),
            'email' => Yii::t('app', 'Email'),
            'gender' => Yii::t('app', 'Gender'),
            'avatar' => Yii::t('app', 'Avatar'),
            'birthday' => Yii::t('app', 'Birthday'),
            'id_card' => Yii::t('app', 'Id Card'),
            'status' => Yii::t('app', 'Status'),
            'groupid' => Yii::t('app', 'Groupid'),
            'user_type' => Yii::t('app', 'User Type'),
            'secure_status' => Yii::t('app', 'Secure Status'),
            'secure_password' => Yii::t('app', 'Secure Password'),
            'invite_code' => Yii::t('app', 'Invite Code'),
            'promo_code' => Yii::t('app', 'Promo Code'),
            'invite_count' => Yii::t('app', 'Invite Count'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'number' => Yii::t('app', 'Number'),
            'token' => Yii::t('app', 'Token'),
            'code_type' => Yii::t('app', 'Code Type'),
            'honor' => Yii::t('app', 'Honor'),
        ];
    }
}

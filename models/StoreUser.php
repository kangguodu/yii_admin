<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store_user".
 *
 * @property int $id
 * @property int $store_id 店铺id
 * @property string $nickname 名字
 * @property string $email 信箱
 * @property string $mobile 手機號碼
 * @property string $zone 区号
 * @property string $password 密码
 * @property string $permission
 * @property string $email_status 信箱驗證狀態
 * @property string $token
 * @property string $gender
 * @property int $super_account
 * @property string $position 職位
 * @property string $menus 菜單
 */
class StoreUser extends \yii\db\ActiveRecord
{
    
    public $store_name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store_user';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['add_user'] = [
                'mobile'
            ];
        $scenarios['update_user'] = [
            'mobile'
        ];
        $scenarios['add_user'] = array_merge($scenarios['default'],$scenarios['add_user']);
        $scenarios['update_user'] = array_merge($scenarios['default'],$scenarios['update_user']);
        //var_dump($scenarios);
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'mobile'], 'required'],
            [['store_id','super_account'], 'integer'],
            [['permission'], 'string'],
            [['nickname', 'email'], 'string', 'max' => 50],
            [['mobile'], 'string', 'max' => 20],
            [['zone', 'email_status', 'gender'], 'string', 'max' => 10],
            [['password'], 'string', 'max' => 150],
            [['token'], 'string', 'max' => 300],
            [['position'], 'string', 'max' => 30],
            [['mobile'],'unique','on' => 'add_user'],
            [['mobile'],'unique','on' => 'update_user'],
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
            'nickname' => Yii::t('app', 'Store Nickname'),
            'email' => Yii::t('app', 'Email'),
            'mobile' => Yii::t('app', 'Mobile'),
            'zone' => Yii::t('app', 'Zone'),
            'password' => Yii::t('app', 'Password'),
            'permission' => Yii::t('app', 'Permission'),
            'email_status' => Yii::t('app', 'Email Status'),
            'token' => Yii::t('app', 'Token'),
            'gender' => Yii::t('app', 'Gender'),
            'super_account' => Yii::t('app', 'Super Account'),
            'position' => Yii::t('app', 'Position'),
            'menus' => Yii::t('app', 'Menus'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'last_login' => Yii::t('app', 'Last Login'),
            'store_name' => Yii::t('app', 'Store Name'),
        ];
    }


    public function getMenusData($menus){
        
        if(intval($this->super_account) >= 1){

        }else{
            $menusData = getStoreUserMenusData();
            if(!empty($menus) && is_array($menus)){
                if(count($menus) > 0){
                    foreach($menusData as &$value){
                        foreach($menus as $v2){
                            if($v2 == $value['type']){
                                $value['checked'] = true;
                                break;
                            }
                        }
                    }
                    unset($value);
                }
                $this->menus = json_encode($menusData);
            }else{
                $this->menus = json_encode(array());
            }
        }
    }

    public function beforeUpdateForm($model){
        $model->password = '';
        if(is_string($model->menus)){
            $tempMenus = json_decode($model->menus,TRUE);
            if($tempMenus != null && $tempMenus != false){
                $result = [];
                foreach($tempMenus as $value){
                    if(boolval($value['checked']) === true){
                        $result[] = $value['type'];
                    }
                }
                $model->menus = $result;
            }else{
                $model->menus = [];
            }
        }
        return $model;
    }
}

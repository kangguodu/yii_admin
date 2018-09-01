<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "store".
 *
 * @property int $id
 * @property string $store_id 店鋪編號
 * @property int $super_uid 超級用戶id
 * @property string $name 名称
 * @property string $branchname 分店名稱
 * @property string $city 城市
 * @property string $district 區
 * @property string $address 地址
 * @property string $phone 电话
 * @property string $email 邮箱
 * @property string $company_name 公司名称
 * @property string $company_tax_no 统一编号
 * @property string $code 用于扫码下单的代码
 * @property int $type 店家業態
 * @property string $type_name 業態名稱
 * @property string $image 廣告首圖
 * @property int $service_status 營業狀態，1營業0休息
 * @property string $remark 备注
 * @property int $avg_cost_status 平均消费是否启用，1启用0否
 * @property int $avg_cost_low 平均消费
 * @property int $avg_cost_high
 * @property string $facebook facebook连结
 * @property string $instagram instagram连结
 * @property string $google_keyword google搜索关键字
 * @property string $coordinate 坐标
 * @property string $lat 緯度
 * @property string $lng 經度
 * @property string $created_at
 * @property string $email_valid
 * @property int $routine_holiday 例行休息日,0無非0有
 * @property string $special_holiday 特休日空無
 * @property string $special_business_day 特別營業日
 * @property int $is_return 是否回贈，1是0否
 * @property string $search_keyword 搜索關鍵詞，用於搜索
 * @property int $recommend_rank 推薦排名,1第一2第二3第三，默認999999999不推薦
 * @property string $description 關於店家介紹
 * @property string $service 提供的服务
 * @property int $status 店家状态 1: 啟用 0 禁用
 */
class Store extends \yii\db\ActiveRecord
{

    public $credits_income;
    public $return_credits;
    public $business_income;
    public $super_username;

    public $day_of_week;
    public $open_time;
    public $close_time;
    public $district_pid;

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['add_store'] = [
                'name',
                'address',
                'phone',
                'company_name',
                'company_tax_no',
                'type',
                'city',
                'district'
            ];
        $scenarios['update_store'] = [
            'name',
            'phone'
        ];
        $scenarios['add_store'] = array_merge($scenarios['default'],$scenarios['add_store']);
        $scenarios['update_store'] = array_merge($scenarios['default'],$scenarios['update_store']);
        //var_dump($scenarios);
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'name', 'address', 'phone', 'company_name', 'company_tax_no', 'type','city', 'district',], 'required'],
            [['super_uid', 'type', 'service_status', 'avg_cost_status', 'avg_cost_low', 'avg_cost_high', 'routine_holiday', 'is_return', 'recommend_rank', 'status'], 'integer'],
            [['created_at', 'special_holiday', 'special_business_day', 'service', 'lat', 'lng'], 'safe'],
            [['email_valid'], 'string'],
            [['store_id', 'address', 'code', 'remark', 'instagram', 'search_keyword', 'description'], 'string', 'max' => 255],
            [['name', 'google_keyword'], 'string', 'max' => 150],
            [['branchname', 'city', 'district', 'phone', 'email', 'type_name', 'facebook'], 'string', 'max' => 50],
            [['company_name'], 'string', 'max' => 120],
            [['company_tax_no'], 'string', 'max' => 20],
            [['coordinate'], 'string', 'max' => 100],
            [['image'], 'image',  'skipOnEmpty' => true,'extensions'=>'jpg,jpeg, png','minWidth' => 400,'maxWidth' => 400, 'minHeight' => 400, 'maxHeight' => 400],
            [['phone','name'],'unique','on' => 'add_store'],
            [ ['phone'], 'unique','on' => 'update_store'],
            [ ['name'],  'unique','on' => 'update_store'],
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
            'super_uid' => Yii::t('app', 'Super Uid'),
            'name' => Yii::t('app', 'Store Name'),
            'branchname' => Yii::t('app', 'Branchname'),
            'city' => Yii::t('app', 'City'),
            'district' => Yii::t('app', 'District'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'company_name' => Yii::t('app', 'Company Name'),
            'company_tax_no' => Yii::t('app', 'Company Tax No'),
            'code' => Yii::t('app', 'Store Code'),
            'type' => Yii::t('app', 'Store Type'),
            'type_name' => Yii::t('app', 'Store Type Name'),
            'image' => Yii::t('app', 'Store Logo'),
            'service_status' => Yii::t('app', 'Service Status'),
            'remark' => Yii::t('app', 'Remark'),
            'avg_cost_status' => Yii::t('app', 'Avg Cost Status'),
            'avg_cost_low' => Yii::t('app', 'Avg Cost Low'),
            'avg_cost_high' => Yii::t('app', 'Avg Cost High'),
            'facebook' => Yii::t('app', 'Facebook'),
            'instagram' => Yii::t('app', 'Instagram'),
            'google_keyword' => Yii::t('app', 'Google Keyword'),
            'coordinate' => Yii::t('app', 'Coordinate'),
            'lat' => Yii::t('app', 'Lat'),
            'lng' => Yii::t('app', 'Lng'),
            'created_at' => Yii::t('app', 'Store Created At'),
            'email_valid' => Yii::t('app', 'Email Valid'),
            'routine_holiday' => Yii::t('app', 'Routine Holiday'),
            'special_holiday' => Yii::t('app', 'Special Holiday'),
            'special_business_day' => Yii::t('app', 'Special Business Day'),
            'is_return' => Yii::t('app', 'Is Return'),
            'search_keyword' => Yii::t('app', 'Search Keyword'),
            'recommend_rank' => Yii::t('app', 'Recommend Rank'),
            'description' => Yii::t('app', 'Store Description'),
            'service' => Yii::t('app', 'Store Service'),
            'credits_income' => Yii::t('app','Credits Income'),
            'return_credits' => Yii::t('app','Return Credits'),
            'business_income' => Yii::t('app','Business Income'),
            'status' => Yii::t('app', 'Status'),
            'super_username' => Yii::t('app', 'Super Username'),
        ];
    }


    public function getCityOption(){
        return ArrayHelper::map(RegionsList::find()->where(['parent_id' => 1])->all(),'region_id','region_name');
    }

    public function getDistrictOption($parent_id){
        $parent_id = intval($parent_id);
        if($parent_id > 0){
            $directs = RegionsList::findAll(['parent_id' => $parent_id]);
            $result = ArrayHelper::map($directs, 'region_id', 'region_name');    
            return $result;
        }else{
            return array();
        }
        
    }

    public function getDistrictOption2($parent_id){
        $parent_id = intval($parent_id);
        if($parent_id > 0){
            $directs = RegionsList::find()->where(['parent_id' => $parent_id])->select('region_id,region_name')->asArray()->all();
            return $directs;    
        }else{
            return array();
        }
        
    }

    private function getStoreTypeName($id){
       if($model = StoreType::findOne(['id' => $id])){
            return $model->name;
       }else{
            return '';
       }
    }

    public function storeServicesToSaveData(){
        $storeServices = storeServices();
        $result = array();
        foreach($storeServices as $key=>$value){
            $result[] = array(
                'id'  => $key,
                'name' => $value,
                'checked' => false,
                'type' => $key,
            );
        }
        return $result;
    }

    public function getRegionIdByName($name,$parent_id=1){
        if(!empty($name) && is_string($name)){
            $tempRegion = RegionsList::findOne(['region_name' => $name,'parent_id' => $parent_id]);
            if($tempRegion !== null){
                return $tempRegion->region_id;
            }
        }
        return 1;
    }

    public function storeBeforeSaveData(){
        $this->type_name = $this->getStoreTypeName($this->type); 
        $service = $this->service;
        $storeServices = $this->storeServicesToSaveData();
        if(!empty($service)){
            foreach($storeServices as &$value){
                foreach($service as $v2){
                    if($v2 == $value['id']){
                        $value['checked'] = true;
                        break;
                    }
                }
            }
            unset($value);
        }
        //如果沒有選中，需要移除
        if(count($storeServices) > 0){
            foreach($storeServices as $key=>$value){
                if(!$value['checked']){
                    unset($storeServices[$key]);
                }
            }
            if(count($storeServices) > 0){
                $storeServices = array_merge($storeServices,array());
            }
        }

        $this->service = json_encode($storeServices);
        if(!empty($this->city) && is_numeric($this->city)){
            $tempCity = RegionsList::findOne(['region_id' => $this->city]);
            if($tempCity !== null){
                $this->city = $tempCity->region_name;
            }else{
                $this->city = 0;
            }
        }

        if(!empty($this->district) && is_numeric($this->district)){
            $tempDistrict = RegionsList::findOne(['region_id' => $this->district]);
            if($tempDistrict !== null){
                $this->district = $tempDistrict->region_name;
            }else{
                $this->district = 0;
            }
        }


        if(!empty($this->coordinate)){
            $strIndex = strpos($this->coordinate, ',');
            if($strIndex !== false){
               $coordinate = explode(',', $this->coordinate);
               $this->lat =  $coordinate[0];
               $this->lng =  $coordinate[1];
            }else{
                $this->coordinate = '';
                $this->lat = '';
                $this->lng = ''; 
            }
        }else{
            if(!empty($this->address) && empty($this->coordinate)){
                $geocode = $this->getGeocodeFromAddress($this->address);
                if(count($geocode) > 0){
                    $this->coordinate = $geocode[0].','.$geocode[1];
                    $this->lat = $geocode[0];
                    $this->lng = $geocode[1]; 
                }else{
                    $this->coordinate = '';
                    $this->lat = '';
                    $this->lng = ''; 
                }
            }
        }
        if(empty($this->code)){
            $code = PromoCodes::find()->where(['used' => 0])->orderBy('rand()')->one();
            if($code){
                $this->code = $code->code;
                $code->used = 1;
                $code->save();
            }
        }

    }

    public function getSuper_username(){
        return $this->super_username;
    }

    public function beforeUpdateForm() {
        if(is_string($this->service)){
            $tempService = json_decode($this->service,TRUE);
            if( $tempService !== null && $tempService !== false){
                $result = [];
                foreach($tempService as $value){
                    if(boolval($value['checked']) === true){
                        $result[] = isset($value['id'])?$value['id']:0;
                    }
                }
                $this->service = $result;
            }else{
                $this->service = [];
            }
        }

        if(!empty($this->city) && !is_numeric($this->city)){
            $this->city = $this->getRegionIdByName($this->city,1);
            $this->district_pid = $this->city;
            $this->district = $this->getRegionIdByName($this->district,$this->city);
        }
        if(isset($this->super_username)){
            if(empty($this->super_username)){
                $storeUser = StoreUser::findOne(['store_id' => $this->id,'super_account' => 1]);
                $this->super_username = $storeUser->nickname;
            }
        }
        

        

        
        //var_dump($model->city);
        // return $model;
    }

    public function updateSuperUserNickname($store_id,$nickname){
        if(!empty($nickname)){
           $storeUser = StoreUser::findOne(['store_id' => $store_id,'super_account' => 1]);
            $storeUser->nickname = $nickname;
            $storeUser->save(); 
        }
        
    }

    public function initStoreOtherInfomation($params){
        //1. 創建店主
        $storeUser = new StoreUser();
        $storeUser->store_id = $params['store_id'];
        $storeUser->nickname = empty($params['username'])?$params['phone']:$params['username'];
        $storeUser->mobile = $params['phone'];
        $storeUser->zone = '886';
        $storeUser->password = '';
        $storeUser->gender = '';
        $storeUser->super_account = 1;
        $storeUser->position = '店長';
        $storeUser->menus = json_encode(getStoreUserMenusArray());
        if($storeUser->save()){


        }else{
           //var_dump($storeUser->getErrors());exit(); 
        }

        //2. 初始化店家錢包
        $storeAccount = new StoreAccount();
        $storeAccount->store_id = $params['store_id'];
        $storeAccount->save();

    }

    public function getGeocodeFromAddress($address,$count = 2){
        Yii::error("geocode count:{$count}");
        try{
            if($count !== false && $count == 0) {
               return array();
            }else {
               $count--;
            }
            $geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false');
            $output= json_decode($geocode);
            if($output->status == 'ZERO_RESULTS' || $output->status == 'OVER_QUERY_LIMIT'){
                return $this->getGeocodeFromAddress($address,$count);
            }else{
                $lat = $output->results[0]->geometry->location->lat;
                $long = $output->results[0]->geometry->location->lng;
                return array($lat,$long);
            }
        }catch(\Exception $e){
            Yii::error($e->getMessage());
            return array();
        }
        
    }  

}

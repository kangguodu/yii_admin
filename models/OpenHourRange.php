<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "open_hour_range".
 *
 * @property int $id
 * @property int $store_id 店铺id
 * @property int $day_of_week
 * @property string $open_time
 * @property string $close_time
 */
class OpenHourRange extends \yii\db\ActiveRecord
{
    public $routine_holiday;
    public $special_holiday;
    public $special_business_day;
    public $remark;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'open_hour_range';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['store_id', 'day_of_week', 'open_time', 'close_time'], 'required'],
            [['store_id', 'day_of_week'], 'integer'],
            [['open_time', 'close_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'store_id' => Yii::t('app', 'Store ID'),
            'day_of_week' => Yii::t('app', 'Day Of Week'),
            'open_time' => Yii::t('app', 'Open Time'),
            'close_time' => Yii::t('app', 'Close Time'),
        ];
    }

    public function getStoreOpenHours($store_id){
        $result = Store::find()->leftJoin('open_hour_range','`store`.id = open_hour_range.store_id')
            ->where(['store.id' => $store_id])
            ->select([
                'store.routine_holiday',
                'store.special_holiday',
                'store.special_business_day',
                'store.remark',
                'open_hour_range.id',
                'open_hour_range.day_of_week',
                'open_hour_range.open_time',
                'open_hour_range.close_time'
            ])->orderBy('open_hour_range.id ASC')->all();
        
        if($result !== null && !empty($result)){
            $firstResult = $result[0];
            $openHours = array(
                'routine_holiday' => intval($firstResult->routine_holiday),
                'special_holiday' => $this->openHoursDateToEmpty($firstResult->special_holiday),
                'special_business_day' => $this->openHoursDateToEmpty($firstResult->special_business_day),
                'remark' => $firstResult->remark,
                'open_hours' => array(

                )
            );

            $openHoursData = array(
                '1' => array(
                    'label' => '(一)',
                    'value' => false,
                    'day_of_week' => 1,
                    'time' => array()
                ),
                '2' => array(
                    'label' => '(二)',
                    'value' => false,
                    'day_of_week' => 2,
                    'time' => array()
                ),
                '3' => array(
                    'label' => '(三)',
                    'value' => false,
                    'day_of_week' => 3,
                    'time' => array()
                ),
                '4' => array(
                    'label' => '(四)',
                    'value' => false,
                    'day_of_week' => 4,
                    'time' => array()
                ),
                '5' => array(
                    'label' => '(五)',
                    'value' => false,
                    'day_of_week' => 5,
                    'time' => array()
                ),
                '6' => array(
                    'label' => '(六)',
                    'value' => false,
                    'day_of_week' => 6,
                    'time' => array()
                ),
                '7' => array(
                    'label' => '(日)',
                    'value' => false,
                    'day_of_week' => 7,
                    'time' => array()
                ),
            );
            foreach ($result as $key=>$value){
                $day_of_week = intval($value->day_of_week);
                if(array_key_exists($day_of_week,$openHoursData)){
                    $tempData = array(
                        'open_time' => date('H:i',strtotime(date("Y-m-d {$value->open_time}"))),
                        'close_time' => date('H:i',strtotime(date("Y-m-d {$value->close_time}")))
                    );
                    if(count($openHoursData[$day_of_week]) <= 0){
                        $openHoursData[$day_of_week] = array(
                            'id' => $value->id,
                            'day_of_week' => $value->day_of_week,
                            'time' => array()
                        );
                    }
                    $openHoursData[$day_of_week]['day_of_week'] = $value->day_of_week;
                    $openHoursData[$day_of_week]['value'] = true;
                    $openHoursData[$day_of_week]['time'][] = $tempData;
                }
            }
            $openHours['open_hours'] = array_merge($openHoursData,array());
            foreach($openHours['open_hours'] as &$value){
                if(count($value['time']) == 0){
                    $value['time'] = array(
                        array(
                            'open_time' => '09:00',
                            'close_time' => '12:00',
                        ),
                        array(
                            'open_time' => '14:00',
                            'close_time' => '22:00',
                        ),
                    );
                }
            }
            unset($value);
        }else{
            $openHours = array(
                'routine_holiday' => 0,
                'special_holiday' => '',
                'special_business_day' => '',
                'remark' => '',
                'open_hours' => array()
            );
        }
        return $openHours;
    }

    private function openHoursDateToEmpty($data){
        if(empty($data)){
            return '';
        }else if($data == '0000-00-00'){
            return '';
        }else{
            return $data;
        }
    }

    private function getStoreOpenHoursData($store_id){
        return Store::findOne($store_id);
    }



    private function updateOpenHourFilter($store_id,$params){
        $result = array(
            'routine_holiday' => isset($params['routine_holiday'])?$params['routine_holiday']:0,
            'special_holiday' => isset($params['special_holiday'])?$params['special_holiday']:'',
            'special_business_day' => isset($params['special_business_day'])?$params['special_business_day']:'',
            'remark' => isset($params['remark'])?$params['remark']:'',
        );
        if(empty($result['routine_holiday'])){
            $result['routine_holiday'] = 0;
        }
        if(empty($result['special_holiday'])){
            $result['special_holiday'] = '';
        }
        if(empty($result['special_business_day'])){
            $result['special_business_day'] = '';
        }
        $openHours = isset($params['open_hours'])?$params['open_hours']:array();
        $openTimes = isset($params['open_time'])?$params['open_time']:array();
        $closeTimes = isset($params['close_time'])?$params['close_time']:array();

        if(empty($openHours)){
            $result['open_hours'] = array();
        }else if(count($openHours) > 0){
            $openHoursIndex = array(
                '1' ,
                '2' ,
                '3' ,
                '4' ,
                '5' ,
                '6' ,
                '7' ,
            );
            $openHoursData = array();
            $openHoursParamCount = count($openHours);
            foreach ($openHours as $day_of_week){
                if(isset($openTimes[$day_of_week])){
                    foreach($openTimes[$day_of_week] as $key=>$value){
                        if(!empty($value) && !empty($closeTimes[$day_of_week][$key])){
                            $tempData = array(
                                'store_id' => $store_id,
                                'day_of_week' => $day_of_week,
                                'open_time' => trim($value).':00',
                                'close_time' => trim($closeTimes[$day_of_week][$key]).':00',
                            );
                            $openHoursData[] = $tempData;
                        }
                    }
                }
            }
            $result['open_hours'] = $openHoursData;
        }
        
        return $result;
    }

    public function updateStoreOpenHours($postData){

        $store_id = $postData['id'];
        $storeInfo = $this->getStoreOpenHoursData($store_id);
        $paramData = $this->updateOpenHourFilter($store_id,$postData);
        if($storeInfo != null){
            // $storeInfo->routine_holiday = $paramData['routine_holiday'];
            // $storeInfo->special_holiday = empty($paramData['special_holiday'])?'000-00-00':$paramData['special_holiday'];
            // $storeInfo->special_business_day = empty($paramData['special_business_day'])?'000-00-00':$paramData['special_business_day'];
            // $storeInfo->remark = $paramData['remark'];
            // $storeInfo->save();
            $updateData = array(
                'routine_holiday' =>$paramData['routine_holiday'],
                'remark' => $paramData['remark']
            );
            if(!empty($paramData['special_holiday']) && $paramData['special_holiday'] != '0000-00-00'){
                $updateData['special_holiday'] = $paramData['special_holiday'];
            }
            if(!empty($paramData['special_business_day']) && $paramData['special_business_day'] != '0000-00-00'){
                $updateData['special_business_day'] = $paramData['special_business_day'];
            }
            Yii::$app->db->createCommand()->update('store', $updateData, 'id = '.$store_id)->execute();
            self::deleteAll(['store_id' => $store_id]);
            if(count($paramData['open_hours']) > 0){
                foreach ($paramData['open_hours'] as $value){
                    $newData = new OpenHourRange();
                    $newData->store_id = $value['store_id'];
                    $newData->day_of_week = $value['day_of_week'];
                    $newData->open_time = $value['open_time'];
                    $newData->close_time = $value['close_time'];
                    $newData->save();
                }
            }
        }

    }
}

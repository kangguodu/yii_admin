<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;

app\assets\VueAsset::register($this);
app\assets\VueAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\OpenHourRange */
/* @var $form ActiveForm */
$this->title = Yii::t('app', 'Update Store Services Time: {nameAttribute}', [
    'nameAttribute' => '',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$openHours = json_encode($open_hours);
$this->registerJs("var _myOpenHours = '{$openHours}';");
$this->registerJs($this->render('_servicestime.js'));
?>

<?php echo Yii::$app->params['content_common_start'];?>
<div class="store-servicestime">
    <p>
         <?= Html::a(Yii::t('app', 'back_to_list'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <div id="myvue-app">

        <form class="form-horizontal" action="<?php echo Url::toRoute('store/servicestime');?>&id=<?php echo $id;?>" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="form-group">
                <label for="service-times" class="col-lg-2 control-label">營業時間</label>
                <div class="col-lg-8">
                      <?php foreach($open_hours['open_hours'] as $key=>$value): ?>
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title"><?php echo $value['label'];?></h3>
                                <input type="checkbox"  name="open_hours[]" v-model="open_hours[<?php echo $key;?>].value" v-bind:value="open_hours[<?php echo $key;?>].day_of_week" value="<?php echo $value['day_of_week'];?>" > 
                            </div>
                            <div class="box-body">
                               <div class="row">
                                    <div id="week-<?php echo $value['day_of_week']?>">
                                        <div class="col-lg-1">1.</div>
                                        <div class="col-lg-5">
                                              <div class="input-group input-daterange">
                                                <?php  echo DateTimePicker::widget([
                                                    'name' => 'open_time['.$value['day_of_week'].'][0]',
                                                    'options' => [
                                                        'placeholder' => '',
                                                        ':disabled'=>"open_hours[".$key."].value == false",
                                                    ],
                                                    'value' => isset($value['time'][0]['open_time'])?$value['time'][0]['open_time']:'',
                                                    'convertFormat' => true,
                                                    'pluginOptions' => [
                                                        'startView' => 0,
                                                        'maxView' => 0,
                                                        'format' => 'HH:i',
                                                        'todayHighlight' => true
                                                    ]
                                                ]);?>

                                                <div class="input-group-addon">至</div>
                                                <?php  echo DateTimePicker::widget([
                                                    'name' => 'close_time['.$value['day_of_week'].'][0]',
                                                    'options' => ['placeholder' => '',':disabled'=>"open_hours[".$key."].value == false"],
                                                    'value' => isset($value['time'][0]['close_time'])?$value['time'][0]['close_time']:'',
                                                    'convertFormat' => true,
                                                    'pluginOptions' => [
                                                        'startView' => 0,
                                                        'maxView' => 0,
                                                        'format' => 'H:i ',
                                                        'todayHighlight' => true
                                                    ]
                                                ]);?>
                                            </div>
                                        </div>

                                        <div class="col-lg-1">2.</div>
                                        <div class="col-lg-5">
                                             <div class="input-group input-daterange">
                                                <?php  echo DateTimePicker::widget([
                                                    'name' => 'open_time['.$value['day_of_week'].'][1]',
                                                    'options' => ['placeholder' => '',':disabled'=>"open_hours[".$key."].value == false"],
                                                    'value' => isset($value['time'][1]['open_time'])?$value['time'][1]['open_time']:'',
                                                    'convertFormat' => true,
                                                    'pluginOptions' => [
                                                        'startView' => 0,
                                                        'maxView' => 0,
                                                        'format' => 'H:i ',
                                                        'todayHighlight' => true
                                                    ]
                                                ]);?>
                                                <div class="input-group-addon">至</div>
                                                <?php  echo DateTimePicker::widget([
                                                    'name' => 'close_time['.$value['day_of_week'].'][1]',
                                                    'options' => ['placeholder' => '',':disabled'=>"open_hours[".$key."].value == false"],
                                                    'value' => isset($value['time'][1]['close_time'])?$value['time'][1]['close_time']:'',
                                                    'convertFormat' => true,
                                                    'pluginOptions' => [
                                                        'startView' => 0,
                                                        'maxView' => 0,
                                                        'format' => 'H:i ',
                                                        'todayHighlight' => true
                                                    ]
                                                ]);?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                
                                </div> 
                            </div>
                        </div>
                        
                        
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="form-group">
                <label for="normal-holiday" class="col-lg-2 control-label">例行休假日</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox" name="routine_holiday_check" v-model="routine_holiday_check" value="1">&nbsp;&nbsp;每月
                        </span>
                        <select name="routine_holiday" class="form-control" v-model="routine_holiday" :disabled="routine_holiday_check == false">
                            <option></option>
                            <?php for($i = 1;$i < 32;$i++){?>
                               <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                        </select>
                        <span class="input-group-addon">日</span>
                   </div>
                </div>
            </div>

            <div class="form-group">
                <label for="normal-holiday" class="col-lg-2 control-label">特休日</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox" name="special_holiday_check" value="1" v-model="special_holiday_check">
                        </span>
                        <?php echo DatePicker::widget([
                            'name' => 'special_holiday', 
                            'options' => [
                                'placeholder' => '特休日',
                                'v-model' => 'special_holiday',
                                ':disabled' => "special_holiday_check === false",
                                'id' => 'special_holiday_id',
                            ],
                            'pluginOptions' => [
                                'autoclose' => true, 
                                'todayHighlight' => true, 
                                'format' => 'yyyy-mm-dd', 
                            ]
                        ]);?>
                   </div>
                </div>
            </div>

            <div class="form-group">
                <label for="normal-holiday" class="col-lg-2 control-label">特別營業日</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox" name="special_business_day_check" value="1" v-model="special_business_day_check" >
                        </span>
                        <?php echo DatePicker::widget([
                            'name' => 'special_business_day', 
                            'options' => [
                                'placeholder' => '特別營業日',
                                'v-model' => 'special_business_day',
                                ':disabled' => "special_business_day_check == false",
                                'id' => 'special_business_day_id'
                                ],
                            'pluginOptions' => [
                                'autoclose' => true, 
                                'todayHighlight' => true, 
                                'format' => 'yyyy-mm-dd', 
                            ]
                        ]);?>
                   </div>
                </div>
            </div>

            <div class="form-group">
                <label for="normal-holiday" class="col-lg-2 control-label">備註</label>
                <div class="col-lg-8">
                   <textarea class="form-control" rows="3" placeholder="輸入備註" name="remark"> <?php echo $open_hours['remark']; ?></textarea>
                </div>
            </div>


            <div class="box-footer">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div class="btn-group pull-right">
                        <?= Html::submitButton(Yii::t('app','save'), [
                                'class' => 'btn btn-info pull-right']) ?>
                    </div>
                    <div class="btn-group pull-left">
                        <?php echo Html::resetButton(Yii::t('app','reset'),[
                                'class' => 'btn btn-warning'
                        ])?>
                    </div>
            </div>
            <input name="_csrf" type="hidden" id="_csrf" value="<?php echo Yii::$app->request->csrfToken ?>">
        </form>
    </div>
</div>
<?php echo Yii::$app->params['content_common_end'];?>

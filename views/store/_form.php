<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\StoreType;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\file\FileInput;
use app\services\ImageToolService;
/* @var $this yii\web\View */
/* @var $model app\models\Store */
/* @var $form yii\widgets\ActiveForm */


$url = Url::to(['image-sign/remove-image','id'=>1, 'do'=>'remove']);
$imagesOptions = array(array('caption' => $model->image?$model->image:'example.png', 'size' => 200 , 'url'=>$url, 'key'=>0));

$storeTypes = ArrayHelper::map(StoreType::find()->all(), 'id', 'name');
?>
<div class="alert alert-info">
    獲取地址坐標，可用 <?php echo Html::a('第三方經緯度解析','http://www.gpsspg.com/maps.htm',[
        'target' => '_blank',
        'title' => '第三方經緯度解析'
    ])?>,店家Logo的尺寸:400*400
</div>
<div class="store-form">

    <?php $form = ActiveForm::begin(Yii::$app->params['form_upload_config']); ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_tax_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branchname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textArea(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreview'=>[
                ImageToolService::getUrlWithDefaultPath($model->image)
            ],
            'initialPreviewAsData'=>true,
            'showUpload' => false,
            'initialPreviewConfig' => $imagesOptions,
            'overwriteInitial'=>true,
            'maxFileCount' => 1,
            'previewFileType' => 'image',
            'allowedFileExtensions'=>['jpg','jpeg','png'],
            'maxImageWidth' => 400,
            'maxImageHeight' => 400,
            'minImageWidth' => 400,
            'minImageHeight' => 400,
            'language'=>'zh-TW',
        ],
    ]); ?>

    <?php echo $form->field($model, 'city')->widget(Select2::classname(), [
        'data' => $model->getCityOption(),
        'language' => 'zh_TW',
        'options' => ['placeholder' => ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
        'pluginEvents' => [
            'change' => 'function() {
            $.post("'.yii::$app->urlManager->createUrl('store/region-direct').'&parent_id="+$(this).val(),function(data){
                console.log(data);
                $("select#store-district").html(data);
                // if(data.length > 0){
                //     console.log("hello");
                //     for(var i = 0;i < data.lengt;i++){
                //         var tempData = data[i];
                //         var newOption = new Option(tempData.region_name, tempData.region_id, false, false);
                //         $("select#store-district").append(newOption);
                //     }
                    
                // }
                $("select#store-district").trigger("change");
                
            });}',
        ]
    ]);?>

    <?php echo $form->field($model, 'district')->widget(Select2::classname(), [
        'data' => $model->getDistrictOption($model->district_pid),
        'language' => 'zh_TW',
        'options' => ['placeholder' => ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>


    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'super_username')->textInput() ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

   
    <?php echo $form->field($model, 'type')->widget(Select2::classname(), [
        'data' => $storeTypes,
        'language' => 'zh_TW',
        'options' => ['placeholder' => ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>


    <?php echo $form->field($model, 'service')->checkboxList(storeServices());?>


    <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instagram')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'google_keyword')->textInput(['maxlength' => true]) ?>

    

    <?= $form->field($model, 'search_keyword')->textInput(['maxlength' => true]) ?>
    

    <?= $form->field($model, 'service_status')->dropDownList(
        [
            '1' => '營業',
            '0' => '休息'
        ], 
        ['prompt'=>'','prompt_val'=>'']); ?>


    

    <?= $form->field($model, 'avg_cost_status')->dropDownList(
        [
            '1' => '啟用',
            '0' => '禁用'
        ], 
        ['prompt'=>'','prompt_val'=>'']); ?>

    <?= $form->field($model, 'avg_cost_low')->textInput() ?>

    <?= $form->field($model, 'avg_cost_high')->textInput() ?>

    

    <?= $form->field($model, 'status')->dropDownList(
        [
            '1' => '已開店',
            '0' => '已關店'
        ], 
        ['prompt'=>'','prompt_val'=>'']); ?>
    

    <?= $form->field($model, 'is_return')->dropDownList(
        [
            '1' => '啟用',
            '0' => '禁用'
        ], 
        ['prompt'=>'','prompt_val'=>'']); ?>

    <?php //echo $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coordinate')->textInput(['maxlength' => true,'placeholder' =>'24.1431710000,120.6798820000']) ?>

    <div class="box-footer">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="btn-group pull-right">
                <?= Html::submitButton('<span class="fa fa-edit"></span> '.Yii::t('app','save'), [
                        'class' => 'btn btn-success pull-right']) ?>
            </div>
            <div class="btn-group pull-left">
                <?php echo Html::a('<span class="fa fa-times"></span> '.Yii::t('app','Cancel'),['index'],[ 'class' => 'btn btn-warning']); ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

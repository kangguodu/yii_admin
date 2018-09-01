<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\file\FileInput;
use kartik\datetime\DateTimePicker;
use kartik\touchspin\TouchSpin;
use app\services\ImageToolService;
use app\assets\AppAsset;
AppAsset::register($this);
AppAsset::addScript($this, Yii::$app->request->baseUrl . '/js/layui.js');
AppAsset::addScript($this, Yii::$app->request->baseUrl . '/js/activity.js');
/* @var $this yii\web\View */
/* @var $model app\models\Activity */
/* @var $form yii\widgets\ActiveForm */

$url = Url::to(['image-sign/remove-image','id'=>1, 'do'=>'remove']);
$imagesOptions = array(array('caption' => $model->posters_pictures?$model->posters_pictures:'example.png', 'size' => 200 , 'url'=>$url, 'key'=>0));

?>

<div class="activity-form">

    <?php $form = ActiveForm::begin(Yii::$app->params['form_upload_config']); ?>
    
      <?php echo $form->field($model, 'platform_type')->dropDownList(activityPlatformTypes(),
        ['prompt'=>'請選擇平臺類型','prompt_val'=>'']);  ?>

    <?php echo $form->field($model, 'type')->dropDownList(activityTypes(),
        ['prompt'=>'請選擇類型','prompt_val'=>'']); ?>

        
    <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

    <?php echo $form->field($model, 'description')->textInput(['maxlength' => true]); ?>

   


    <?php echo $form->field($model, 'show_time')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => Yii::t('app','Show Time')],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd hh:ii:ss'
            ]
        ]);
    ?>

    <?php echo $form->field($model, 'start_at')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => Yii::t('app','Start At')],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd hh:ii:ss'
            ]
        ]);
    ?>

    <?php echo $form->field($model, 'expire_at')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => Yii::t('app','Expire At')],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd hh:ii:ss'
            ]
        ]);
    ?>

    <?php echo $form->field($model, 'checked')->dropDownList(
        [
            '1' => '已發佈',
            '0' => '未發佈'
        ],
        ['prompt'=>'請選擇狀態','prompt_val'=>'']);; ?>


    <?php echo $form->field($model, 'posters_pictures')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreview'=>[
                ImageToolService::getUrlWithDefaultPath($model->posters_pictures)
            ],
            'initialPreviewAsData'=>true,
            'showUpload' => false,
            'initialPreviewConfig' => $imagesOptions,
            'overwriteInitial'=>true,
            'maxFileCount' => 1,
            'previewFileType' => 'image',
            'allowedFileExtensions'=>['jpg','jpeg','png'],
            'language'=>'zh-TW',
        ]
    ]); ?>

    

    <?php echo $form->field($model, 'url')->textInput(['maxlength' => true]); ?>

    <?php //echo $form->field($model, 'content')->textarea(['rows' => 6]); ?>

    <?php echo $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className(),[
        'clientOptions' => [ 
            'imageManagerJson' => ['/redactor/upload/image-json'], 
            'imageUpload' => ['/redactor/upload/image'], 
            'fileUpload' => ['/redactor/upload/file'], 
            'lang' => 'zh_tw', 
            'plugins' => ['clips', 'fontcolor','imagemanager'] 
        ] 
    ]); ?>

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

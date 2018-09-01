<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use yii\helpers\Url;
use app\services\ImageToolService;

/* @var $this yii\web\View */
/* @var $model app\models\Member */
/* @var $form yii\widgets\ActiveForm */

$url = Url::to(['image-sign/remove-image','id'=>1, 'do'=>'remove']);
$imagesOptions = array(array('caption' => $model->avatar?$model->avatar:'example.png', 'size' => 200 , 'url'=>$url, 'key'=>0));
?>

<div class="member-form">

    <?php $form = ActiveForm::begin(Yii::$app->params['form_upload_config']); ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList([
        '1' => '男',
        '2' => '女'
    ], ['prompt'=>'請選擇性別','prompt_val'=>''])  ?>

    <?php echo $form->field($model, 'avatar')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreview'=>[
                ImageToolService::getUrlWithDefaultPath($model->avatar)
            ],
            'initialPreviewAsData'=>true,
            'showUpload' => false,
            'initialPreviewConfig' => $imagesOptions,
            'overwriteInitial'=>true,
            'maxFileCount' => 1,
            'language' => 'zh_TW',
            'previewFileType' => 'image',
            'allowedFileExtensions'=>['jpg','jpeg','png'],
            'maxImageWidth' => 160,
            'maxImageHeight' => 160,
            'minImageWidth' => 160,
            'minImageHeight' => 160,
            'language'=>'zh-TW',
        ],
    ]); ?>

    <?= $form->field($model, 'birthday')->widget(DatePicker::classname(), [ 
        'options' => ['placeholder' => ''], 
        'pluginOptions' => [ 
            'autoclose' => true, 
            'todayHighlight' => true, 
            'format' => 'yyyy-mm-dd', 
        ] 
    ]); ?>

    <?= $form->field($model, 'id_card')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        '1' => '啟用',
        '0' => '禁用'
    ], ['prompt'=>'請選擇狀態','prompt_val'=>'']) ?>

    <?= $form->field($model, 'user_type')->dropDownList([
        '0' => '未認證',
        '1' => '個人',
        '2' => '網紅',
    ], ['prompt'=>'請選擇用戶類型','prompt_val'=>'']) ?>

   

    <?= $form->field($model, 'invite_count')->textInput([
        'readonly' => 'readonly'
    ]) ?>

    <?= $form->field($model, 'created_at')->textInput([
        'readonly' => 'readonly'
    ]) ?>
    <?= $form->field($model, 'invite_code')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>

    <?= $form->field($model, 'promo_code')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>
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

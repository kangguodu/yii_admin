<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ImageSign */
/* @var $form yii\widgets\ActiveForm */


$url = Url::to(['image-sign/remove-image','id'=>$model->id, 'do'=>'remove']);
$imagesOptions = array(array('caption' => $model->cover?$model->cover:'example.png', 'size' => 200 , 'url'=>$url, 'key'=>0));
$imagesOptions2 = array(array('caption' => $model->background?$model->background:'example.png', 'size' => 200 , 'url'=>$url, 'key'=>0));

?>

<div class="image-sign-form">

    <?php $form = ActiveForm::begin([
            'options' => [
                    'class' => 'form-horizontal',
                    'enctype'=>'multipart/form-data'
            ],
            'fieldConfig' => [  //统一修改字段的模板
                 'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-3\">{error}</div>",
                 'labelOptions' => ['class' => 'col-lg-2 control-label'],  //修改label的样式
            ],
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textArea(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'start_at')->widget(DatePicker::classname(), [ 
        'options' => ['placeholder' => ''], 
        'value' => date('d-M-Y'),
        'pluginOptions' => [
            'autoclose' => true, 
            'todayHighlight' => true, 
            'format' => 'yyyy-mm-dd', 
        ] 
    ]); ?>

    <?php echo $form->field($model, 'end_at')->widget(DatePicker::classname(), [ 
        'options' => ['placeholder' => ''], 
        'pluginOptions' => [ 
            'autoclose' => true, 
            'todayHighlight' => true, 
            'format' => 'yyyy-mm-dd', 
        ] 
    ]); ?>

    
    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

<!--    --><?php //echo $form->field($model, 'cover')->widget(FileInput::classname(), [
//        'options' => ['accept' => 'image/*'],
//        'pluginOptions' => [
//            'initialPreview'=>[
//                Yii::$app->params['meme_host'].$model->cover,
//            ],
//            'initialPreviewAsData'=>true,
//            'initialPreviewConfig' => $imagesOptions,
//            'showUpload' => false,
//            'overwriteInitial'=>true,
//            'maxFileCount' => 1,
//            'language' => 'zh_TW',
//            'previewFileType' => 'image',
//            'allowedFileExtensions'=>['jpg','jpeg','png']
//        ]
//    ]); ?>

    <?php echo $form->field($model, 'background')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreview'=>[
                Yii::$app->params['meme_host'].$model->background,
            ],
            'initialPreviewAsData'=>true,
            'showUpload' => false,
            'initialPreviewConfig' => $imagesOptions2,
            'overwriteInitial'=>true,
            'maxFileCount' => 1,
            'language' => 'zh_TW',
            'previewFileType' => 'image',
            'allowedFileExtensions'=>['jpg','jpeg','png']
        ]
    ]); ?>

    <?= $form->field($model, 'can_apply',[
        'template' => "<div class=\"col-lg-offset-2 col-lg-8\">{input}</div>\n<div class=\"col-lg-2\">{error}</div>",
    ])->checkbox() ?>
    <?= $form->field($model, 'showat_download',[
        'template' => "<div class=\"col-lg-offset-2 col-lg-8\">{input}</div>\n<div class=\"col-lg-2\">{error}</div>",
    ])->checkbox() ?>
    
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

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\file\FileInput;
use app\services\ImageToolService;

use app\models\Activity;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Notice */
/* @var $form yii\widgets\ActiveForm */
$url = Url::to(['image-sign/remove-image','id'=>1, 'do'=>'remove']);
$imagesOptions = array(array('caption' => $model->icon?$model->icon:'example.png', 'size' => 200 , 'url'=>$url, 'key'=>0));

$stores = ArrayHelper::map(Activity::find()->where(['platform_type' => 1])->all(), 'id', 'title');
?>

<div class="notice-form">

    <?php $form = ActiveForm::begin(Yii::$app->params['form_upload_config']); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_id')->dropDownList(noticeTypes(),
        ['prompt'=>'請選擇类型','prompt_val'=>'']); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'point_id')->widget(Select2::class, [
        'data' => $stores,
        'language' => 'zh_TW',
        'options' => ['placeholder' => '請選擇活动'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>


    <?php echo $form->field($model, 'icon')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreview'=>[
                ImageToolService::getUrlWithDefaultPath($model->icon)
            ],
            'initialPreviewAsData'=>true,
            'showUpload' => false,
            'initialPreviewConfig' => $imagesOptions,
            'overwriteInitial'=>true,
            'maxFileCount' => 1,
            'language' => 'zh_TW',
            'previewFileType' => 'image',
            'allowedFileExtensions'=>['jpg','jpeg','png']
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

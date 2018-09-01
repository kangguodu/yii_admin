<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Store;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\file\FileInput;
use app\services\ImageToolService;

/* @var $this yii\web\View */
/* @var $model app\models\Goods */
/* @var $form yii\widgets\ActiveForm */
$stores = ArrayHelper::map(Store::find()->all(), 'id', 'name');

$url = Url::to(['image-sign/remove-image','id'=>1, 'do'=>'remove']);
$imagesOptions = array(array('caption' => $model->image?$model->image:'example.png', 'size' => 200 , 'url'=>$url, 'key'=>0));
?>

<div class="goods-form">

    <?php $form = ActiveForm::begin(Yii::$app->params['active_form_config']); ?>

    <?php echo $form->field($model, 'store_id')->widget(Select2::classname(), [
        'data' => $stores,
        'language' => 'zh_TW',
        'disabled' => false,
        'options' => ['placeholder' => ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?= $form->field($model, 'goods_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

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

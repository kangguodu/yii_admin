<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\file\FileInput;
use app\services\ImageToolService;
use app\models\Store;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\touchspin\TouchSpin;
use app\assets\AppAsset;
AppAsset::register($this);
AppAsset::addScript($this, Yii::$app->request->baseUrl . '/js/layui.js');
AppAsset::addScript($this, Yii::$app->request->baseUrl . '/js/banner.js');
/* @var $this yii\web\View */
/* @var $model app\models\Banner */
/* @var $form yii\widgets\ActiveForm */

$url = Url::to(['image-sign/remove-image','id'=>1, 'do'=>'remove']);
$imagesOptions = array(array('caption' => $model->image_url?$model->image_url:'example.png', 'size' => 200 , 'url'=>$url, 'key'=>0));

$stores = ArrayHelper::map(Store::find()->all(), 'id', 'name');

$use_types = bannerUseTypes();

if($home_page_count >= 2 && $model->id <= 0){
    unset($use_types[2]);
    $model->use_type = 1;
}

?>
<div class="alert alert-info">
    首頁滾動圖片的尺寸:500*300,首頁廣告位圖片的尺寸:400*200
</div>
<div class="banner-form">

    <?php $form = ActiveForm::begin(Yii::$app->params['form_upload_config']); ?>

    <?php echo $form->field($model, 'use_type')->dropDownList($use_types, 
        ['prompt'=>'請選擇顯示位置','prompt_val'=>'']);  ?>

    <?php echo $form->field($model, 'type')->dropDownList(bannerTypes(), 
        ['prompt'=>'請選擇類型','prompt_val'=>'']); ?>

    <?php echo $form->field($model, 'store_id')->widget(Select2::classname(), [
        'data' => $stores,
        'language' => 'zh_TW',
        'options' => ['placeholder' => '請選擇店鋪'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'app_page')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'image_url')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreview'=>[
                ImageToolService::getUrlWithDefaultPath($model->image_url)
            ],
            'initialPreviewAsData'=>true,
            'showUpload' => false,
            'initialPreviewConfig' => $imagesOptions,
            'overwriteInitial'=>true,
            'maxFileCount' => 1,
            'previewFileType' => 'image',
            'allowedFileExtensions'=>['jpg','jpeg','png'],
            'maxImageWidth' => 500,
            'maxImageHeight' => 300,
            'minImageWidth' => 400,
            'minImageHeight' => 200,
            'language'=>'zh-TW',
        ]
    ]); ?>

    <?php echo $form->field($model, 'rank')->widget(TouchSpin::classname(),[
        'options' => ['placeholder' => Yii::t('app','Rank')],
        'pluginOptions' => ['step' => 1,'max' => 999999]
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

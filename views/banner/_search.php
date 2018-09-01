<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\BannerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-search">

    <?php $form = ActiveForm::begin(Yii::$app->params['search_form_config']); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type')->dropDownList(bannerTypes(), 
        ['prompt'=>'請選擇類型','prompt_val'=>'']); ?>

    <?php  echo $form->field($model, 'use_type')->dropDownList(bannerUseTypes(), 
        ['prompt'=>'請選擇顯示位置','prompt_val'=>'']); ?>

    <?php //echo $form->field($model, 'store_id') ?>

    <?php  //echo $form->field($model, 'region_id') ?>

    <?php //echo $form->field($model, 'image_url') ?>

    

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'app_page') ?>

   <div class="btn-group btn-group-sm">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

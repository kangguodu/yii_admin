<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\StoreType;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\search\StoreSearch */
/* @var $form yii\widgets\ActiveForm */

$storeTypes = ArrayHelper::map(StoreType::find()->all(), 'id', 'name');
?>

<div class="store-search">

    <?php $form = ActiveForm::begin(Yii::$app->params['search_form_config']); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php //echo $form->field($model, 'store_id') ?>

    <?php //echo $form->field($model, 'super_uid') ?>

    <?= $form->field($model, 'name') ?>

    <?php //echo $form->field($model, 'branchname') ?>

    <?php  //echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php  echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'company_name') ?>

    <?php // echo $form->field($model, 'company_tax_no') ?>

    <?php  echo $form->field($model, 'code') ?>

    <?php echo $form->field($model, 'type')->dropDownList($storeTypes, 
        ['prompt'=>'','prompt_val'=>'']); ?>

    <?php echo $form->field($model, 'status')->dropDownList(
        [
            '1' => '開店中',
            '0' => '已關店'
        ], 
        ['prompt'=>'','prompt_val'=>'']); ?>

    <?php // echo $form->field($model, 'type_name') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'service_status') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'avg_cost_status') ?>

    <?php // echo $form->field($model, 'avg_cost_low') ?>

    <?php // echo $form->field($model, 'avg_cost_high') ?>

    <?php // echo $form->field($model, 'facebook') ?>

    <?php // echo $form->field($model, 'instagram') ?>

    <?php // echo $form->field($model, 'google_keyword') ?>

    <?php // echo $form->field($model, 'coordinate') ?>

    <?php // echo $form->field($model, 'lat') ?>

    <?php // echo $form->field($model, 'lng') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'email_valid') ?>

    <?php // echo $form->field($model, 'routine_holiday') ?>

    <?php // echo $form->field($model, 'special_holiday') ?>

    <?php // echo $form->field($model, 'special_business_day') ?>

    <?php // echo $form->field($model, 'is_return') ?>

    <?php // echo $form->field($model, 'search_keyword') ?>

    <?php // echo $form->field($model, 'recommend_rank') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'service') ?>

    <div class="btn-group btn-group-sm">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

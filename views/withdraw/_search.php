<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\WithdrawSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="withdraw-search">

    <?php $form = ActiveForm::begin(Yii::$app->params['search_form_config']); ?>


    <?= $form->field($model, 'store_id') ?>

    <?= $form->field($model, 'uid') ?>

    <?php echo $form->field($model, 'type')->dropDownList(withdrawTypes(),
        ['prompt'=>'請選擇类型','prompt_val'=>'']); ?>

    <?php // echo $form->field($model, 'service_charge') ?>

    <?php  echo $form->field($model, 'status')->dropDownList(withdrawStatus(),
        ['prompt'=>'請選擇状态','prompt_val'=>'']); ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'bank_name') ?>

    <?php // echo $form->field($model, 'receiver_name') ?>

    <?php // echo $form->field($model, 'bank_account') ?>

    <?php // echo $form->field($model, 'bank_phone') ?>

    <?php // echo $form->field($model, 'handle_note') ?>

    <?php // echo $form->field($model, 'handle_date') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="btn-group btn-group-sm">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\MemberSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-search">

    <?php $form = ActiveForm::begin(Yii::$app->params['search_form_config']); ?>

    <?= $form->field($model, 'id') ?>

    <?php //echo $form->field($model, 'phone') ?>

    <?php //echo $form->field($model, 'zone') ?>

    <?php //echo $form->field($model, 'password') ?>

    <?= $form->field($model, 'username') ?>

    <?php  echo $form->field($model, 'nickname') ?>

    <?php  echo $form->field($model, 'email') ?>

    <?php  echo $form->field($model, 'gender')->dropDownList([
                    '1' => '男',
                    '2' => '女'
                ], 
        ['prompt'=>'','prompt_val'=>'']); ?>

    <?php // echo $form->field($model, 'avatar') ?>

    <?php // echo $form->field($model, 'birthday') ?>

    <?php // echo $form->field($model, 'id_card') ?>

    <?php  echo $form->field($model, 'status')->dropDownList([
                    '1' => '啟用',
                    '0' => '禁用'
                ], 
        ['prompt'=>'','prompt_val'=>'']); ?>

    <?php // echo $form->field($model, 'groupid') ?>

    <?php  echo $form->field($model, 'user_type')->dropDownList([
                    '0' => '未認證',
                    '1' => '個人',
                    '2' => '網紅'
                ], 
        ['prompt'=>'','prompt_val'=>'']); ?>

    <?php // echo $form->field($model, 'secure_status') ?>

    <?php // echo $form->field($model, 'secure_password') ?>

    <?php // echo $form->field($model, 'invite_code') ?>

    <?php // echo $form->field($model, 'promo_code') ?>

    <?php // echo $form->field($model, 'invite_count') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'token') ?>

    <?php // echo $form->field($model, 'code_type') ?>

    <?php // echo $form->field($model, 'honor') ?>

    <div class="btn-group btn-group-sm">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

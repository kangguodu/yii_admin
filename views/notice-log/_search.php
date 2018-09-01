<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\NoticeLogSearch */
/* @var $form yii\widgets\ActiveForm */
$types = noticeLogTypes();
unset($types[2]);
?>

<div class="notice-log-search">

    <?php $form = ActiveForm::begin(Yii::$app->params['search_form_config']); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'type')->dropDownList($types,
        ['prompt'=>'請選擇类型','prompt_val'=>'']); ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'point_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="btn-group btn-group-sm">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

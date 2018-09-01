<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\ImageSignApplySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="image-sign-apply-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
         'options' => [
                    'class' => ''
            ],
            'fieldConfig' => [  //统一修改字段的模板
                 'template' => "{label}\n{input}\n",
                 'labelOptions' => ['class' => 'input-group-addon'],  //修改label的样式
                 'options' => [
                    'class' => 'input-group input-group-sm',
                ],
            ],
    ]); ?>


    <?= $form->field($model, 'store_id') ?>

    <?php //echo $form->field($model, 'other_remark') ?>

    <?php //echo $form->field($model, 'created_at') ?>

    <?php //echo $form->field($model, 'updated_at') ?>

    <?php  echo $form->field($model, 'status')->dropDownList([
        '1' => '待處理',
        '2' => '處理中',
        '3' => '完成',
        '4' => '取消',
    ], ['prompt'=>'請選擇狀態','prompt_val'=>'']); ?>

    <?php // echo $form->field($model, 'cancel_reason') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'imagesign_carriage') ?>

    <div class="btn-group btn-group-sm">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

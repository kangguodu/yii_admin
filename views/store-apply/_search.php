<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\StoreApplySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-apply-search">

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

    <?= $form->field($model, 'status')->dropDownList([
        '0' => '待審核',
        '1' => '已處理'
    ], ['prompt'=>'請選擇狀態','prompt_val'=>'']) ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'company_name') ?>

    <?php // echo $form->field($model, 'company_tax_no') ?>

    <?php // echo $form->field($model, 'type_name') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'other') ?>
    <div class="btn-group btn-group-sm">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

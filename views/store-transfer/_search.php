<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\StoreTransferSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-transfer-search">

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

    <?= $form->field($model, 'status')->dropDownList([
       'pending' => '待處理',
        'processing' => '處理中',
        'cancelled' => '已取消',
        'refunded' => '退還',
        'completed' => '處理完成',
    ], ['prompt'=>'請選擇狀態','prompt_val'=>'']) ?>

    <div class="btn-group btn-group-sm">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

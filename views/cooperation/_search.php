<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\CooperationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cooperation-search">

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

    <div class="btn-group btn-group-sm">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

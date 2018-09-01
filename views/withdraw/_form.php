<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Withdraw */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="withdraw-form">

    <?php $form = ActiveForm::begin(Yii::$app->params['active_form_config']); ?>

    <?php echo $form->field($model, 'type')->dropDownList(withdrawTypes(),
        ['prompt'=>'請選擇类型','prompt_val'=>'','disabled' => 'disabled']); ?>

    <?= $form->field($model, 'store_id')->textInput(['readonly' => 'readonly']) ?>

    <?= $form->field($model, 'uid')->textInput(['readonly' => 'readonly']) ?>

    <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receiver_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'service_charge')->textInput(['maxlength' => true]) ?>

    <?php  echo $form->field($model, 'status')->dropDownList(withdrawStatus(),
        ['prompt'=>'請選擇状态','prompt_val'=>'']); ?>


    <?= $form->field($model, 'handle_note')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'handle_date')->widget(DateTimePicker::class, [
        'options' => ['placeholder' => Yii::t('app','Start At')],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:ss'
        ]
    ]);
    ?>

    <?= $form->field($model, 'created_at')->textInput(['readonly' => 'readonly']) ?>

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

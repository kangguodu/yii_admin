<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */

$disable = [];

if(intval($model->id) > 0 && intval($model->status) !== 0){
    $disable['disabled'] = 'disabled';
}

?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(Yii::$app->params['active_form_config']); ?>

    <?= $form->field($model, 'order_no')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>

    <?= $form->field($model, 'date')->textInput(['readonly'=>'readonly']) ?>

    <?= $form->field($model, 'store_id')->textInput(['readonly'=>'readonly']) ?>

    <?= $form->field($model, 'store_name')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>

    <?= $form->field($model, 'member_id')->textInput(['readonly'=>'readonly']) ?>

    <?= $form->field($model, 'amount')->textInput(['readonly'=>'readonly']) ?>



    <?= $form->field($model, 'status')->dropDownList(
        getOrderStatus(), 
        array_merge(['prompt'=>'','prompt_val'=>''],$disable)); ?>



    <?= $form->field($model, 'created_at')->textInput(['readonly'=>'readonly']) ?>

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

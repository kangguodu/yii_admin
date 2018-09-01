<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\touchspin\TouchSpin;
/* @var $this yii\web\View */
/* @var $model app\models\HotWord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hot-word-form">

    <?php $form = ActiveForm::begin(Yii::$app->params['active_form_config']); ?>

    <?= $form->field($model, 'hot_word')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'number')->widget(TouchSpin::classname(),[
        'options' => ['placeholder' => Yii::t('app','Hot Word Search Count')],
        'pluginOptions' => ['step' => 1,'max' => 99999999]
    ]); ?>
    
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

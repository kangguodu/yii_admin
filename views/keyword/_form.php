<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Keyword */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="keyword-form">

    <?php $form = ActiveForm::begin(Yii::$app->params['active_form_config']); ?>

    <?= $form->field($model, 'hot_word')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput() ?>

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

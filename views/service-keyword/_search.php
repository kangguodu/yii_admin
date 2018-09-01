<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\ServiceKeywordSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-keyword-search">

    <?php $form = ActiveForm::begin(Yii::$app->params['search_form_config']); ?>


    <?= $form->field($model, 'keyword') ?>


    <div class="btn-group btn-group-sm">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>

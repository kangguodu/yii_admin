<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\ActivitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-search">

    <?php $form = ActiveForm::begin(Yii::$app->params['search_form_config']); ?>

    <?php echo $form->field($model, 'title') ?>

    <?php echo $form->field($model, 'type')->dropDownList(activityTypes(), 
        ['prompt'=>'請選擇類型','prompt_val'=>'']); ?>

    <?php echo $form->field($model, 'platform_type')->dropDownList(activityPlatformTypes(),
         ['prompt'=>'請選擇平臺類型','prompt_val'=>'']); ?>


    <div class="btn-group btn-group-sm">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

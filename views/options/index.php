<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Options */
/* @var $form ActiveForm */

$this->title = Yii::t('app', 'System Setting');
$this->params['breadcrumbs'][] = Yii::t('app', 'System Setting');
?>

<div class="options-index">

    <?php $form = ActiveForm::begin(Yii::$app->params['form_upload_config']); ?>
    <?php echo Yii::$app->params['content_common_start'];?>
        <?= $form->field($model, 'imagesign_carriage') ?>

    <div class="box-footer">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="btn-group pull-right">
                <?= Html::submitButton(Yii::t('app','save'), [
                        'class' => 'btn btn-info pull-right']) ?>
            </div>
            <div class="btn-group pull-left">
                <?php echo Html::resetButton(Yii::t('app','reset'),[
                        'class' => 'btn btn-warning'
                ])?>
            </div>
        </div>
    </div>
    <?php echo Yii::$app->params['content_common_end'];?>
    <?php ActiveForm::end(); ?>

</div><!-- options-index -->

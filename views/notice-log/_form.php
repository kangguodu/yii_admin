<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Activity;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\NoticeLog */
/* @var $form yii\widgets\ActiveForm */

$stores = ArrayHelper::map(Activity::find()->where(['platform_type' => 2])->all(), 'id', 'title');

$noticeTypes = noticeLogTypes();
unset($noticeTypes[2]);
unset($noticeTypes[3]);
?>

<div class="notice-log-form">

    <?php $form = ActiveForm::begin(Yii::$app->params['form_upload_config']); ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList($noticeTypes,
        ['prompt'=>'請選擇类型','prompt_val'=>'']); ?>

    <?= $form->field($model, 'content')->textarea(['maxlength' => true]) ?>

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
    <?= $form->field($model, 'url')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'point_id')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'platform_type')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'updated_at')->hiddenInput()->label(false) ?>

    <?php ActiveForm::end(); ?>

</div>

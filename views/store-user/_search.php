<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Store;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\search\StoreUserSearch */
/* @var $form yii\widgets\ActiveForm */
$stores = ArrayHelper::map(Store::find()->all(), 'id', 'name');
?>

<div class="store-user-search">

    <?php $form = ActiveForm::begin(Yii::$app->params['search_form_config']); ?>

    <?= $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'store_id')->widget(Select2::classname(), [
        'data' => $stores,
        'language' => 'zh_TW',
        'options' => ['placeholder' => ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?= $form->field($model, 'nickname') ?>

    <?= $form->field($model, 'mobile') ?>

    <?php echo $form->field($model, 'super_account')->dropDownList(yesOrNoTypes(), 
        ['prompt'=>'','prompt_val'=>'']); ?>

    <?php // echo $form->field($model, 'zone') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'permission') ?>

    <?php // echo $form->field($model, 'email_status') ?>

    <?php // echo $form->field($model, 'token') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'super_account') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'menus') ?>

    <div class="btn-group btn-group-sm">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Store;
use app\models\Member;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\search\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
$stores = ArrayHelper::map(Store::find()->all(), 'id', 'name');
$members = ArrayHelper::map(Member::find()->all(), 'id', 'nickname');
?>

<div class="orders-search">

    <?php $form = ActiveForm::begin(Yii::$app->params['search_form_config']); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'order_no') ?>


     <?php echo $form->field($model, 'store_id')->widget(Select2::classname(), [
        'data' => $stores,
        'language' => 'zh_TW',
        'options' => ['placeholder' => ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?php echo $form->field($model, 'member_id')->widget(Select2::classname(), [
        'data' => $members,
        'language' => 'zh_TW',
        'options' => ['placeholder' => ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('會員');?>

    <?php // echo $form->field($model, 'store_name') ?>


    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'credits') ?>

    <?php // echo $form->field($model, 'coupons_id') ?>

    <?php // echo $form->field($model, 'coupons_money') ?>

    <?php // echo $form->field($model, 'prate') ?>

    <?php // echo $form->field($model, 'mfixedrate') ?>

    <?php // echo $form->field($model, 'mrate') ?>

    <?php // echo $form->field($model, 'promoreate') ?>
    
    <?php echo $form->field($model, 'status')->dropDownList(getOrderStatus(), 
        ['prompt'=>'','prompt_val'=>'']); ?>
    <?php // echo $form->field($model, 'checkout_at') ?>

    <?php // echo $form->field($model, 'checkout_user_id') ?>

    <?php // echo $form->field($model, 'refund_at') ?>

    <?php // echo $form->field($model, 'refund_user_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'is_evaluate') ?>

    <div class="btn-group btn-group-sm">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

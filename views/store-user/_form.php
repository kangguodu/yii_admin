<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Store;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\StoreUser */
/* @var $form yii\widgets\ActiveForm */
$stores = ArrayHelper::map(Store::find()->all(), 'id', 'name');
$disabled = $model->super_account?['disabled' => 'disabled']:[];
?>

<div class="store-user-form">

    <?php $form = ActiveForm::begin(Yii::$app->params['active_form_config']); ?>

    <?php echo $form->field($model, 'store_id')->widget(Select2::classname(), [
        'data' => $stores,
        'language' => 'zh_TW',
        'disabled' => $model->super_account > 0 ? true:false,
        'options' => ['placeholder' => ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    

   

    <?php echo $form->field($model, 'position')->dropDownList(storeUserPosition(), 
        array_merge($disabled,['prompt'=>'','prompt_val'=>''])); ?>

    <?php echo $form->field($model, 'menus')->checkboxList(storeUserMenus(),  [
        'item' => function($index, $label, $name, $checked, $value) use($model) {
            $disable = false;
            if (intval($model->super_account) == 1) {
                $disable = true;
            }
            if($index==0 || $index==5){
                $disable = true;
                $checked = true;
            }

            $checkbox = Html::checkbox($name, $checked, ['value' => $value, 'disabled' => $disable]);
            return  Html::label($checkbox . $label);
        }
    ]);?>

    <?= $form->field($model, 'password')->passwordInput([
        'maxlength' => true,
        'placeholder' => $model->id > 0?'不修改密碼請留空':'',
    ]) ?>


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
    <?= $form->field($model, 'super_account')->hiddenInput(['maxlength' => true])->label(false); ?>
    <?php ActiveForm::end(); ?>

</div>

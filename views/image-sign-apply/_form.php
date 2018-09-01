<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImageSignApply */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="image-sign-apply-form">

    <?php $form = ActiveForm::begin([
            'options' => [
                    'class' => 'form-horizontal'
            ],
            'fieldConfig' => [  //统一修改字段的模板
                 'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-3\">{error}</div>",
                 'labelOptions' => ['class' => 'col-lg-2 control-label'],  //修改label的样式
            ],
    ]); ?>

    <?= $form->field($model, 'store_id')->textInput(['readonly' => 'readonly']) ?>

    <?= $form->field($model, 'other_remark')->textInput(['maxlength' => true]) ?>

  

    <?= $form->field($model, 'status')->dropDownList(
        [ 
            '1' => '待處理',
            '2' => '處理中',
            '3' => '完成',
            '4' => '取消',
        ], ['prompt' => '請選擇狀態']); ?>

    <?= $form->field($model, 'cancel_reason')->textInput(['maxlength' => true,'placeholder' => '狀態為:取消時，請填寫取消原因']) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imagesign_carriage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput(['readonly' => 'readonly']) ?>

    <?= $form->field($model, 'updated_at')->textInput(['readonly' => 'readonly']) ?>

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

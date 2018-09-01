<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Login */

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

?>
<div class="login-box">
    <div class="login-logo">
        <a href="#"><strong>MEMECOINS</strong></a>
    </div>

    <p><?php echo Yii::t('app','Login tip');?>:</p>
    <div class="login-box-body">

              <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

              <?= $form
                  ->field($model, 'username', $fieldOptions1)
                  ->label(false)
                  ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

              <?= $form
                  ->field($model, 'password', $fieldOptions2)
                  ->label(false)
                  ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

              <div class="row">
                  <!-- /.col -->
                  <div class="col-xs-4 col-xs-offset-8">
                      <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                  </div>
                  <!-- /.col -->
              </div>


              <?php ActiveForm::end(); ?>
    </div>
</div>

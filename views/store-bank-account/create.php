<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StoreBankAccount */

$this->title = Yii::t('app', 'Create Store Bank Account');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Store Bank Accounts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="store-bank-account-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>

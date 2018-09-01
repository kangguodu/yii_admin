<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Withdraw */

$this->title = Yii::t('app', 'Update Withdraw: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Withdraws'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="withdraw-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>
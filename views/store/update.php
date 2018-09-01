<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Store */

$this->title = Yii::t('app', 'Update Store: {nameAttribute}', [
    'nameAttribute' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="store-update">
	
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>

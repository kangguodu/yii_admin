<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */

$this->title = Yii::t('app', 'Update Activity: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="activity-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>
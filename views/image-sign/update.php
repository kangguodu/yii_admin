<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ImageSign */

$this->title = Yii::t('app', 'Update Image Sign: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Image Signs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="image-sign-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>

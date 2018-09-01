<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StoreBanner */

$this->title = Yii::t('app', 'Update Store Banner: {nameAttribute}', [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Store Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="store-banner-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>
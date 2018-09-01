<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StoreApply */

$this->title = Yii::t('app', 'Create Store Apply');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Store Applies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-apply-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

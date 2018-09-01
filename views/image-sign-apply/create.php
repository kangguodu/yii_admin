<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ImageSignApply */

$this->title = Yii::t('app', 'Create Image Sign Apply');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Image Sign Applies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-sign-apply-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

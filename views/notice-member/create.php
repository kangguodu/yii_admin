<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\NoticeMember */

$this->title = Yii::t('app', 'Create Notice Member');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notice Members'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notice-member-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OpenHourRange */

$this->title = Yii::t('app', 'Create Open Hour Range');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Open Hour Ranges'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="open-hour-range-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cooperation */

$this->title = Yii::t('app', 'Create Cooperation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cooperations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cooperation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

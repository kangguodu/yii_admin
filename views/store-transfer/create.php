<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StoreTransfer */

$this->title = Yii::t('app', 'Create Store Transfer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Store Transfers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-transfer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

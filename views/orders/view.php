<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'order_no',
            'order_sn',
            'month',
            'date',
            'store_id',
            'store_name',
            'member_id',
            'amount',
            'credits',
            'coupons_id',
            'coupons_money',
            'prate',
            'mfixedrate',
            'mrate',
            'promoreate',
            'status',
            'checkout_at',
            'checkout_user_id',
            'refund_at',
            'refund_user_id',
            'created_at',
            'updated_at',
            'updated_by',
            'number',
            'is_evaluate',
        ],
    ]) ?>

</div>

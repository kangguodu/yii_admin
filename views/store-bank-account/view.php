<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StoreBankAccount */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Store Bank Accounts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="store-bank-account-view">

    <p>
        <?= Html::a(Yii::t('app', 'back_to_list'), ['index'], ['class' => 'btn btn-primary']) ?>
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
            'store_id',
            'store_name',
            'bank_name',
            'receiver_name',
            'bank_account',
            'bank_phone',
            'region',
            'branch_name',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model){
                    $text = getDisableOrNotTypeText($model->status);
                    return $model->status?'<span class="label label-success">'.$text.'</span>':'<span class="label label-danger">'.$text.'</span>';
                }
            ],
            'created_at',
        ],
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>
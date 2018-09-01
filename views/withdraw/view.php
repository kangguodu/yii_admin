<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Withdraw */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Withdraws'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="withdraw-view">

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
            [
                'attribute' => 'type',
                'format' => 'raw',
                'value' => function($model){
                    $tempClass = '';
                    if($model->type == 1){
                        $tempClass = 'type-store';
                    }else if($model->type == 2){
                        $tempClass = 'type-member';
                    }
                    return '<span class="'.$tempClass.'">'.getwithdrawTypeText($model->type).'</span>';
                }
            ],
            [
                'attribute' => 'object_id',
                'format' => 'raw',
                'value' => function($model){
                    $tempText = '';
                    $tempClass = '';
                    if($model->type == 1){
                        $tempClass = 'type-store';
                        $tempText = $model->store_id;
                    }else if($model->type == 2){
                        $tempClass = 'type-member';
                        $tempText = $model->uid;
                    }
                    return '<span class="'.$tempClass.'">'.$tempText.'</span>';
                }
            ],
            [
                'attribute' => 'object_name',
                'format' => 'raw',
                'value' => function($model){
                    $tempText = '';
                    $tempClass = '';
                    if($model->type == 1){
                        $tempClass = 'type-store';
                        $tempText = $model->store_name;
                    }else if($model->type == 2){
                        $tempClass = 'type-member';
                        $tempText = $model->nickname;
                    }
                    return '<span class="'.$tempClass.'">'.$tempText.'</span>';
                }
            ],

            'bank_name',
            'receiver_name',
            'bank_account',
            'bank_phone',
            'amount',
            'remark',
            //'service_charge',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model){
                    $tempClass = '';
                    if($model->status <= 0){
                        $tempClass = 'blue';
                    }else if($model->status == 1){
                        $tempClass = 'green';
                    }else if($model->status == 2){
                        $tempClass = 'red';
                    }
                    return '<span class="'.$tempClass.'">'.getwithdrawStatusText($model->status).'</span>';
                }
            ],
            'handle_date',
            'handle_note',
            'created_at',
        ],
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>
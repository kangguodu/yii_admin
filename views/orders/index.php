<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_list_start'];?>

<div class="box-header">
    <div class="pull-right">
        <div class="form-inline pull-right">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="btn-group pull-right" style="margin-right: 10px">
            <?php //echo Html::a(Yii::t('app', 'Create Orders'), ['create'], ['class' => 'btn btn-sm btn-success']); ?>
        </div>
    </div>
</div>
<div class="box-body table-responsive pad">
<div class="orders-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'headerOptions' => ['width' => '50'],
            ],
            'order_no',
            //'order_sn',
            //'month',
            //'date',
            //'store_id',
            'store_name',
            'member_id',
            'nickname',
            'amount',
            //'credits',
            //'coupons_id',
            //'coupons_money',
            'prate',
            //'mfixedrate',
            'mrate',
            'promoreate',
            [
                'attribute' => 'status',
                'format'=>'raw',
                'value' => function($model){
                    $text = getOrderStatusText($model->status);
                    $labelClass = '';
                    if($model->status <= -1){
                        $labelClass = 'warning';
                    }else if($model->status === 0){
                        $labelClass = 'primary';
                    }else if($model->status === 1){
                        $labelClass = 'success';
                    }else if($model->status === 2){
                        $labelClass = 'default';
                    }
                    return '<span class="label label-'.$labelClass.'">'.$text.'</span>';
                }
            ],
            //'checkout_at',
            //'checkout_user_id',
            //'refund_at',
            //'refund_user_id',
            'created_at',
            //'updated_at',
            //'updated_by',
            //'number',
            //'is_evaluate',

            [
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '80'],
            ],
        ],
    ]); ?>
</div>
</div>
<?php echo Yii::$app->params['content_list_end'];?>
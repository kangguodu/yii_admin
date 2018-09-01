<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\WithdrawSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Withdraws');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs($this->render('_index.js'));
?>
<?php echo Yii::$app->params['content_list_start'];?>

<div class="box-header">
    <div class="pull-right">
        <div class="form-inline pull-right">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="btn-group pull-right" style="margin-right: 10px">
            <?php //echo Html::a(Yii::t('app', 'Create Withdraw'), ['create'], ['class' => 'btn btn-sm btn-success']); ?>
        </div>
    </div>
</div>
<div class="box-body table-responsive pad">
<div class="withdraw-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

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
           // 'remark',
            //'service_charge',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model){
                    $tempClass = '';
                    if($model->status <= 0){
                        $tempClass = 'info';
                    }else if($model->status == 1){
                        $tempClass = 'success';
                    }else if($model->status == 2){
                        $tempClass = 'danger';
                    }
                    return '<span class="label label-'.$tempClass.'">'.getwithdrawStatusText($model->status).'</span>';
                }
            ],
           // 'handle_date',
            //'handle_note',
            'created_at',

            [
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{complete} {cancel} {view} {update} {delete}',
                'buttons' => [
                    'complete' => function ($url, $model, $key) {
                        if($model->status <= 0){
                            return  Html::a('<span class="fa fa-check"></span>', $url, ['title' => '通过','data' => [
                                'method' => 'post',
                                'confirm' => '将扣取对方提现金额,您確定要处理完成嗎？',
                                'pjax' => 0
                            ]] );
                        }

                    },
                    'cancel' => function ($url, $model, $key) {
                        if($model->status <= 0) {
                            return Html::a('<span class="fa fa-times"></span>', $url, ['title' => '取消']);
                        }
                    }
                ],
                'headerOptions' => ['width' => '120'],
            ],
        ],
    ]); ?>
</div>
</div>
<?php echo Yii::$app->params['content_list_end'];?>
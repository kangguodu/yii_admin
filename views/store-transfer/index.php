<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\StoreTransferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Store Transfers');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_list_start'];?>

<div class="box-header">
    <div class="pull-right">
        <div class="form-inline pull-right">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>
</div>

<div class="box-body table-responsive pad">

<div class="store-transfer-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'store_id',
            'transfer_date',
            'accounts_no',
            'amount',
            [
                'attribute' => 'attachment',
                'format'=>'raw',
                'value' => function($model){
                    $image_path = $model->attachment?Yii::$app->params['meme_host'].$model->attachment:Yii::$app->params['member_avatar'];
                    return Html::img($image_path,['alt' => '附件','width' => 30]);
                }
            ],
            [
                'attribute' => 'status',
                'value'=>function($model){
                    $status = $model->status;
                    $statuses = array(
                        'pending' => '待處理',
                        'processing' => '處理中',
                        'cancelled' => '已取消',
                        'refunded' => '退還',
                        'completed' => '處理完成'
                    );
                    if(array_key_exists($status, $statuses)){
                        return $statuses[$status];
                    }else{
                        return '';
                    }
                }
            ],
            'created_by',
            'created_at',
            //'updated_at',
            //'updated_by',

            [
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{pending} {process} {refunded} {completed} {cancel} {delete}',
                'buttons' => [
                    'pending' => function ($url, $model, $key) {
                        $status_show = array('processing','refunded');
                        if(in_array($model->status, $status_show)){
                            return  Html::a('重新處理', $url, ['title' => '重新處理'] );
                        }else{
                            return '';
                        }                       
                    },
                    'process' => function ($url, $model, $key) {
                        $status_show = array('pending');
                        if(in_array($model->status, $status_show)){
                            return  Html::a('通過', $url, ['title' => '通過'] );
                        }else{
                            return '';
                        }                         
                    },
                    'cancel' => function ($url, $model, $key) {
                        $status_show = array('pending');
                        if(in_array($model->status, $status_show)){
                            return  Html::a('取消', $url, ['title' => '取消'] );
                        }else{
                            return '';
                        }     
                    },
                    'refunded' => function ($url, $model, $key) {
                        return $model->status == 'pending' ? 
                            Html::a('退還', $url, ['title' => '退還'] ) : ''; 
                         
                    },
                    'completed' => function ($url, $model, $key) {
                        $status_show = array('processing','refunded');
                        if(in_array($model->status, $status_show)){
                            return  Html::a('完成', $url, ['title' => '完成'] );
                        }else{
                            return '';
                        }   
                         
                    },
                    'delete' => function ($url, $model, $key) {
                        $status_show = array('cancelled','completed');
                        if(in_array($model->status, $status_show)){
                            return  Html::a('刪除', $url, ['title' => '刪除','data' => [
                                        'method' => 'post',
                                        'confirm' => '您確定要刪除此項嗎？',
                                        'pjax' => 0
                                    ]] );
                        }else{
                            return '';
                        }                       
                    },
                ],
                'headerOptions' => ['width' => '120'],
            ],
        ],
    ]); ?>
</div>
</div>
<?php echo Yii::$app->params['content_list_end'];?>
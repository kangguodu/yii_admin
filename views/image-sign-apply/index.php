<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ImageSignApplySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Image Sign Applies');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs($this->render('_index.js'));

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
<div class="image-sign-apply-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'store_id',
            'other_remark',
            [
                'attribute' => 'status',
                'value' => function($model){
                    if($model->status == 1){
                        return '待處理';
                    }else if($model->status == 2){
                        return '處理中';
                    }else if($model->status == 3){
                        return '完成';
                    }else if($model->status == 4){
                        return '取消';
                    }
                }
            ],
            'created_at',
            //'updated_at',
            
            //'cancel_reason',
            //'address',
            //'imagesign_carriage',

            [
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{complete} {view} {update} {delete}',
                'headerOptions' => ['width' => '90'],
                'buttons' => [
                    'complete' => function ($url, $model, $key) {
                        if($model->status == 1){
                            return  Html::a('<span class="fa fa-check completejob"></span>', $url, ['title' => '通過',
                                'data' => [
                                        'method' => 'post',
                                        'confirm' => '您確認通過該立牌訂單申請嗎？',
                                        'pjax' => 0
                                    ]
                                ] );
                        }else{
                            return '';
                        }                       
                    }
                ]
            ],
        ],
    ]); ?>
</div>
</div>
<?php echo Yii::$app->params['content_list_end'];?>
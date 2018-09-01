<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\StoreUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Store Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_list_start'];?>

<div class="box-header">
    <div class="pull-right">
        <div class="form-inline pull-right">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="btn-group pull-right" style="margin-right: 10px">
            <?php if(isset($searchModel->store_id) && $searchModel->store_id > 0){ ?>
            <?php echo Html::a(Yii::t('app', 'Create Current Store User'), ['create','store_id' => $searchModel->store_id ], ['class' => 'btn btn-sm btn-success']); ?>
            <?php }?>
            <?php echo Html::a(Yii::t('app', 'Create Store User'), ['create'], ['class' => 'btn btn-sm btn-success']); ?>
        </div>
    </div>
</div>
<div class="box-body table-responsive pad">
<div class="store-user-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'store_id',
            'store_name',
            'nickname',
            //'email:email',
            'mobile',
            //'zone',
            //'password',
            //'permission',
            //'email_status:email',
            //'token',
            //'gender',
            
            'position',
            [
                'attribute' => 'super_account',
                'format'=>'raw',
                'value' => function($model){
                    return $model->super_account?'<span class="label label-success">是</span>':'<span class="label label-default">否</span>';
                }
            ],
            [
                'attribute' => 'created_at',
                'headerOptions' => ['width' => '150'],
                'value' => function($model){
                    return showIndexFormatDatetime($model->created_at);
                }
            ],
            [
                'attribute' => 'last_login',
                'headerOptions' => ['width' => '150'],
            ],
            //'menus:ntext',

            [
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'headerOptions' => ['width' => '70'],
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        if($model->super_account <= 0){

                          return  Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => Yii::t('app','Delete'),
                                'aria-label' => Yii::t('app','Delete'),
                                'data' => [
                                        'method' => 'post',
                                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                        'pjax' => 0
                                    ]] );
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
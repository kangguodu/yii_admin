<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\services\ImageToolService;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Members');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_list_start'];?>

<div class="box-header">
    <div class="pull-right">
        <div class="form-inline pull-right">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="btn-group pull-right" style="margin-right: 10px">
            <?php //echo Html::a(Yii::t('app', 'Create Banner'), ['create'], ['class' => 'btn btn-sm btn-success']); ?>
        </div>
    </div>
</div>
<div class="box-body table-responsive pad">
<div class="member-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
              'attribute' => 'id',
               'headerOptions' => ['style' => 'width:60px;'],
            ],
            [
                'attribute' => 'avatar',
                'format'=>'raw',
                'value' => function($model){
                    // $image_path = ImageToolService::getUrlWithDefaultPath($model->avatar);
                    // return Html::img($image_path,['alt' => '用戶頭像','width' => 30]);
                    return ImageToolService::getViewImageLink($model->avatar,'用戶頭像');
                },
                'headerOptions' => ['width' => '50'],
            ],
            [
              'attribute' => 'username',
            ],
            [
              'attribute' => 'nickname',
            ],
            [
              'attribute' => 'phone',
            ],
            [
              'attribute' => 'email',
              'format' => 'email',
            ],
            [
                'attribute' => 'gender',
                'value' => function($model){
                    return ($model->gender == 1)?'男':'女';
                },
                'filter' => [
                    '1' => '男',
                    '2' => '女'
                ],
                'headerOptions' => ['style' => 'width:50px;'],
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model){
                    return $model->status?'<span class="label label-success">啟用</span>':'<spanclass="label label-danger">禁用</span>';
                },
                'filter' => [
                    '1' => '啟用',
                    '0' => '禁用'
                ]
            ],
             [
                'attribute' => 'user_type',
                'value' => function($model){
                    $user_type = $model->user_type;
                    if($user_type <= 0){
                        return '未認證';
                    }elseif ($user_type == 1) {
                        return '個人';
                    }else if($user_type == 2){
                        return '網紅';
                    }
                },
                'filter' => [
                    '0' => '未認證',
                    '1' => '個人',
                    '2' => '網紅'
                ]
            ],
            ['attribute' => 'created_at','value'=>function($model){
                return date("m/d/y",strtotime($model->created_at));
            }],

            //'email:email',


            //'birthday',
            //'id_card',
            
            //'groupid',
            
            //'secure_status',
            //'secure_password',
            //'invite_code',
            //'promo_code',
            //'invite_count',
            
            //'updated_at',
            //'number',
            //'token',
            //'code_type',
            //'honor',
            ['header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '50'],
                'template' => '{update} {view}'
            ],
        ],
    ]); ?>
</div>
</div>
<?php echo Yii::$app->params['content_list_end'];?>

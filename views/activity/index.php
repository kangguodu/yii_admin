<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\services\ImageToolService;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Activities');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_list_start'];?>

<div class="box-header">
    <div class="pull-right">
        <div class="form-inline pull-right">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="btn-group pull-right" style="margin-right: 10px">
            <?php echo Html::a(Yii::t('app', 'Create Activity'), ['create'], ['class' => 'btn btn-sm btn-success']); ?>
        </div>
    </div>
</div>
<div class="box-body table-responsive pad">
<div class="activity-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'posters_pictures',
                'format'=>'raw',
                'value' => function($model){
                    // $image_path = ImageToolService::getUrlWithDefaultPath($model->posters_pictures);
                    // return Html::img($image_path,['alt' => Yii::t('app','Posters Pictures'),'style' => 'max-height:40px;']);
                    return ImageToolService::getViewImageLink($model->posters_pictures,Yii::t('app','Posters Pictures'));
                }
            ],
            'title',
            [
                'attribute' => 'type',
                'format'=>'raw',
                'value' => function($model){
                    $text = getActityTypeText($model->type);
                    if($model->type == 2){
                        return $text.' <span class="fa fa-external-link" aria-hidden="true"></span>';
                    }else if($model->type == 1){
                        return $text.' <span class="fa fa-file-text" aria-hidden="true"></span>';
                    }
                }
            ],
            [
                'attribute' => 'platform_type',
                'value' => function($model){
                    return getActityPlatformText($model->platform_type);
                }
            ],
            'start_at',
            'expire_at',
            //'show_time',
            //'created_at',
            'created_by',
            [
                'attribute' => 'checked',
                'format'=>'raw',
                'value' => function($model){
                    //如果結束日期和開始日期都大於當前時間,blue
                    //如果結束日期大於當前日期，開始日期小於等於當前日期 green
                    //如果開始時間和結束時間都小於當前時間 gray
                    return $model->checked?'<span class="label label-success">已發佈</span>':'<spanclass="label label-danger">未發佈</span>';
                }
            ],
            //'discount',
            //'url:url',

            [
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '90'],
                'template' => '{view} {update} {delete} {copy}',
                'buttons' => [
                    'copy' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-files-o"></span>', $url, ['title' => '複製活動'] ) ;
                    },
                ]
            ],
        ],
    ]); ?>
</div>
</div>
<?php echo Yii::$app->params['content_list_end'];?>
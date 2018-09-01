<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\services\ImageToolService;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Banners');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_list_start'];?>

<div class="box-header">
    <div class="pull-right">
        <div class="form-inline pull-right">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="btn-group pull-right" style="margin-right: 10px">
            <?php echo Html::a(Yii::t('app', 'Create Banner'), ['create'], ['class' => 'btn btn-sm btn-success']); ?>
        </div>
    </div>
</div>
<div class="box-body table-responsive pad">
<div class="banner-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'type',
                'value' => function($model){
                    return getBannerTypeText($model->type);
                }
            ],
            //'store_id',
            //'region_id',
             'rank',
            [
                'attribute' => 'image_url',
                'format'=>'raw',
                'value' => function($model){
                    return ImageToolService::getViewImageLink($model->image_url,Yii::t('app','Image Url'));
                }
            ],
            [
                'attribute' => 'use_type',
                'value' => function($model){
                    return getBannerUseTypeText($model->use_type);
                }
            ],

            //'url:url',
            //'app_page',

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
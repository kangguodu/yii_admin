<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\services\ImageToolService;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\StoreBannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Store Banners');
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
            <?php echo Html::a(Yii::t('app', 'Create Current Store Banner'), ['create','store_id' => $searchModel->store_id ], ['class' => 'btn btn-sm btn-success']); ?>
            <?php }?>
            <?php echo Html::a(Yii::t('app', 'Create Store Banner'), ['create'], ['class' => 'btn btn-sm btn-success']); ?>
        </div>
    </div>
</div>
<div class="box-body table-responsive pad">
<div class="store-banner-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'store_id',
            'store_name',
            [
                'attribute' => 'image',
                'format'=>'raw',
                'value' => function($model){
                    return ImageToolService::getViewImageLink($model->image,Yii::t('app','Image'));
                }
            ],
            'rank',
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
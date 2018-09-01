<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\services\ImageToolService;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Goods');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_list_start'];?>

<div class="box-header">
    <div class="pull-right">
        <div class="form-inline pull-right">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="btn-group pull-right" style="margin-right: 10px">
             <?php if(isset($searchModel->store_id) && $searchModel->store_id > 0 && $storeGoodsCount < 3){ ?>
            <?php echo Html::a(Yii::t('app', 'Create Current Goods'), ['create','store_id' => $searchModel->store_id ], ['class' => 'btn btn-sm btn-success']); ?>
            <?php }?>
            <?php echo Html::a(Yii::t('app', 'Create Goods'), ['create'], ['class' => 'btn btn-sm btn-success']); ?>
        </div>
    </div>
</div>
<div class="box-body table-responsive pad">
<div class="goods-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'store_id',
            'store_name',
            'goods_name',
            [
                'attribute' => 'image',
                'format'=>'raw',
                'value' => function($model){
                    $image_path = ImageToolService::getUrlWithDefaultPath($model->image);
                    return Html::img($image_path,['alt' => '圖片','style' => 'max-height: 40px;']);
                },
            ],
            'price',
            //'prom_price',
            // 'created_at',
             [
                'attribute' => 'created_at',
                'value' => function($model){
                   if(intval($model->created_at) > 0){
                        return date('Y-m-d H:i:s',$model->created_at);
                   }else{
                        return null;
                   }
                },
            ],
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
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\services\ImageToolService;
/* @var $this yii\web\View */
/* @var $model app\models\Goods */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Goods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="goods-view">

    <p>
        <?= Html::a(Yii::t('app', 'back_to_list'), ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>
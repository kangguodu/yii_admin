<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\services\ImageToolService;
/* @var $this yii\web\View */
/* @var $model app\models\StoreBanner */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Store Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="store-banner-view">

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
            [
                'attribute' => 'image',
                'format'=>'raw',
                'value' => function($model){
                    $image_path = ImageToolService::getUrlWithDefaultPath($model->image);
                    return Html::img($image_path,['alt' => Yii::t('app','Image'),'style' => 'max-height:500px;']);
                }
            ],
            'rank',
        ],
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>
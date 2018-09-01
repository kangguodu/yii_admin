<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\services\ImageToolService;
/* @var $this yii\web\View */
/* @var $model app\models\Banner */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="banner-view">
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
            [
                'attribute' => 'type',
                'value' => function($model){
                    return getBannerTypeText($model->type);
                }
            ],
            [
                'attribute' => 'use_type',
                'value' => function($model){
                    return getBannerUseTypeText($model->use_type);
                }
            ],
            'store_id',
            'rank',
            [
                'attribute' => 'image_url',
                'format'=>'raw',
                'value' => function($model){
                    $image_path = ImageToolService::getUrlWithDefaultPath($model->image_url);
                    return Html::img($image_path,['alt' => Yii::t('app','Image Url'),'style' => 'max-height:200px;']);
                }
            ],
            'url:url',
            'app_page',
        ],
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\services\ImageToolService;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="activity-view">
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
            'title',
            'description',
            'discount',
            'show_time',
            'start_at',
            'expire_at',
            [
                'attribute' => 'checked',
                'format'=>'raw',
                'value' => function($model){
                    //如果結束日期和開始日期都大於當前時間,blue
                    //如果結束日期大於當前日期，開始日期小於等於當前日期 green
                    //如果開始時間和結束時間都小於當前時間 gray
                    return $model->checked?'<span class="green">已發佈</span>':'<span class="red">未發佈</span>';
                }
            ],
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
            [
                'attribute' => 'posters_pictures',
                'format'=>'raw',
                'value' => function($model){
                    $image_path = ImageToolService::getUrlWithDefaultPath($model->posters_pictures);
                    return Html::img($image_path,['alt' => Yii::t('app','Posters Pictures'),'width' => 200]);
                }
            ],
            
            'url:url',
            'content:html',
            'created_at',
            'created_by',
        ],
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>
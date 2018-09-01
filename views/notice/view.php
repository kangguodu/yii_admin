<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\services\ImageToolService;

/* @var $this yii\web\View */
/* @var $model app\models\Notice */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="notice-view">

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
            [
                'attribute' => 'type_id',
                'value' => function($model){
                    return getNoticeTypeText($model->type_id);
                }
            ],
            'content:ntext',
            [
                'attribute' => 'icon',
                'format'=>'raw',
                'value' => function($model){
                    $image_path = ImageToolService::getUrlWithDefaultPath($model->icon);
                    return Html::img($image_path,['alt' => Yii::t('app','Icon'),'style' => 'max-height:200px;']);
                }
            ],
            'url:url',
            'point_id',
            //'member_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_start'];?>

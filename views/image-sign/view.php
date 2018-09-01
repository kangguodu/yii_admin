<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ImageSign */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Image Signs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="image-sign-view">
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
                'attribute' => 'cover',
                'format'=>'raw',
                'value' => function($model){
                    $image_path = $model->cover?Yii::$app->params['meme_host'].$model->cover:Yii::$app->params['member_avatar'];
                    return Html::img($image_path,['alt' => '封面','width' => 200]);
                }
            ],
            [
                'attribute' => 'image_config',
                'format'=>'raw',
                'label' => '立牌底圖',
                'value' => function($model){
                    $config = $model->image_config;
                    $configs = json_decode($config,TRUE);
                    if( $configs != null && $configs != false){
                        $background =  $configs['background'];
                        $image_path = Yii::$app->params['meme_host'].$background;
                        return Html::img($image_path,['alt' => '封面','width' => 500]);
                    }else{
                        return '';
                    }
                }
            ],
            'start_at',
            'end_at',
            'created_at',
            'price',
        ],
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>
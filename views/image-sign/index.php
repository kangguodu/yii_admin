<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\services\ImageToolService;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ImageSignSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Image Signs');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_list_start'];?>
<div class="box-header">
    <div class="pull-right">
        <div class="form-inline pull-right">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="btn-group pull-right" style="margin-right: 10px">
            <?= Html::a(Yii::t('app', 'Create Image Sign'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
        </div>
    </div>
</div>
<div class="box-body table-responsive pad">
<div class="image-sign-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // [
            //     'attribute' => 'cover',
            //     'format'=>'raw',
            //     'value' => function($model){
            //         $image_path = $model->cover?Yii::$app->params['meme_host'].$model->cover:Yii::$app->params['member_avatar'];
            //         return Html::img($image_path,['alt' => '封面','width' => 30]);
            //     }
            // ],
            'title',
            'description',
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
                        //return Html::img($image_path,['alt' => '封面','width' => 30]);
                        return ImageToolService::getViewImageLink($image_path,'立牌底圖');
                    }else{
                        return '';
                    }
                }
            ],
            [
                'attribute' => 'can_apply',
                'format'=>'raw',
                'value' => function($model){
                    return $model->can_apply?'<span class="label label-success">是</span>':'<span class="label label-danger">否</span>';
                }
            ],
            [
                'attribute' => 'showat_download',
                'format'=>'raw',
                'value' => function($model){
                    return $model->showat_download?'<span class="label label-success">是</span>':'<span class="label label-danger">否</span>';
                }
            ],
            
            'start_at',
            'end_at',
            //'created_at',
            'price',

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

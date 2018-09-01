<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\services\ImageToolService;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\NoticeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Notices');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_list_start'];?>
<div class="box-header">
    <div class="pull-right">
        <div class="form-inline pull-right">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="btn-group pull-right" style="margin-right: 10px">
            <?php echo Html::a(Yii::t('app', 'Create Notice'), ['create'], ['class' => 'btn btn-sm btn-success']); ?>
        </div>
    </div>
</div>
<div class="box-body table-responsive pad">
<div class="notice-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description',
            [
                'attribute' => 'type_id',
                'value' => function($model){
                    return getNoticeTypeText($model->type_id);
                }
            ],
            //'content:ntext',
            [
                'attribute' => 'icon',
                'format'=>'raw',
                'value' => function($model){
                    $image_path = ImageToolService::getUrlWithDefaultPath($model->icon);
                    return Html::img($image_path,['alt' => Yii::t('app','Icon'),'style' => 'max-height:40px;']);
                }
            ],
            //'url:url',
            //'point_id',
            //'member_id',
            'created_at',
            'updated_at',

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

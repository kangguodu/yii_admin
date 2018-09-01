<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\StoreTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Store Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_list_start'];?>
<div class="box-header">
    <div class="pull-right">
        <div class="form-inline pull-right">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="btn-group pull-right" style="margin-right: 10px">
            <?php echo Html::a(Yii::t('app', 'Create Store Type'), ['create'], ['class' => 'btn btn-sm btn-success']); ?>
        </div>
    </div>
</div>
<div class="box-body table-responsive pad">
<div class="store-type-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute' => 'published',
                'format' => 'raw',
                'value' => function($model){
                    $text = getDisableOrNotTypeText($model->published);
                    return $model->published?'<span class="label label-success">'.$text.'</span>':'<span class="label label-danger">'.$text.'</span>';
                }
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
<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\KeywordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Keywords');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_list_start'];?>

<div class="box-header">
    <div class="pull-right">
        <div class="form-inline pull-right">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="btn-group pull-right" style="margin-right: 10px">
            <?php //echo Html::a(Yii::t('app', 'Create Store'), ['create'], ['class' => 'btn btn-sm btn-success']); ?>
        </div>
    </div>
</div>
<div class="box-body table-responsive pad">
<div class="keyword-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'hot_word',
            'number',
            [
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete} {transform}',
                'headerOptions' => ['width' => '100'],
                'buttons' => [
                    'transform' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-paper-plane" aria-hidden="true"></span>', $url, ['title' => '轉換為熱搜詞'] ) ;
                    }
                ]
            ],
        ],
    ]); ?>
</div>
</div>
<?php echo Yii::$app->params['content_list_end'];?>
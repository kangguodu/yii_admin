<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\StoreApplySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Store Applies');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_list_start'];?>

<div class="box-header">
    <div class="pull-right">
        <div class="form-inline pull-right">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>
</div>

<div class="box-body table-responsive pad">
<div class="store-apply-index">
    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'province',
            'city',
            'address',
            'phone',
            'email:email',
            'company_name',
            'company_tax_no',
            'type_name',
            [
                'attribute' => 'status',
                'value'=>function($model){
                    return $model->status?'已處理':'待審核';
                }
            ],
            'created_at',
            'other:ntext',  
            [
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{audit} {delete}',
                'headerOptions' => ['width' => '50'],
                'buttons' => [
                    'audit' => function ($url, $model, $key) {
                        return $model->status <= 0 ? 
                            Html::a('<span class="fa fa-check"></span>', $url, ['title' => '审核'] ) : ''; 
                         
                    }
                ]
            ],
        ],
    ]); ?>
</div>
</div>
<?php echo Yii::$app->params['content_list_end'];?>
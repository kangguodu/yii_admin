<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\services\ImageToolService;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Store */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="store-view">


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
            //'store_id',
            //'super_uid',
            'name',
            'branchname',
            'description',
            'city',
            'district',
            'address',
            'phone',
            //'email:email',
            'company_name',
            'company_tax_no',
            'code',
            //'type',
            'type_name',
            //'image',
            [
                'attribute' => 'image',
                'format'=>'raw',
                'value' => function($model){
                    return ImageToolService::getViewImageLink($model->image,Yii::t('app','Image'));
                }
            ],
            [
                'attribute' => 'service_status',
                'format'=>'raw',
                'value' => function($model){
                    return $model->service_status?'<span class="label label-success">營業</span>':'<span class="label label-danger">休息</span>';
                }
            ],
            'remark',
            [
                'attribute' => 'avg_cost_status',
                'format'=>'raw',
                'value' => function($model){
                    return $model->avg_cost_status?'<span class="label label-success">啟用</span>':'<span class="label label-danger">禁用</span>';
                }
            ],
            'avg_cost_low',
            'avg_cost_high',
            'facebook',
            'instagram',
            'google_keyword',
            'coordinate',
            //'lat',
            //'lng',
            
            [
                'attribute' => 'status',
                'format'=>'raw',
                'value' => function($model){
                    return $model->status?'<span class="label label-success">開店中</span>':'<span class="label label-danger">已關店</span>';
                }
            ],
            //'email_valid:email',
            // 'routine_holiday',
            // 'special_holiday',
            // 'special_business_day',
            //'is_return',
            [
                'attribute' => 'is_return',
                'format'=>'raw',
                'value' => function($model){
                    return $model->is_return?'<span class="label label-success">啟用</span>':'<span class="label label-danger">禁用</span>';
                }
            ],
            'search_keyword',
            //'recommend_rank',
            
            //'service:ntext',
            [
                'attribute' => 'service',
                'format' => 'raw',
                'value' => function($model){
                    return showStoreServicesHtml($model->service);
                }
            ],
            'created_at',
        ],
    ]) ?>

    <h4>店鋪儲值記錄(最近10條記錄)</h2>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            //'trans_date',
            [
                'attribute' => 'trans_datetime',
                'label'=>'儲值時間',
                'value' => function($model){
                    return $model['trans_datetime'];
                }
            ],
            [
                'attribute' => 'balance',
                'label'=>'異動前金額',
                'value' => function($model){
                    return $model['balance'];
                }
            ],
            [
                'attribute' => 'amount',
                'label'=>'儲值金額',
                'value' => function($model){
                    return $model['amount'];
                }
            ],
            
        ]
    ]); ?>
</div>
<?php echo Yii::$app->params['content_common_end'];?>
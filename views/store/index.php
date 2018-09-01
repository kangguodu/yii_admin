<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\StoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Stores');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs($this->render('_index.js'));
app\assets\ToastrAsset::register($this);
?>
<?php echo Yii::$app->params['content_list_start'];?>

<div class="box-header">
    <div class="pull-right">
        <div class="form-inline pull-right">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="btn-group pull-right" style="margin-right: 10px">
            <?php echo Html::a(Yii::t('app', 'Create Store'), ['create'], ['class' => 'btn btn-sm btn-success']); ?>
        </div>
    </div>
</div>
<div class="box-body table-responsive pad">
<div class="store-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'store_id',
            //'super_uid',
            'name',
            'phone',
           // 'branchname',
            //'city',
            //'district',
            //'address',
            
            //'email:email',
            //'company_name',
            //'company_tax_no',
            //'code',
            //'type',
            'type_name',
            'credits_income',
            'business_income',
            //'return_credits',
             [
                'attribute' => 'return_credits',
                'format'=>'raw',
                'value' => function($model){
                    return '<span id="store-return-'.$model->id.'">'.$model->return_credits.'</span>';
                }
            ],
            [
                'attribute' => 'status',
                'format'=>'raw',
                'value' => function($model){
                    return $model->status?'<span class="label label-success">開店中</span>':'<span class="label label-danger">已關店</span>';
                }
            ],
            //'image',
            //'service_status',
            //'remark',
            //'avg_cost_status',
            //'avg_cost_low',
            //'avg_cost_high',
            //'facebook',
            //'instagram',
            //'google_keyword',
            //'coordinate',
            //'lat',
            //'lng',
            'created_at',
            //'email_valid:email',
            //'routine_holiday',
            //'special_holiday',
            //'special_business_day',
            //'is_return',
            //'search_keyword',
            //'recommend_rank',
            //'description',
            //'service:ntext',
            //{store-user} {goods} {bankaccount} {banner}
             [
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {charge}  {servicestime} {imagesign}',
                'headerOptions' => ['width' => '120'],
                'buttons' => [
                    'store-user' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-users"></span>', ['store-user/index',"StoreUserSearch[store_id]"=>$model->id], ['title' => '店鋪用戶'] ) ;
                    },
                    'goods' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-cutlery"></span>', ['goods/index',"GoodsSearch[store_id]"=>$model->id], ['title' => '店鋪特色菜'] ) ;
                    },
                    'bankaccount' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-credit-card"></span>', ['store-bank-account/index',"StoreBankAccountSearch[store_id]"=>$model->id], ['title' => '店鋪銀行卡'] ) ;
                    },
                    'banner' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-image "></span>', ['store-banner/index',"StoreBannerSearch[store_id]"=>$model->id], ['title' => '店鋪Banner'] ) ;
                    },
                    'servicestime' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-clock-o"></span>', $url, ['title' => '營業時間'] ) ;
                    },
                    'imagesign' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-qrcode"></span>', $url, ['title' => '立牌'] ) ;
                    },
                    'charge' => function($url,$model,$key){
                        return Html::a('<span class="fa fa-money store-charge"></span>', 'javascript:;', ['title' => '儲值','data'=>[
                            'url' => $url,
                            'id' => $model->id
                        ]] ) ;
                    }
                ]
            ],
        ],
    ]); ?>
</div>
</div>
<?php echo Yii::$app->params['content_list_end'];?>
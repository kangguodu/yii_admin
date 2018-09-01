<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\StoreBankAccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Store Bank Accounts');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_list_start'];?>

<div class="box-header">
    <div class="pull-right">
        <div class="form-inline pull-right">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="btn-group pull-right" style="margin-right: 10px">
            <?php if(isset($searchModel->store_id) && $searchModel->store_id > 0){ ?>
            <?php echo Html::a(Yii::t('app', 'Create Current Bank Account'), ['create','store_id' => $searchModel->store_id ], ['class' => 'btn btn-sm btn-success']); ?>
            <?php }?>
            <?php echo Html::a(Yii::t('app', 'Create Store Bank Account'), ['create'], ['class' => 'btn btn-sm btn-success']); ?>
        </div>
    </div>
</div>
<div class="box-body table-responsive pad">
<div class="store-bank-account-index">
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'store_id',
            'store_name',
            'bank_name',
            'receiver_name',
            'bank_account',
            'bank_phone',
            'region',
            'branch_name',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model){
                    $text = getDisableOrNotTypeText($model->status);
                    return $model->status?'<span class="label label-success">'.$text.'</span>':'<span class="label label-danger">'.$text.'</span>';
                }
            ],
            'created_at',

            [
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '75'],
            ],
        ],
    ]); ?>
</div>
</div>
<?php echo Yii::$app->params['content_list_end'];?>
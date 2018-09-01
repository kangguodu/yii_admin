<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\ImageSignApply */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Image Sign Applies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="image-sign-apply-view">
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

    <h4>立牌申請基本信息</h4>

    <?php echo  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'store_id',
            'other_remark',
            'address',
            'imagesign_carriage',
            [
                'attribute' => 'status',
                'value' => function($model){
                    if($model->status == 1){
                        return '待處理';
                    }else if($model->status == 2){
                        return '處理中';
                    }else if($model->status == 3){
                        return '完成';
                    }else if($model->status == 4){
                        return '取消';
                    }
                }
            ],
            'cancel_reason',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <h4>立牌申請詳情</h4>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'store_id',
            [
                'attribute' => 'title',
                'label'=>'立牌標題',
                'value' => function($model){
                    return $model['title'];
                }
            ],
            [
                'attribute' => 'cover',
                'format'=>'raw',
                'value' => function($model){
                    $image_path = $model['cover']?Yii::$app->params['meme_host'].$model['cover']:Yii::$app->params['member_avatar'];
                    return Html::img($image_path,['alt' => '封面','style' => 'max-height:40px;']);
                }
            ],
            [
                'attribute' => 'image_config',
                'format'=>'raw',
                'label' => '立牌底圖',
                'value' => function($model){
                    $config = $model['image_config'];
                    $configs = json_decode($config,TRUE);
                    if( $configs != null && $configs != false){
                        $background =  $configs['background'];
                        $image_path = Yii::$app->params['meme_host'].$background;
                        return Html::img($image_path,['alt' => '封面','style' => 'max-height:40px;']);
                    }else{
                        return '';
                    }
                }
            ],
            [
                'attribute' => 'quantity',
                'label'=>'申請數量',
                'value' => function($model){
                    return intval($model['quantity']);
                }
            ],
            [
                'attribute' => 'amount',
                'label'=>'小計',
                'value' => function($model){
                    return intval($model['amount']);
                }
            ],
            [
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{download}',
                'headerOptions' => ['width' => '50'],
                'buttons' => [
                    'download' => function ($url, $model, $key) {
                        $url .= '&store_id='.$model['store_id'];
                        return  Html::a('<span class="fa fa-cloud-download"></span>', $url, ['title' => '下載立牌圖片'] ) ; 
                         
                    }
                ]
            ],
        ]
    ]); ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\services\ImageToolService;
/* @var $this yii\web\View */
/* @var $model app\models\Store */

$this->title = '店鋪立牌';
$this->params['breadcrumbs'][] = ['label' => '店鋪管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="store-imagesign">
    <p>
        <?= Html::a(Yii::t('app', 'back_to_list'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
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
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{download}',
                'headerOptions' => ['width' => '50'],
                'buttons' => [
                    'download' => function ($url, $model, $key) use($store_id) {
                        $url .= '&store_id='.$store_id;
                        return  Html::a('<span class="fa fa-cloud-download"></span>', $url, ['title' => '下載立牌圖片'] ) ; 
                         
                    }
                ]
            ],
        ]
    ]); ?>
</div>
<?php echo Yii::$app->params['content_common_end'];?>
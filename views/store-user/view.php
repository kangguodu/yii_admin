<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\services\ImageToolService;
/* @var $this yii\web\View */
/* @var $model app\models\StoreUser */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Store Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="store-user-view">
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
            'store_id',
            'nickname',
            //'email:email',
            'mobile',
            //'zone',
            //'password',
            //'permission',
            //'email_status:email',
            //'token',
            //'gender',
            [
                'attribute' => 'super_account',
                'format'=>'raw',
                'value' => function($model){
                    return $model->super_account?'<span class="label label-success">是</span>':'<span class="label label-default">否</span>';
                }
            ],
            'position',
            [
                'attribute' => 'menus',
                'format'=>'raw',
                'value' => function($model){
                    $str = '';
                    if(is_string($model->menus)){
                        $data = json_decode($model->menus,TRUE);
                        if($data != null && $data !== false){
                            foreach($data as $value){
                                if($value['checked'] === true){
                                     $str .= '<span class="label label-success">'.$value['title'].'</span> &nbsp;';
                                }
                               
                            }
                        }
                    }
                    return $str;
                }
            ],
            'created_at',
            'updated_at',
            'last_login',
        ],
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>
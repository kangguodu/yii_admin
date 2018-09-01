<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\services\ImageToolService;
/* @var $this yii\web\View */
/* @var $model app\models\Member */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Members'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="member-view">

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
            'zone',
            'phone',
            //'password',
            'username',
            'nickname',
            'email:email',
            [
                'attribute' => 'avatar',
                'format'=>'raw',
                'value' => function($model){
                    $image_path = ImageToolService::getUrlWithDefaultPath($model->avatar);
                    return Html::img($image_path,['alt' => '用戶頭像','width' => 30]);
                }
            ],
            'birthday',
            'id_card',
            //'groupid',
            [
                'attribute' => 'gender',
                'value' => function($model){
                    return ($model->gender == 1)?'男':'女';
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($model){
                    return $model->status?'啟用':'禁用';
                }
            ],
            [
                'attribute' => 'user_type',
                'value' => function($model){
                    $user_type = $model->user_type;
                    if($user_type <= 0){
                        return '未認證';
                    }elseif ($user_type == 1) {
                        return '個人';
                    }else if($user_type == 2){
                        return '網紅';
                    }
                }
            ],
            //'secure_status',
            //'secure_password',
            'invite_code',
            [
                'attribute' => 'code_type',
                'value' => function($model){

                    if(($model->code_type == 1 || $model->code_type == 2) && !empty($model->promo_code)){
                        return $model->code_type == 1?'會員':'店家';    
                    }
                }
            ],
            'promo_code',
            'invite_count',
            'created_at',
            'updated_at',
            //'number',
            //'token',
            
            //'honor',
        ],
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>

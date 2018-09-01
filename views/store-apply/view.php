<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StoreApply */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Store Applies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="store-apply-view">

    <p>
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
        ],
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>
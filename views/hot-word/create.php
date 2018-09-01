<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HotWord */

$this->title = Yii::t('app', 'Create Hot Word');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hot Words'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="hot-word-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>

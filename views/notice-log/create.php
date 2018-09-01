<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\NoticeLog */

$this->title = Yii::t('app', 'Create Notice Log');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notice Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="notice-log-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ServiceKeyword */

$this->title = Yii::t('app', 'Create Service Keyword');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Service Keywords'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="service-keyword-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>
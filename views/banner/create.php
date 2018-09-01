<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Banner */

$this->title = Yii::t('app', 'Create Banner');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="banner-create">

    <?= $this->render('_form', [
        'model' => $model,
        'home_page_count' => $home_page_count,
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>
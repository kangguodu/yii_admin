<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StoreBanner */

$this->title = Yii::t('app', 'Create Store Banner');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Store Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="store-banner-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>
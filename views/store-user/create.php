<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StoreUser */

$this->title = Yii::t('app', 'Create Store User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Store Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="store-user-create">
	
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>
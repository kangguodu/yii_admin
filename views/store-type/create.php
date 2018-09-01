<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StoreType */

$this->title = Yii::t('app', 'Create Store Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Store Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="store-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>

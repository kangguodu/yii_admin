<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Notice */

$this->title = Yii::t('app', 'Create Notice');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="notice-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>
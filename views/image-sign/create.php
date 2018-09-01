<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ImageSign */

$this->title = Yii::t('app', 'Create Image Sign');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Image Signs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Yii::$app->params['content_common_start'];?>
<div class="image-sign-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php echo Yii::$app->params['content_common_end'];?>
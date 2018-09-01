<?php
/**
 * Created by PhpStorm.
 * @author: Techrare's php department<sales@techrare.com>
 * @date: 2016/4/28 15:20
 * @version:
 */

use yii\helpers\Html;

/* @var $this  yii\web\View */
/* @var $model mdm\admin\models\BizRule */

$this->title = Yii::t('app', 'Update Product') . ': ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="auth-item-update">

    <h1><?php echo Html::encode($this->title); ?></h1>
    <?php echo
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>
</div>
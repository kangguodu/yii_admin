<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<section class="content">

    <div class="error-page">
        <h2 class="headline text-info"><i class="fa fa-warning text-yellow"></i></h2>

        <div class="error-content">
            <h3><?= $name ?></h3>

            <p>
                <?= nl2br(Html::encode($message)) ?>
            </p>

            <p>
                上面的錯誤是當服務器處理你的請求出現的。如果你覺得這是一個服務器錯誤，請聯繫我們。謝謝。
                同時, 你可以 <a href='<?= Yii::$app->homeUrl ?>'>返回控制面板</a> .
            </p>

        </div>
    </div>

</section>

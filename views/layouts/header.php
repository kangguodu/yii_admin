<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<?php $this->beginBlock('curd_form_footer'); ?>

<div class="box-footer">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="btn-group pull-right">
            <?= Html::submitButton(Yii::t('app','save'), [
                    'class' => 'btn btn-info pull-right']) ?>
        </div>
        <div class="btn-group pull-left">
            <?php echo Html::resetButton(Yii::t('app','reset'),[
                    'class' => 'btn btn-warning'
            ])?>
        </div>
    </div>
</div>
<?php $this->endBlock(); ?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php echo Html::img('images/avatar/avatar.png',[
                                'class' => 'user-image'
                        ]); ?>
                        <span class="hidden-xs"><?php echo Yii::$app->user->identity?Yii::$app->user->identity->username:'';?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?php echo Html::img('images/avatar/avatar.png',[
                                'class' => 'img-circle'
                            ]); ?>
                            <p>
                                <?php echo Yii::$app->user->identity?Yii::$app->user->identity->username:'';?>
                                <small>Member since <?php echo Yii::$app->user->identity?Yii::$app->user->identity->username:'';?></small>
                            </p>
                        </li>

                        <li class="user-footer">
                            <div class="pull-left">
                                 <?php echo  Html::a(
                                    '修改密碼',
                                    ['/admin/user/change-password'],
                                    ['class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                            <div class="pull-right">
                                <?php echo  Html::a(
                                '登出',
                                ['/site/logout'],
                                ['class' => 'btn btn-default btn-flat']
                            ) ?>
                               
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
               <!--  <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li> -->
            </ul>
        </div>
    </nav>
</header>

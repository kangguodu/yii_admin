<?php

/* @var $this yii\web\View */


$this->title = '面板';

$this->registerJs($this->render('_index.js'));
?>
<div class="site-index">

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua">
                    <i class="ion ion-ios-person-outline"></i>
                </span>
                <div class="info-box-content">
                    <div class="info-box-text">會員總數</div>
                    <div class="info-box-number"><?php echo $member_count;?></div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red">
                    <i class="ion ion-ios-pulse"></i>
                </span>
                <div class="info-box-content">
                    <div class="info-box-text">合作店家數量</div>
                    <div class="info-box-number"><?php echo $store_count;?></div>
                </div>
            </div>
        </div>



        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green">
                    <i class="ion ion-ios-alarm"></i>
                </span>
                <div class="info-box-content">
                    <div class="info-box-text">新用戶</div>
                    <div class="info-box-number"><?php echo $new_member_count;?></div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua">
                    <i class="ion ion-ios-person-outline"></i>
                </span>
                <div class="info-box-content">
                    <div class="info-box-text">剩餘回贈蜂幣</div>
                    <div class="info-box-number"><?php echo $interest_remain;?></div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red">
                    <i class="ion ion-ios-pulse"></i>
                </span>
                <div class="info-box-content">
                    <div class="info-box-text">今日回贈蜂幣</div>
                    <div class="info-box-number"><?php echo $interest_ever;?></div>
                </div>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title">剩餘回贈蜂幣</div>
                </div>
                <div class="box-body">
                    <div id="rebate_jobs_report" style="height:350px;"></div>
                </div>
            </div>
        </div>
    </div>


</div>
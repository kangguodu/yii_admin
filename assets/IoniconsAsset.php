<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/17
 * Time: 15:15
 */

namespace app\assets;

use yii\web\AssetBundle;

class IoniconsAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/bower_components/';

    public $css = [
        // 'css/site.css',
        'Ionicons/css/ionicons.min.css',
    ];
    public $js = [
       // 'chart.js/Chart.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
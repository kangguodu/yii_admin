<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/17
 * Time: 18:13
 */

namespace app\assets;


use yii\web\AssetBundle;

class EchartAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
        'vendor/echarts.common.min.js'
    ];
}
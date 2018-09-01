<?php

namespace app\assets;

use yii\web\AssetBundle;

class VueAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/vendor/vue2-timepicker-0.1.3/vue2-timepicker.min.css',
    ];
    public $js = [
        'js/vendor/vue.js',
        'js/vendor/vue2-timepicker-0.1.3/vue2-timepicker.js',
        //'js/servicestime.js',
    ];
    public $depends = [
        
    ];
}
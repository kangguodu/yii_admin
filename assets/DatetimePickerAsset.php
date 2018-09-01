<?php

namespace app\assets;

use yii\web\AssetBundle;

class DatetimePickerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/vendor/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
    ];
    public $js = [
        'js/vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
        //'js/servicestime.js',
    ];
    public $depends = [
        
    ];
}
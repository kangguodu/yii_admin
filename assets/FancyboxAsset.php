<?php

namespace app\assets;

use yii\web\AssetBundle;

class FancyboxAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/vendor/fancybox/jquery.fancybox.min.css',
        //'js/vendor/Magnific-Popup/magnific-popup.css',
        
    ];
    public $js = [
       'js/vendor/fancybox/jquery.fancybox.min.js',
    	//'js/vendor/Magnific-Popup/jquery.magnific-popup.min.js',
        'js/fancybox.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
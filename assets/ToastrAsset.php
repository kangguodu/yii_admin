<?php


namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ToastrAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
        //'css/nestable.css',
        'js/vendor/toastr-2.1.1/toastr.min.css',
    ];
    public $js = [
        // 'js/bootbox.js', 
        // 'js/main.js',
        'js/vendor/toastr-2.1.1/toastr.min.js',
        //'js/layui.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

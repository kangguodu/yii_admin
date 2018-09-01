<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SweetalertAsset extends AssetBundle
{
    public $sourcePath = '@bower/sweetalert';

    /**
     * @var array list of JavaScript files that this bundle contains
     */
    public $js = [
        'src/sweetalert.js',
    ];
    /**
     * @var array list of CSS files that this bundle contains
     */
    public $css = [
        //'dist/sweetalert.css',
    ];
}

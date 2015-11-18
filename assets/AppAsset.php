<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/jquery.bxslider.css',
        'css/owl.carousel.css',
        'css/owl.theme.css',
        'css/font-awesome.css',
        
        'css/settings.css',
        'css/style.css',
    ];
    public $js = [
        'js/jquery.migrate.js',
        'js/jquery.bxslider.min.js',
        'js/owl.carousel.min.js',
        'js/bootstrap.min.js',
        'js/jquery.imagesloaded.min.js',
        'js/retina-1.1.0.min.js',
        'js/jquery.themepunch.tools.min.js',
        'js/jquery.themepunch.revolution.min.js',
        '//maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false',
        'js/gmap3.min.js',
        'js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

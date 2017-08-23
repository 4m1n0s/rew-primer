<?php
namespace app\assets;

use yii\web\AssetBundle;
/**
 * Class BackendAsset
 *
 * @author Stableflow
 */
class FrontAsset extends AssetBundle {

//    public $sourcePath = '@app/themes/polo/assets';
    public $basePath = '@webroot/polo/assets';
    public $baseUrl = '@web/polo/assets';

    public $css = [
        // Bootstrap Core CSS
        'vendor/fontawesome/css/font-awesome.min.css',
        'vendor/animateit/animate.min.css',

        // Vendor css
        'vendor/owlcarousel/owl.carousel.css',
        'vendor/magnific-popup/magnific-popup.css',

        // Template base
        "css/theme-base.css",

        // Template elements
        "css/theme-elements.css",

        // Responsive classes
        "css/responsive.css",

        // Template color
        "css/color-variations/custom.css",

        // Fonts
        '//fonts.googleapis.com/css?family=Open+Sans:400,300,800,700,600%7CRaleway:100,300,600,700,800',

        // CSS CUSTOM STYLE
        "css/custom.css",
    ];

    public $js = [
        // VENDOR SCRIPT
        'vendor/plugins-compressed.js',

        // Theme Base, Components and Settings
        "js/theme-functions.js",

        // Custom js file
        "js/custom.js",

        "vendor/jRespond.min.js",
        "vendor/animsition/js/animsition.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}







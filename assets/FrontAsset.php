<?php
namespace app\assets;

use yii\web\AssetBundle;
/**
 * Class BackendAsset
 *
 * @author Stableflow
 */
class FrontAsset extends AssetBundle {

    public $sourcePath = '@app/themes/polo/assets';

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $css = [
//        Bootstrap Core CSS
        'vendor/animateit/animate.min.css',
        'vendor/bootstrap/css/bootstrap.min.css',
        'vendor/fontawesome/css/font-awesome.min.css',

//        Vendor css
        'vendor/owlcarousel/owl.carousel.css',
        'vendor/magnific-popup/magnific-popup.css',
//        Template base
	    "css/theme-base.css",

//	    Template elements
        "css/theme-elements.css",	
    
    
//	    Responsive classes
	    "css/responsive.css",

//	    Template color
	    "css/color-variations/blue.css",

//	    CSS CUSTOM STYLE
        "css/custom.css"

    ];

    public $js = [

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}







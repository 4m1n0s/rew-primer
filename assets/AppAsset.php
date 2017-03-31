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
    public $sourcePath = '@app/themes/polo/assets';

//    public $jsOptions = ['position' => \yii\web\View::POS_READY];
    public $css = [
        
    ];
    public $js = [
//        VENDOR SCRIPT
//        "vendor/jquery/jquery-1.11.2.min.js",
//        "vendor/jquery/jquery.validate.min.js",
//        "vendor/plugins-compressed.js",

//        Theme Base, Components and Settings
        "vendor/jRespond.min.js",
        "vendor/animsition/js/animsition.js",
        "js/theme-functions.js",
//            Надо разобраться с подключениями

//        Custom
        "js/custom.js",

    ];
    public $depends = [
        'app\assets\FrontAsset',
    ];
}

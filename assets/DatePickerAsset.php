<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DatePickerAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/polo/assets';

//    public $jsOptions = ['position' => \yii\web\View::POS_READY];
    public $css = [
        "vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"
    ];
    public $js = [
        "vendor/moment.js",
        "vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js",
    ];
    public $depends = [
        FrontAsset::class,
    ];
}

<?php

namespace app\modules\offer\assets;

use app\assets\CookieAsset;
use yii\web\AssetBundle;

class MomentTimezoneAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/offer/frontend';

    public $css = [

    ];

    public $js = [
        'js/moment.min.js',
        'js/moment-timezone-with-data.min.js',
        'js/timezone_checker_module.js',
    ];

    public $depends = [
        CookieAsset::class
    ];
}
<?php

namespace app\assets;

use yii\web\AssetBundle;

class MomentTimezoneAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [

    ];

    public $js = [
        'js/moment.min.js',
        'js/moment-timezone-with-data.js',
    ];

    public $depends = [
        'yii\web\YiiAsset'
    ];
}
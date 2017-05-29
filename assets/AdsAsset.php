<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Class AdsAsset
 *
 * @author Stableflow
 */
class AdsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [

    ];

    public $js = [
        'js/ads.js',
        'js/commercial_block_checker_module.js',
    ];

    public $depends = [
        FrontAsset::class
    ];
}







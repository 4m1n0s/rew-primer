<?php

namespace app\modules\offer\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

class BackendOfferAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/offer/frontend';

    public $css = [

    ];

    public $js = [
        'js/offer_display_device_os_module.js'
    ];

    public $depends = [
        YiiAsset::class,
    ];
}
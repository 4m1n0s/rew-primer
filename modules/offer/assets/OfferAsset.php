<?php

namespace app\modules\offer\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

class OfferAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/offer/frontend';

    public $css = [

    ];

    public $js = [
        'js/offer_render_module.js',
    ];

    public $depends = [
        YiiAsset::class,
        MomentTimezoneAsset::class
    ];
}
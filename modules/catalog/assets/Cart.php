<?php

namespace app\modules\catalog\assets;

use yii\web\AssetBundle;
/**
 * Class Cart
 *
 * @author Stableflow
 */
class Cart extends AssetBundle
{
    public $sourcePath = '@app/modules/catalog/frontend';

    public $css = [

    ];

    public $js = [
        'js/cart_module.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
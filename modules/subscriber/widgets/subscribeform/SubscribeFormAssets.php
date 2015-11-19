<?php

namespace app\modules\subscriber\widgets\subscribeform;

use yii\web\AssetBundle;

/**
 * class SubscribeFormAssets
 * 
 * @author Stableflow
 */
class SubscribeFormAssets extends AssetBundle {

    public $sourcePath = '@app/modules/subscriber/widgets/subscribeform/assets';
    public $js = [
        'js/main.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];

}

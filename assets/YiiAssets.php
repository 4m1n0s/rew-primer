<?php

namespace app\assets;
use yii\web\AssetBundle;

/**
 * This asset bundle provides the [jquery javascript library](http://jquery.com/)
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class YiiAssets extends AssetBundle
{
    public $sourcePath = '@yii/assets';

    public $js = [
        'yii.js',
    ];
}

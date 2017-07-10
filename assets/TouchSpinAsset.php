<?php
namespace app\assets;

use yii\web\AssetBundle;
/**
 * Class TouchSpinAsset
 *
 * @author Stableflow
 */
class TouchSpinAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'backend/global/plugins/bootstrap-touchspin/bootstrap.touchspin.min.css',
    ];

    public $js = [
        'backend/global/plugins/bootstrap-touchspin/bootstrap.touchspin.min.js',

    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}






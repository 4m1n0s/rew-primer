<?php

namespace app\assets;

use yii\web\AssetBundle;
/**
 * Class TouchSpinAsset
 *
 * @author Stableflow
 */
class FileInputAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'backend/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css',
    ];

    public $js = [
        'backend/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}






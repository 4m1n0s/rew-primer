<?php
namespace app\assets;

use yii\web\AssetBundle;
/**
 * Class BackendAsset
 *
 * @author Stableflow
 */
class CookieAsset extends AssetBundle
{
    public $basePath = '@webroot/backend/global/plugins';
    public $baseUrl = '@web/backend/global/plugins';

    public $css = [
    ];

    public $js = [
        'js.cookie.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}






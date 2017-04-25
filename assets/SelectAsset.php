<?php
namespace app\assets;

use yii\web\AssetBundle;
/**
 * Class BackendAsset
 *
 * @author Stableflow
 */
class SelectAsset extends AssetBundle {

    public $basePath = '@webroot/backend/global/plugins';
    public $baseUrl = '@web/backend/global/plugins';

    public $css = [
        'select2/css/select2.min.css'
    ];

    public $js = [
        'select2/js/select2.full.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}






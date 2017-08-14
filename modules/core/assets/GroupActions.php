<?php

namespace app\modules\core\assets;

use yii\web\AssetBundle;

/**\
 * Class GroupActions
 * @package app\modules\core\assets
 */
class GroupActions extends AssetBundle
{
    public $sourcePath = '@app/modules/core/web';

    public $css = [

    ];

    public $js = [
        'js/group_actions_module.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
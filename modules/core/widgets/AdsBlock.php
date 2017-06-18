<?php

namespace app\modules\core\widgets;

use app\assets\AdsAsset;
use yii\base\Widget;

/**
 * Class HeaderWidget
 * @package app\modules\core\widgets
 */
class AdsBlock extends Widget
{
    public function run()
    {
        if (!\Yii::$app->keyStorage->get('security.ads')) {
            return null;
        }
        $this->getView()->registerAssetBundle(AdsAsset::class);
        $this->getView()->registerJs('commercial_block_checker_module.init()');
        return $this->render('ads-block');
    }
}
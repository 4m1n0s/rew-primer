<?php

namespace app\modules\offer\controllers\postbacks;

use yii\base\Action;

/**
 * Class AdWorkMedia
 * @package app\modules\offer\controllers\actions
 */
class AdWorkMedia extends Action
{

    public function run()
    {
        \Yii::info('AdWorkMedia POSTBACK', 'offer_postback');
    }
}
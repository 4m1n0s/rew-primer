<?php

namespace app\modules\offer\controllers\postbacks;

use yii\base\Action;

/**
 * Class AdWorkMedia
 * @package app\modules\offer\controllers\actions
 */
class Clixwall extends Action
{

    public function run()
    {
        \Yii::info('Clixwall POSTBACK', 'offer_postback');
    }
}
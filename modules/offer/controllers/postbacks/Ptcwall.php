<?php

namespace app\modules\offer\controllers\postbacks;

use yii\base\Action;

/**
 * Class AdWorkMedia
 * @package app\modules\offer\controllers\actions
 */
class Ptcwall extends Action
{

    public function run()
    {
        \Yii::info('Ptcwall POSTBACK', 'offer_postback');
    }
}
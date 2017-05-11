<?php

namespace app\modules\offer\controllers\postbacks;

use yii\base\Action;

/**
 * Class AdWorkMedia
 * @package app\modules\offer\controllers\actions
 */
class AdWorkMedia extends Action
{
    public $accessHash = 'e5c5xn';

    public function run($access_hash)
    {
        \Yii::info('AdWorkMedia POSTBACK', 'offer_postback');
    }
}
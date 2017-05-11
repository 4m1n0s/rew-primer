<?php

namespace app\modules\offer\controllers\postbacks;

use yii\base\Action;

/**
 * Class Clixwall
 * @package app\modules\offer\controllers\actions
 */
class Clixwall extends Action
{
    public $accessHash = 'egkum8';

    public function run($access_hash)
    {
        \Yii::info('Clixwall POSTBACK', 'offer_postback');
    }
}
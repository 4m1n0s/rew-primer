<?php

namespace app\modules\offer\controllers\postbacks;

use yii\base\Action;

/**
 * Class Ptcwall
 * @package app\modules\offer\controllers\actions
 */
class Ptcwall extends Action
{
    public $accessHash = '57oeou';

    public function run($access_hash)
    {
        \Yii::info('Ptcwall POSTBACK', 'offer_postback');
    }
}
<?php

namespace app\modules\offer\controllers\offerwalls;

use yii\base\Action;

/**
 * Class OfferDaddy
 * @package app\modules\offer\controllers\actions
 */
class OfferDaddy extends Action
{
    /**
     * @var string
     */
    public $view;

    public function run()
    {
        $offerUrl = 'https://www.offerdaddy.com/wall/{app_id}/{username}/'; // TODO: Store it somewhere else
        $replace = [
            '{app_id}' => 12838,
            '{username}' => \Yii::$app->user->identity->username,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->controller->render($this->view, [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }
}
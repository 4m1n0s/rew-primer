<?php

namespace app\modules\offer\controllers\offerwalls;

use yii\base\Action;

/**
 * Class Fyber
 * @package app\modules\offer\controllers\actions
 */
class Fyber extends Action
{
    /**
     * @var string
     */
    public $view;

    public function run()
    {
        $offerUrl = 'http://iframe.sponsorpay.com/?appid={app_id}&uid={user_id}'; // TODO: Store it somewhere else
        $replace = [
            '{app_id}' => 100965,
            '{user_id}' => \Yii::$app->user->identity->id,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->controller->render($this->view, [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }
}
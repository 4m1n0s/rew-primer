<?php

namespace app\modules\offer\controllers\offerwalls;

use yii\base\Action;

/**
 * Class OfferToro
 * @package app\modules\offer\controllers\actions
 */
class OfferToro extends Action
{
    /**
     * @var string
     */
    public $view;

    public function run()
    {
        $offerUrl = 'https://www.offertoro.com/ifr/show/{pub_id}/{username}/{app_id}'; // TODO: Store it somewhere else
        $replace = [
            '{pub_id}' => 5077,
            '{username}' => \Yii::$app->user->identity->username,
            '{app_id}' => 2854,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->controller->render($this->view, [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }
}
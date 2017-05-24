<?php

namespace app\modules\offer\controllers\offerwalls;

use yii\base\Action;

/**
 * Class Persona
 * @package app\modules\offer\controllers\postbacks
 */
class Persona extends Action
{
    /**
     * @var string
     */
    public $view;

    public function run()
    {
        $offerUrl = 'https://persona.ly/widget/?appid={appID}&userid={userID}'; // TODO: Store it somewhere else
        $replace = [
            '{appID}' => '93aa4722ccc529cfc231482b18b7d78f',
            '{userID}' => \Yii::$app->user->identity->id,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->controller->render($this->view, [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }
}
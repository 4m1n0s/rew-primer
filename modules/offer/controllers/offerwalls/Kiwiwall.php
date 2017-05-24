<?php

namespace app\modules\offer\controllers\offerwalls;

use yii\base\Action;

/**
 * Class Kiwiwall
 * @package app\modules\offer\controllers\actions
 */
class Kiwiwall extends Action
{
    /**
     * @var string
     */
    public $view;

    public function run()
    {
        $offerUrl = 'https://www.kiwiwall.com/wall/{app_id}/{username}'; // TODO: Store it somewhere else
        $replace = [
            '{app_id}' => 'SSl86OGDAaX3PF7X7HBeWQR8fSoJLJPH',
            '{username}' => \Yii::$app->user->identity->username,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->controller->render($this->view, [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }
}
<?php

namespace app\modules\offer\controllers\offerwalls;

use yii\base\Action;

/**
 * Class Clixwall
 * @package app\modules\offer\controllers\actions
 */
class Clixwall extends Action
{
    /**
     * @var string
     */
    public $view;

    public function run()
    {
        $offerUrl = 'https://www.clixwall.com/wall.php?p={api_key}&u={username}'; // TODO: Store it somewhere else
        $replace = [
            '{api_key}' => 'H5H5D-6PWNL-PSD69',
            '{username}' => \Yii::$app->user->identity->username,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->controller->render($this->view, [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }
}
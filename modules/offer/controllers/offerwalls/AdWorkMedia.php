<?php

namespace app\modules\offer\controllers\offerwalls;

use yii\base\Action;

/**
 * Class AdWorkMedia
 * @package app\modules\offer\controllers\offerwalls
 */
class AdWorkMedia extends Action
{
    /**
     * @var string
     */
    public $view;

    public function run()
    {
        $offerUrl = 'http://lockwall.xyz/wall/36f/{username}'; // TODO: Store it somewhere else
        $replace = [
            '{username}' => \Yii::$app->user->identity->username,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->controller->render($this->view, [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }
}
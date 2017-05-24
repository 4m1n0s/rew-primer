<?php

namespace app\modules\offer\controllers\offerwalls;

use yii\base\Action;
/**
 * Class CpaLead
 * @package app\modules\offer\controllers\actions
 */
class CpaLead extends Action
{
    /**
     * @var string
     */
    public $view;

    public function run()
    {
        $offerUrl = 'https://cpalead.com/mobile/locker/?pub={pub}&gateid={gateid}&subid={userID}'; // TODO: Store it somewhere else
        $replace = [
            '{pub}' => '765543',
            '{gateid}' => '1341944',
            '{username}' => \Yii::$app->user->identity->id,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->controller->render($this->view, [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }
}
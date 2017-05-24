<?php

namespace app\modules\offer\controllers\offerwalls;

use yii\base\Action;

/**
 * Class SuperRewards
 * @package app\modules\offer\controllers\actions
 */
class SuperRewards extends Action
{
    /**
     * @var string
     */
    public $view;

    public function run()
    {
        $offerUrl = 'https://wall.superrewards.com/super/offers?h={app_hash}&uid={userID}'; // TODO: Store it somewhere else
        $replace = [
            '{app_hash}' => 'rplnqyskqlf.14111322870',
            '{userID}' => \Yii::$app->user->identity->id,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->controller->render($this->view, [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }
}
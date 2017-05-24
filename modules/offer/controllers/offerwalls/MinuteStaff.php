<?php

namespace app\modules\offer\controllers\offerwalls;

use yii\base\Action;

/**
 * Class MinuteStaff
 * @package app\modules\offer\controllers\actions
 */
class MinuteStaff extends Action
{
    /**
     * @var string
     */
    public $view;

    public function run()
    {
        $offerUrl = 'https://offerwall.minutecircuit.com/display.php?app_id={app_id}&site_code={site_code}&user_id={userID}&site_type=all'; // TODO: Store it somewhere else
        $replace = [
            '{app_id}' => '859',
            '{site_code}' => '5ef55796afd8690d',
            '{userID}' => \Yii::$app->user->identity->id,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->controller->render($this->view, [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }
}
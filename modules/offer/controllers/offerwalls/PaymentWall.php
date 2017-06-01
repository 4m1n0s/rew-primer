<?php

namespace app\modules\offer\controllers\offerwalls;

use yii\base\Action;

/**
 * Class PaymentWall
 * @package app\modules\offer\controllers\offerwalls
 */
class PaymentWall extends Action
{
    /**
     * @var string
     */
    public $view;

    public function run()
    {
        $secretKey = '6c0ab436d36686d27a453f003968f904';
        $projectKey = 'bbb1cc657c6cea2c4c88e1de5234496b';
        $offerUrl = 'https://api.paymentwall.com/api/?key={project_key}&uid={userID}&widget=mw6_1&sign_version=1'; // TODO: Store it somewhere else
        $replace = [
            '{secret_key}' => $secretKey,
            '{project_key}' => $projectKey,
            '{userID}' => \Yii::$app->user->identity->id,
            '{sign}' => md5(\Yii::$app->user->identity->id . $secretKey),
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->controller->render($this->view, [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }
}
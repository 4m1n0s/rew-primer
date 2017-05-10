<?php

namespace app\modules\profile\controllers;

use app\modules\profile\forms\ProfileForm;
use app\modules\user\helpers\Password;
use app\modules\user\models\User;
use \Yii;

/**
 * Class IndexController
 */
class OfferController extends ProfileController
{
    public $layout = '//frontend/main';

    /**
     * Offer Wall page
     */
    public function actionWall()
    {
        $this->layout = '//frontend/profile';

        return $this->render('wall', []);
    }

    /**
     * AdWorkMedia offer page
     */
    public function actionAdworkmedia()
    {
        $offerUrl = 'http://lockwall.xyz/wall/36f/{username}'; // TODO: Store it somewhere else
        $replace = [
            '{username}' => Yii::$app->user->identity->username,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('ad-work-media', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    /**
     * OfferToro offer page
     */
    public function actionOffertoro()
    {
        $offerUrl = 'https://www.offertoro.com/ifr/show/{pub_id}/{username}/{app_id}'; // TODO: Store it somewhere else
        $replace = [
            '{pub_id}' => 5077,
            '{username}' => Yii::$app->user->identity->username,
            '{app_id}' => 2854,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('offer-toro', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }
}
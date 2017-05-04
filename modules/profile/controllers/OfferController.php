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
    /**
     * Offer Wall page
     */
    public function actionWall()
    {
        return $this->render('wall', []);
    }

    /**
     * AdWorkMedia offer page
     */
    public function actionAdworkmedia()
    {
        $this->layout = '//frontend/main';

        $offerUrl = 'http://lockwall.xyz/wall/36f'; // TODO: Store it somewhere else
        $username = Yii::$app->user->identity->username;
        $offerFrameUrl = sprintf('%s/%s', $offerUrl, $username);

        return $this->render('ad-work-media', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }
}
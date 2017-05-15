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

    /**
     * OfferToro offer page
     */
    public function actionOfferdaddy()
    {
        $offerUrl = 'https://www.offerdaddy.com/wall/{app_id}/{username}/'; // TODO: Store it somewhere else
        $replace = [
            '{app_id}' => 12838,
            '{username}' => Yii::$app->user->identity->username,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('offer-daddy', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    /**
     * Clixwall offer page
     */
    public function actionClixwall()
    {
        $offerUrl = 'https://www.clixwall.com/wall.php?p={api_key}&u={username}'; // TODO: Store it somewhere else
        $replace = [
            '{api_key}' => 'H5H5D-6PWNL-PSD69',
            '{username}' => Yii::$app->user->identity->username,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('offer-daddy', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    /**
     * Ptcwall offer page
     */
    public function actionPtcwall()
    {
        $offerUrl = 'http://www.ptcwall.com/index.php?view=ptcwall&pubid={site_id}&usrid={username}'; // TODO: Store it somewhere else
        $replace = [
            '{site_id}' => '45swi56i8nj08b9z19',
            '{username}' => Yii::$app->user->identity->username,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('ptcwall', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    /**
     * Kiwiwall offer page
     */
    public function actionKiwiwall()
    {
        $offerUrl = 'https://www.kiwiwall.com/wall/{app_id}/{username}'; // TODO: Store it somewhere else
        $replace = [
            '{app_id}' => 'SSl86OGDAaX3PF7X7HBeWQR8fSoJLJPH',
            '{username}' => Yii::$app->user->identity->username,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('kiwiwall', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    /**
     * SuperRewards offer page
     */
    public function actionSuperrewards()
    {
        $offerUrl = 'https://wall.superrewards.com/super/offers?h={app_hash}&uid={userID}'; // TODO: Store it somewhere else
        $replace = [
            '{app_hash}' => 'rplnqyskqlf.14111322870',
            '{userID}' => Yii::$app->user->identity->id,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('super-rewards', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    /**
     * SuperRewards offer page
     */
    public function actionMinutestaff()
    {
        $offerUrl = 'https://offerwall.minutecircuit.com/display.php?app_id={app_id}&site_code={site_code}&user_id={userID}&site_type=all'; // TODO: Store it somewhere else
        $replace = [
            '{app_id}' => '859',
            '{site_code}' => '5ef55796afd8690d',
            '{userID}' => Yii::$app->user->identity->id,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('super-rewards', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    /**
     * CpaLead offer page
     */
    public function actionCpalead()
    {
        $offerUrl = 'https://cpalead.com/mobile/locker/?pub={pub}&gateid={gateid}&subid={userID}'; // TODO: Store it somewhere else
        $replace = [
            '{pub}' => '765543',
            '{gateid}' => '1341944',
            '{username}' => Yii::$app->user->identity->id,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('cpa-lead', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }
}
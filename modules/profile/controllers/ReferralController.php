<?php

namespace app\modules\profile\controllers;

use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use \Yii;

/**
 * Class ReferralController
 */
class ReferralController extends ProfileController
{
    /**
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionIndex()
    {
        $referralLink = Url::toRoute(['/profile/default/referral-request', 'code' => Yii::$app->user->identity->referral_code], true);

        return $this->render('index', [
            'referralLink' => $referralLink
        ]);
    }
}
<?php

namespace app\modules\profile\controllers;

use app\modules\user\models\User;
use yii\data\ActiveDataProvider;
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
        /* @var User $currentUser */
        $currentUser = Yii::$app->user->identity;
        $referralCode = $currentUser->referral_code;
        $referralLink = Url::toRoute(['/profile/default/referral-request', 'code' => $referralCode], true);
        $dataProvider = new ActiveDataProvider([
            'query' => $currentUser->getReferrals(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'referralLink' => $referralLink,
            'referralCode' => $referralCode,
            'dataProvider' => $dataProvider
        ]);
    }
}
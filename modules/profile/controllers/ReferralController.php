<?php

namespace app\modules\profile\controllers;

use app\modules\core\models\search\TransactionSearch;
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

        $searchModel = new TransactionSearch();
        $params = \Yii::$app->request->queryParams;
        $dataProvider = $searchModel->searchReferrals($params, $currentUser);

        return $this->render('index', [
            'referralLink' => $referralLink,
            'referralCode' => $referralCode,
            'dataProvider' => $dataProvider
        ]);
    }
}
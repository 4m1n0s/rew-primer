<?php

namespace app\modules\profile\controllers;

use app\modules\core\components\controllers\FrontController;
use app\modules\user\models\Referral;
use yii\web\Cookie;
use \Yii;

/**
 * Class ReferralController
 */
class DefaultController extends FrontController
{
    /**
     * @param null $code
     * @return \yii\web\Response
     */
    public function actionReferralRequest($code = null)
    {
        if (!is_null($code)) {
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new Cookie([
                'name' => Referral::COOKIES_REQUEST_ID,
                'value' => $code,
            ]));
        }

        return $this->redirect(['/user/account/sign-up']);
    }
}
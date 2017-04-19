<?php

namespace app\modules\profile\controllers;

use app\modules\user\models\User;
use \Yii;

/**
 * Class IndexController
 */
class IndexController extends ProfileController
{
    /**
     * @return string
     */
    public function actionAccount()
    {
        /* @var User $currentUser */
        $currentUser = Yii::$app->user->identity;

        return $this->render('account', [
            'currentUser' => $currentUser
        ]);
    }
}
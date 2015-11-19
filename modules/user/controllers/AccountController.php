<?php

namespace app\modules\user\controllers;

use app\modules\core\components\controllers\FrontController;
use app\modules\user\controllers\account\LoginAction;
use app\modules\user\controllers\account\LogoutAction;
use yii\filters\AccessControl;

class AccountController extends FrontController {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'back-login' => [
                'class' => LoginAction::className(),
                'layout' => 'login'
            ],
            'logout' => [
                'class' => LogoutAction::className(),
            ]
        ];
    }

}

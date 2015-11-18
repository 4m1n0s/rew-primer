<?php

namespace app\modules\user\controllers;

use app\components\controllers\FrontControlller;
use app\modules\user\controllers\account\LoginAction;
use app\modules\user\controllers\account\LogoutAction;
use app\modules\user\controllers\account\ActivateAction;
use app\modules\user\controllers\account\RegisterAction;
use app\modules\user\controllers\account\RecoveryResetAction;
use app\modules\user\controllers\account\RecoveryRequestAction;
use app\modules\user\controllers\account\InvitionRequestAction;
use yii\filters\AccessControl;

class AccountController extends FrontControlller {

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
            'login' => [
                'class' => LoginAction::className(),
                'layout' => '/frontend'
            ],
            'back-login' => [
                'class' => LoginAction::className(),
                'layout' => 'login'
            ],
            'logout' => [
                'class' => LogoutAction::className(),
            ],
            'back-recovery-request' => [
                'class' => RecoveryRequestAction::className(),
                'layout' => 'login'
            ],
            'recovery-request' => [
                'class' => RecoveryRequestAction::className(),
                'layout' => '/frontend'
            ],
            'back-recovery-reset' => [
                'class' => RecoveryResetAction::className(),
                'layout' => 'login'
            ],
            'recovery-reset' => [
                'class' => RecoveryResetAction::className(),
                'layout' => '/frontend'
            ],
            'register' => [
                'class' => RegisterAction::className(),
                'layout' => '/frontend'
            ],
            'activate' => [
                'class' => ActivateAction::className(),
            ],
            'invition-request' => [
                'class' => InvitionRequestAction::className(),
            ],
        ];
    }

}

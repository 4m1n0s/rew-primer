<?php

namespace app\controllers;

use app\modules\pages\models\Page;
use app\modules\user\forms\RegistrationForm;
use app\modules\user\models\Referral;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\core\components\controllers\FrontController;

class SiteController extends FrontController
{

    public function behaviors()
    {
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->getUser()->getIdentity()->getReturnUrl());
        }

        return $this->render('index');
    }

    public function actionFaq()
    {
        $page = Page::find()->template(Page::TEMPLATE_FAQ)->one() ?: new Page();

        return $this->render('faq', [
            'page' => $page
        ]);
    }

    public function actionAbout()
    {
        $page = Page::find()->template(Page::TEMPLATE_ABOUT)->one() ?: new Page();

        return $this->render('about', [
            'page' => $page
        ]);
    }

    public function actionTerms()
    {
        $page = Page::find()->template(Page::TEMPLATE_TERMS)->one() ?: new Page();
        
        return $this->render('terms', [
            'page' => $page
        ]);
    }
}

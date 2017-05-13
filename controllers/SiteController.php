<?php

namespace app\controllers;

use app\modules\user\forms\RegistrationForm;
use app\modules\user\models\Referral;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\core\components\controllers\FrontController;

class SiteController extends FrontController {

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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions() {
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
            return $this->redirect(['/profile/offer/wall']);
        }

        $form = new RegistrationForm([
            'scenario' => RegistrationForm::SIGNUP_SCENARIO
        ]);

        $cookies = Yii::$app->request->cookies;
        $form->referralCode = $cookies->getValue(Referral::COOKIES_REQUEST_ID, null);

        if ($form->load(Yii::$app->request->post())) {

            if (!$form->validate() && !empty(array_shift($form->getErrors())[0])) {
                Yii::$app->session->setFlash('error', Yii::t('user', array_shift($form->getErrors())[0]));
                return $this->render('index', [
                    'model' => $form,
                ]);
            }

            if ($user = Yii::$app->userManager->createUser($form)) {
                Yii::$app->session->setFlash('success', Yii::t('user', 'Account was created! Check your email!'));
                return $this->redirect('/');
            }

            Yii::$app->session->setFlash('error', Yii::t('user', 'Error creating account!'));
        }

        return $this->render('index', [
            'model' => $form,
        ]);
    }
    
    public function actionFaq()
    {
        return $this->render('faq');
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

}

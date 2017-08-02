<?php

namespace app\modules\settings\controllers;

use app\modules\core\components\controllers\BackController;
use app\modules\core\models\GeoCountry;
use app\modules\offer\models\Offer;
use app\modules\offer\models\OfferDeviceOs;
use app\modules\offer\models\OfferDeviceType;
use app\modules\settings\forms\FormModel;
use kartik\switchinput\SwitchInput;
use \Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\ForbiddenHttpException;

/**
 * Default controller for the `settings` module
 */
class IndexBackendController extends BackController
{
    public $viewPath = 'app\modules\settings\views\index-backend';
    public $layout = '//backend/default-form';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['layoutFilter']);
        return $behaviors;
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = Yii::createObject([
            'class' => FormModel::class,
            'keys' => [
                'email' => [
                    'label' => 'Email',
                    'type' => FormModel::TYPE_TEXTINPUT,
                    'options' => ['placeholder' => 'Email'],
                    'rules' => [['required'], ['email']]
                ],
                'site_key' => [
                    'label' => 'reCaptcha Site Key',
                    'type' => FormModel::TYPE_TEXTINPUT,
                    'options' => ['placeholder' => 'reCaptcha Site Key'],
                ],
                'secret_key' => [
                    'label' => 'reCaptcha Secret Key',
                    'type' => FormModel::TYPE_TEXTINPUT,
                    'options' => ['placeholder' => 'reCaptcha Secret Key'],
                ],
                'header_scripts' => [
                    'label' => 'Header Scripts',
                    'type' => FormModel::TYPE_TEXTAREA,
                    'options' => ['placeholder' => 'Header Scripts'],
                ],
                'footer_scripts' => [
                    'label' => 'Footer Scripts',
                    'type' => FormModel::TYPE_TEXTAREA,
                    'options' => ['placeholder' => 'Footer Scripts'],
                ],
                'mandrill_api_key' => [
                    'label' => 'Mandrill API Key',
                    'type' => FormModel::TYPE_TEXTINPUT,
                    'options' => ['placeholder' => 'Mandrill API Key'],
                ],
                'referral_percents' => [
                    'label' => 'Referral Percents',
                    'type' => FormModel::TYPE_TEXTINPUT,
                    'options' => ['placeholder' => 'Referral Percents'],
                    'rules' => [['number', 'min' => 0]]
                ],
                'free_points_register' => [
                    'label' => 'Free Points Amount',
                    'type' => FormModel::TYPE_TEXTINPUT,
                    'options' => ['placeholder' => 'Free Points Amount'],
                    'rules' => [['number', 'min' => 0]]
                ],
                'redeem.maxLimit' => [
                    'label' => 'Redeem Max Limit',
                    'type' => FormModel::TYPE_TEXTINPUT,
                    'options' => ['placeholder' => 'Redeem Max Limit'],
                    'rules' => [['number', 'min' => 0]]
                ],
                'redeem.minLimit' => [
                    'label' => 'Redeem Min Limit',
                    'type' => FormModel::TYPE_TEXTINPUT,
                    'options' => ['placeholder' => 'Redeem Min Limit'],
                    'rules' => [['number', 'min' => 0]]
                ],
                'redeem.reset' => [
                    'label' => 'Redeem Reset Time (Hours)',
                    'type' => FormModel::TYPE_TEXTINPUT,
                    'options' => ['placeholder' => 'Redeem Reset Time (Hours)'],
                    'rules' => [['number', 'min' => 0]]
                ],
                'invite_only_signup' => [
                    'label' => 'Invite Only Signup',
                    'type' => FormModel::TYPE_WIDGET,
                    'widget' => SwitchInput::class,
                    'options' => [
                        'name' => 'inv_only_signup',
                        'inlineLabel' => false,
                        'pluginOptions' => [
                            'handleWidth' => 30,
                        ],
                        'class' => 'self-class'
                    ],
                ],
            ]
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Settings have been updated');
            return $this->refresh();
        }

        return $this->render('default', [
            'pageTitle' => 'General Settings',
            'model' => $model
        ]);
    }

    public function actionGetCountry()
    {
        if (!Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException();
        }

        $collection = GeoCountry::find()
            ->select(['id', 'country_name'])
            ->where(['like', 'country_name', Yii::$app->request->get('q')])
            ->all();

        return Json::encode($collection);
    }

    public function actionSecurity()
    {
        $model = Yii::createObject([
            'class' => FormModel::class,
            'keys' => [
                'security.ads' => [
                    'label' => 'AdsBlock Checker',
                    'type' => FormModel::TYPE_WIDGET,
                    'widget' => SwitchInput::class,
                    'options' => [
                        'inlineLabel' => false,
                        'pluginOptions' => [
                            'handleWidth' => 30,
                        ],
                        'class' => 'self-class'
                    ],
                ],
                'security.crawler' => [
                    'label' => 'Bots/Crawlers/Spiders Detect',
                    'type' => FormModel::TYPE_WIDGET,
                    'widget' => SwitchInput::class,
                    'options' => [
                        'inlineLabel' => false,
                        'pluginOptions' => [
                            'handleWidth' => 30,
                        ],
                        'class' => 'self-class'
                    ],
                ],
                'security.timezone' => [
                    'label' => 'Timezone',
                    'type' => FormModel::TYPE_WIDGET,
                    'widget' => SwitchInput::class,
                    'options' => [
                        'inlineLabel' => false,
                        'pluginOptions' => [
                            'handleWidth' => 30,
                        ],
                        'class' => 'self-class'
                    ],
                ],
                'security.risk_score' => [
                    'label' => 'Risk Score',
                    'type' => FormModel::TYPE_TEXTINPUT,
                    'rules' => [['number', 'min' => '0', 'max' => '99.9']],
                    'options' => ['placeholder' => 'Risk Score']
                ],
            ]
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Settings have been updated');
            return $this->refresh();
        }

        return $this->render('default', [
            'pageTitle' => 'Security Settings',
            'model' => $model
        ]);
    }

    public function actionSocial()
    {
        $model = Yii::createObject([
            'class' => FormModel::class,
            'keys' => [
                'social.fb' => [
                    'label' => 'Facebook',
                    'type' => FormModel::TYPE_TEXTINPUT,
                    'options' => ['placeholder' => 'Facebook'],
                    'rules' => [['url']]
                ],
                'social.twitter' => [
                    'label' => 'Twitter',
                    'type' => FormModel::TYPE_TEXTINPUT,
                    'options' => ['placeholder' => 'Twitter'],
                    'rules' => [['url']]
                ],
                'social.google' => [
                    'label' => 'Google+',
                    'type' => FormModel::TYPE_TEXTINPUT,
                    'options' => ['placeholder' => 'Google+'],
                    'rules' => [['url']]
                ],
                'social.youtube' => [
                    'label' => 'YouTube',
                    'type' => FormModel::TYPE_TEXTINPUT,
                    'options' => ['placeholder' => 'YouTube'],
                    'rules' => [['url']]
                ],
            ]
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Settings have been updated');
            return $this->refresh();
        }

        return $this->render('default', [
            'pageTitle' => 'Social Settings',
            'model' => $model
        ]);
    }
}

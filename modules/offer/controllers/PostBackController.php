<?php

namespace app\modules\offer\controllers;

use app\modules\core\components\controllers\Controller;
use app\modules\offer\controllers\postbacks\AdWorkMedia;
use app\modules\offer\controllers\postbacks\Clixwall;
use app\modules\offer\controllers\postbacks\CpaLead;
use app\modules\offer\controllers\postbacks\Fyber;
use app\modules\offer\controllers\postbacks\Kiwiwall;
use app\modules\offer\controllers\postbacks\MinuteStaff;
use app\modules\offer\controllers\postbacks\OfferDaddy;
use app\modules\offer\controllers\postbacks\OfferToro;
use app\modules\offer\controllers\postbacks\Persona;
use app\modules\offer\controllers\postbacks\Pollfish;
use app\modules\offer\controllers\postbacks\Ptcwall;
use app\modules\offer\controllers\postbacks\SuperRewards;
use yii\web\NotFoundHttpException;

class PostBackController extends Controller
{
    public function actions()
    {
        return [
            'awm' => [
                'class' => AdWorkMedia::class
            ],
            'ot' => [
                'class' => OfferToro::class
            ],
            'od' => [
                'class' => OfferDaddy::class
            ],
            'cw' => [
                'class' => Clixwall::class
            ],
            'pw' => [
                'class' => Ptcwall::class
            ],
            'kw' => [
                'class' => Kiwiwall::class
            ],
            'sr' => [
                'class' => SuperRewards::class
            ],
            'ms' => [
                'class' => MinuteStaff::class
            ],
            'cl' => [
                'class' => CpaLead::class
            ],
            'pl' => [
                'class' => Persona::class
            ],
            'fb' => [
                'class' => Fyber::class
            ],
            'pf' => [
                'class' => Pollfish::class
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (0 !== strcmp($this->action->accessHash, \Yii::$app->request->get('access_hash'))) {
            throw new NotFoundHttpException();
        }

        return parent::beforeAction($action);
    }
}

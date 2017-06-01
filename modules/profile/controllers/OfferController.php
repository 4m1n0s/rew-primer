<?php

namespace app\modules\profile\controllers;

use app\modules\offer\controllers\offerwalls\AdWorkMedia;
use app\modules\offer\controllers\offerwalls\Clixwall;
use app\modules\offer\controllers\offerwalls\CpaLead;
use app\modules\offer\controllers\offerwalls\Fyber;
use app\modules\offer\controllers\offerwalls\Kiwiwall;
use app\modules\offer\controllers\offerwalls\MinuteStaff;
use app\modules\offer\controllers\offerwalls\OfferDaddy;
use app\modules\offer\controllers\offerwalls\OfferToro;
use app\modules\offer\controllers\offerwalls\PaymentWall;
use app\modules\offer\controllers\offerwalls\Persona;
use app\modules\offer\controllers\offerwalls\Pollfish;
use app\modules\offer\controllers\offerwalls\Ptcwall;
use app\modules\offer\controllers\offerwalls\SuperRewards;
use \Yii;

/**
 * Class IndexController
 */
class OfferController extends ProfileController
{
    public $layout = '//frontend/main';

    public function beforeAction($action)
    {
        $this->view->registerJs('commercial_block_checker_module.init()');
        return parent::beforeAction($action);
    }

    public function actions()
    {
        return [
            'adworkmedia' => [
                'class' => AdWorkMedia::class,
                'view' => 'ad-work-media'
            ],
            'offertoro' => [
                'class' => OfferToro::class,
                'view' => 'offer-toro'
            ],
            'offerdaddy' => [
                'class' => OfferDaddy::class,
                'view' => 'offer-daddy'
            ],
            'clixwall' => [
                'class' => Clixwall::class,
                'view' => 'clixwall'
            ],
            'ptcwall' => [
                'class' => Ptcwall::class,
                'view' => 'ptcwall'
            ],
            'kiwiwall' => [
                'class' => Kiwiwall::class,
                'view' => 'kiwiwall'
            ],
            'superrewards' => [
                'class' => SuperRewards::class,
                'view' => 'super-rewards'
            ],
            'minutestaff' => [
                'class' => MinuteStaff::class,
                'view' => 'minute-staff'
            ],
            'cpalead' => [
                'class' => CpaLead::class,
                'view' => 'cpa-lead'
            ],
            'persona' => [
                'class' => Persona::class,
                'view' => 'persona'
            ],
            'fyber' => [
                'class' => Fyber::class,
                'view' => 'fyber'
            ],
            'pollfish' => [
                'class' => Pollfish::class,
                'view' => 'pollfish'
            ],
            'paymentwall' => [
                'class' => PaymentWall::class,
                'view' => 'payment-wall'
            ],
        ];
    }

    /**
     * Offer Wall page
     */
    public function actionWall()
    {
        $this->layout = '//frontend/profile';

        return $this->render('wall', []);
    }
}
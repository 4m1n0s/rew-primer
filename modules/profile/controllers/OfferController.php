<?php

namespace app\modules\profile\controllers;

use app\modules\offer\controllers\offerwalls\AdWorkMedia;
use app\modules\offer\controllers\offerwalls\Clixwall;
use app\modules\offer\controllers\offerwalls\CpaLead;
use app\modules\offer\controllers\offerwalls\Kiwiwall;
use app\modules\offer\controllers\offerwalls\MinuteStaff;
use app\modules\offer\controllers\offerwalls\OfferDaddy;
use app\modules\offer\controllers\offerwalls\OfferToro;
use app\modules\offer\controllers\offerwalls\Persona;
use app\modules\offer\controllers\offerwalls\Ptcwall;
use app\modules\offer\controllers\offerwalls\SuperRewards;
use \Yii;

/**
 * Class IndexController
 */
class OfferController extends ProfileController
{
    public $layout = '//frontend/main';

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
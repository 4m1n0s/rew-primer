<?php

namespace app\modules\offer\controllers;

use app\modules\core\components\controllers\Controller;
use app\modules\offer\controllers\postbacks\AdWorkMedia;
use app\modules\offer\controllers\postbacks\Clixwall;
use app\modules\offer\controllers\postbacks\OfferDaddy;
use app\modules\offer\controllers\postbacks\OfferToro;
use app\modules\offer\controllers\postbacks\Ptcwall;

class PostBackController extends Controller
{
    public function actions()
    {
        return [
            'adworkmedia' => [
                'class' => AdWorkMedia::class
            ],
            'offertoro' => [
                'class' => OfferToro::class
            ],
            'offerdaddy' => [
                'class' => OfferDaddy::class
            ],
            'clixwall' => [
                'class' => Clixwall::class
            ],
            'ptcwall' => [
                'class' => Ptcwall::class
            ],
        ];
    }
}

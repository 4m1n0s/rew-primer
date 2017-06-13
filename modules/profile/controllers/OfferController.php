<?php

namespace app\modules\profile\controllers;

use app\modules\offer\components\criteria\CriteriaGeoLocation;
use app\modules\offer\components\OfferCollection;
use app\modules\offer\models\Category;
use app\modules\offer\models\Offer;
use \Yii;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;
use app\modules\offer\controllers\offerwalls\AdWorkMedia;
use app\modules\offer\controllers\offerwalls\Clixwall;
use app\modules\offer\controllers\offerwalls\CpaLead;
use app\modules\offer\controllers\offerwalls\Dailymotion;
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
            'dailymotion' => [
                'class' => Dailymotion::class,
                'view' => 'dailymotion'
            ],
        ];
    }

    /**
     * OfferWalls page
     */
    public function actionList()
    {
        $this->layout = '//frontend/profile';

        $categories = Category::find()->select(['name'])->active()->asArray()->all();
        $offerCollection = \Yii::$app->offerFactory->createAll(true);

        $geoLocationCriteria = new CriteriaGeoLocation();
        $filteredCollection = $geoLocationCriteria->match($offerCollection);

        return $this->render('wall', [
            'offers' => $filteredCollection,
            'categories' => $categories
        ]);
    }

    public function actionSingle($id)
    {
        $offer = Offer::find()->where(['id' => $id])->active()->one();

        if (!$offer) {
            throw new NotFoundHttpException;
        }

        $offer->initTargeting();
        $offerCollection = new OfferCollection();
        $offerCollection->append($offer);

        $geoLocationCriteria = new CriteriaGeoLocation();
        $filteredCollection = $geoLocationCriteria->match($offerCollection);

        if ($filteredCollection->count() === 0) {
            throw new NotAcceptableHttpException;
        }

        switch ($offer->id) {
            case Offer::ADWORKMEDIA:
                return $this->adworkmedia();
            case Offer::KIWIWALL:
                return $this->kiwiwall();
            case Offer::OFFERTORO:
                return $this->offertoro();
            case Offer::OFFERDADDY:
                return $this->offerdaddy();
            case Offer::CLIXWALL:
                return $this->clixwall();
            case Offer::PTCWALL:
                return $this->ptcwall();
            case Offer::SUPERREWARDS:
                return $this->superrewards();
            case Offer::MINUTESTAFF:
                return $this->minutestaff();
            case Offer::CPALEAD:
                return $this->cpalead();
            case Offer::PERSONA:
                return $this->persona();
            case Offer::FYBER:
                return $this->fyber();
            case Offer::POLLFISH:
                return $this->pollfish();
            case Offer::PAYMENTWALL:
                return $this->paymentwall();
        }
    }

    public function adworkmedia()
    {
        $offerUrl = 'http://lockwall.xyz/wall/36f/{username}'; // TODO: Store it somewhere else
        $replace = [
            '{username}' => \Yii::$app->user->identity->username,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('ad-work-media', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    public function offertoro()
    {
        $offerUrl = 'https://www.offertoro.com/ifr/show/{pub_id}/{username}/{app_id}'; // TODO: Store it somewhere else
        $replace = [
            '{pub_id}' => 5077,
            '{username}' => \Yii::$app->user->identity->username,
            '{app_id}' => 2854,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('offer-toro', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    public function offerdaddy()
    {
        $offerUrl = 'https://www.offerdaddy.com/wall/{app_id}/{username}/'; // TODO: Store it somewhere else
        $replace = [
            '{app_id}' => 12838,
            '{username}' => \Yii::$app->user->identity->username,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('offer-daddy', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    public function clixwall()
    {
        $offerUrl = 'https://www.clixwall.com/wall.php?p={api_key}&u={username}'; // TODO: Store it somewhere else
        $replace = [
            '{api_key}' => 'H5H5D-6PWNL-PSD69',
            '{username}' => \Yii::$app->user->identity->username,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('clixwall', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    public function ptcwall()
    {
        $offerUrl = 'http://www.ptcwall.com/index.php?view=ptcwall&pubid={site_id}&usrid={username}'; // TODO: Store it somewhere else
        $replace = [
            '{site_id}' => '45swi56i8nj08b9z19',
            '{username}' => \Yii::$app->user->identity->username,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('ptcwall', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    public function kiwiwall()
    {
        $offerUrl = 'https://www.kiwiwall.com/wall/{app_id}/{username}'; // TODO: Store it somewhere else
        $replace = [
            '{app_id}' => 'SSl86OGDAaX3PF7X7HBeWQR8fSoJLJPH',
            '{username}' => \Yii::$app->user->identity->username,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('kiwiwall', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    public function superrewards()
    {
        $offerUrl = 'https://wall.superrewards.com/super/offers?h={app_hash}&uid={userID}'; // TODO: Store it somewhere else
        $replace = [
            '{app_hash}' => 'rplnqyskqlf.14111322870',
            '{userID}' => \Yii::$app->user->identity->id,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('super-rewards', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    public function minutestaff()
    {
        $offerUrl = 'https://offerwall.minutecircuit.com/display.php?app_id={app_id}&site_code={site_code}&user_id={userID}&site_type=all'; // TODO: Store it somewhere else
        $replace = [
            '{app_id}' => '859',
            '{site_code}' => '5ef55796afd8690d',
            '{userID}' => \Yii::$app->user->identity->id,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('minute-staff', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    public function cpalead()
    {
        $offerUrl = 'https://cpalead.com/mobile/locker/?pub={pub}&gateid={gateid}&subid={userID}'; // TODO: Store it somewhere else
        $replace = [
            '{pub}' => '765543',
            '{gateid}' => '1341944',
            '{username}' => \Yii::$app->user->identity->id,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('cpa-lead', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    public function persona()
    {
        $offerUrl = 'https://persona.ly/widget/?appid={appID}&userid={userID}'; // TODO: Store it somewhere else
        $replace = [
            '{appID}' => '93aa4722ccc529cfc231482b18b7d78f',
            '{userID}' => \Yii::$app->user->identity->id,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('persona', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    public function fyber()
    {
        $offerUrl = 'http://iframe.sponsorpay.com/?appid={app_id}&uid={user_id}'; // TODO: Store it somewhere else
        $replace = [
            '{app_id}' => 100965,
            '{user_id}' => \Yii::$app->user->identity->id,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('fyber', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    public function pollfish()
    {
        return $this->render('pollfish');
    }

    public function paymentwall()
    {
        $secretKey = '6c0ab436d36686d27a453f003968f904';
        $projectKey = 'bbb1cc657c6cea2c4c88e1de5234496b';
        $offerUrl = 'https://api.paymentwall.com/api/?key={project_key}&uid={userID}&widget=mw6_1&sign_version=1'; // TODO: Store it somewhere else
        $replace = [
            '{secret_key}' => $secretKey,
            '{project_key}' => $projectKey,
            '{userID}' => \Yii::$app->user->identity->id,
            '{sign}' => md5(\Yii::$app->user->identity->id . $secretKey),
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->render('payment-wall', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }
}
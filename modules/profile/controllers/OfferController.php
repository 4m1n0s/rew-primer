<?php

namespace app\modules\profile\controllers;

use app\modules\core\components\IPNormalizer;
use app\modules\offer\components\criteria\CriteriaDevice;
use app\modules\offer\components\criteria\CriteriaGeoLocation;
use app\modules\offer\components\OfferCollection;
use app\modules\offer\models\Category;
use app\modules\offer\models\Offer;
use app\modules\offer\assets\OfferAsset;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use \Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;

/**
 * Class IndexController
 */
class OfferController extends ProfileController
{
    public $layout = '//frontend/main';

    /**
     * OfferWalls page
     */
    public function actionList()
    {
        $this->layout = '//frontend/profile';

        $categories = Category::find()->select(['name'])->active()->asArray()->all();
        $offerCollection = \Yii::$app->offerFactory->createAll(true);

        $criteria = [
            $geoLocationCriteria = new CriteriaGeoLocation(),
            $deviceCriteria = new CriteriaDevice()
        ];

        foreach ($criteria as $criterion) {
            $offerCollection = $criterion->match($offerCollection);
        }

        return $this->render('wall', [
            'offers' => $offerCollection,
            'categories' => $categories
        ]);
    }

    public function actionSingle($id)
    {
        if (!Yii::$app->request->isAjax) {
            $this->getView()->registerAssetBundle(OfferAsset::class);
            $this->getView()->registerJs('offer_render_module.init()');

            return $this->render('default', [
                'offerID' => $id
            ]);
        }

        $offer = Offer::find()->where(['id' => $id])->active()->one();

        if (!$offer) {
            return $this->renderAjax('notFound');
        }

        if (!$this->isPermitted()) {
            return $this->renderAjax('deny');
        }

        $offerCollection = new OfferCollection();
        $offerCollection[] = $offer;

        $criteria = [
            $geoLocationCriteria = new CriteriaGeoLocation(),
            $deviceCriteria = new CriteriaDevice()
        ];

        foreach ($criteria as $criterion) {
            $offerCollection = $criterion->match($offerCollection);
        }

        if ($offerCollection->count() === 0) {
            return $this->renderAjax('notFound');
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
            case Offer::SAYSOPUBS:
                return $this->saysopubs();
            case Offer::DRYVERLESSADS:
                return $this->dryverlessads();
        }
    }

    /**
     * Checks if the user passed security
     *
     * @return bool
     */
    protected function isPermitted()
    {
        $keyStorage = Yii::$app->keyStorage;

        if ($keyStorage->get('security.crawler')) {
            $crawlerDetect = new CrawlerDetect();
            if ($crawlerDetect->isCrawler()) {
                return false;
            }
        }

        if ($keyStorage->get('security.timezone')) {
            $ip = YII_DEBUG ? Yii::$app->params['localIP'] : (new IPNormalizer())->getIP();
            $client = \Yii::$app->geoLocation->process($ip);
            $ipTimezone = $client->getTimezone();
            $ipdtz = new \DateTimeZone($ipTimezone);
            $ipTimeOffset = (new \DateTime('now', $ipdtz))->getOffset();

            $clientTimezone = Yii::$app->request->post('timezone');
            $clientdtz = new \DateTimeZone($clientTimezone);
            $clientTimeOffset = (new \DateTime('now', $clientdtz))->getOffset();

            $ipLocation = ArrayHelper::getValue($ipdtz->getLocation(), 'country_code');
            $clientLocation = ArrayHelper::getValue($clientdtz->getLocation(), 'country_code');

            if ($ipTimeOffset !== $clientTimeOffset) {
                return false;
            }
        }

        return true;
    }

    public function adworkmedia()
    {
        $offerUrl = 'http://lockwall.xyz/wall/36f/{username}'; // TODO: Store it somewhere else
        $replace = [
            '{username}' => \Yii::$app->user->identity->username,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->renderAjax('ad-work-media', [
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

        return $this->renderAjax('offer-toro', [
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

        return $this->renderAjax('offer-daddy', [
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

        return $this->renderAjax('clixwall', [
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

        return $this->renderAjax('ptcwall', [
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

        return $this->renderAjax('kiwiwall', [
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

        return $this->renderAjax('super-rewards', [
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

        return $this->renderAjax('minute-staff', [
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

        return $this->renderAjax('cpa-lead', [
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

        return $this->renderAjax('persona', [
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

        return $this->renderAjax('fyber', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    public function pollfish()
    {
        return $this->renderAjax('pollfish');
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

        return $this->renderAjax('payment-wall', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    public function saysopubs()
    {
        $projectKey = '5928a8cee4b092af1b9437cc';
        $offerUrl = 'http://survey.saysoforgood.com/trop/survey/{project_key}/RBUKS0517?rid={userID}'; // TODO: Store it somewhere else
        $replace = [
            '{project_key}' => $projectKey,
            '{userID}' => \Yii::$app->user->identity->id,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->renderAjax('saysopubs', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }

    public function dryverlessads()
    {
        $offerUrl = 'https://offerwall.dryverlessads.com/#/offers?appId={appId}&subid=&subid2=&subid3=&subid4=&subid5=&uid={userID}&un={username}'; // TODO: Store it somewhere else
        $replace = [
            '{appId}' => '4eda6d55-c67a-4a27-b4fa-9f3ebcd1087b',
            '{userID}' => \Yii::$app->user->identity->id,
            '{username}' => \Yii::$app->user->identity->username,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->renderAjax('dryverlessads', [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }
}
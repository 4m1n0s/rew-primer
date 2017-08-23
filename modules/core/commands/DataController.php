<?php

namespace app\modules\core\commands;

use app\modules\core\models\EmailQueue;
use app\modules\core\models\EmailTemplate;
use app\modules\core\models\GeoCountry;
use app\modules\offer\models\Offer;
use yii\base\InvalidConfigException;
use yii\console\Controller;

/**
 * Class PopulateDataController
 * @package app\modules\core\commands
 */
class DataController extends Controller
{
    /**
     * @throws InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function actionGeo()
    {
        $csv = \Yii::getAlias('@app') . '/data/GeoLite2-Country-Locations-en.csv';

        if (($handle = fopen($csv, "r")) !== FALSE) {
            $signature = fgetcsv($handle, null, ",");

            if (0 !== strcmp($signature[0], 'geoname_id') || 0 !== strcmp($signature[1], 'locale_code') ||
                0 !== strcmp($signature[2], 'continent_code') || 0 !== strcmp($signature[3], 'continent_name') ||
                0 !== strcmp($signature[4], 'country_iso_code') || 0 !== strcmp($signature[5], 'country_name')
            ) {
                throw new InvalidConfigException('Unexpected CSV signature');
            }

            $counter = 0;
            $batchSize = 100;
            $buffArr = [];
            $attributeNames = [
                'geoname_id',
                'locale_code',
                'continent_code',
                'continent_name',
                'country_iso_code',
                'country_name',
            ];

            GeoCountry::deleteAll();

            while (($data = fgetcsv($handle, null, ",")) !== FALSE) {

                if (empty($data[0]) || empty($data[1]) || empty($data[2]) ||
                    empty($data[3]) || empty($data[4]) || empty($data[5])
                ) {
                    continue;
                }

                array_walk($data, function ($value, $key) { return trim($value, " \t\n\r\0\x0B\""); });
                $buffArr[] = $data;

                if ($counter % $batchSize === 0) {
                    \Yii::$app->db->createCommand()->batchInsert(GeoCountry::tableName(), $attributeNames, $buffArr)->execute();
                    $buffArr = [];
                }

                $counter++;
            }

            // Insert remaining elements
            \Yii::$app->db->createCommand()->batchInsert(GeoCountry::tableName(), $attributeNames, $buffArr)->execute();
            fclose($handle);
        }
    }

    /**
     * @throws \yii\db\Exception
     */
    public function actionOffers()
    {
        Offer::deleteAll();
        \Yii::$app->db->createCommand()->batchInsert(Offer::tableName(), ['id', 'active', 'name', 'label', 'img'], [
            [Offer::ADWORKMEDIA, 1, 'Adworkmedia', 'Adworkmedia', '/images/offer-providers/adwork-media.png'],
            [Offer::KIWIWALL, 1, 'KiwiWall', 'KiwiWall', '/images/offer-providers/kiwiwall.png'],
            [Offer::OFFERTORO, 1, 'OfferToro', 'OfferToro', '/images/offer-providers/offertoro.png'],
            [Offer::OFFERDADDY, 1, 'OfferDaddy', 'OfferDaddy', '/images/offer-providers/offerdaddy.png'],
            [Offer::CLIXWALL, 1, 'ClixWall', 'ClixWall', '/images/offer-providers/clixwall.png'],
            [Offer::PTCWALL, 1, 'PtcWall', 'PtcWall', '/images/offer-providers/ptcwall.jpg'],
            [Offer::SUPERREWARDS, 1, 'SuperRewards', 'SuperRewards', '/images/offer-providers/superrewards.png'],
            [Offer::MINUTESTAFF, 1, 'MinuteStaff', 'MinuteStaff', '/images/offer-providers/minutestaff.png'],
            [Offer::CPALEAD, 1, 'CpaLead', 'CpaLead', '/images/offer-providers/cpalead.png'],
            [Offer::PERSONA, 1, 'Persona', 'Persona', '/images/offer-providers/persona.jpg'],
            [Offer::FYBER, 1, 'Fyber', 'Fyber', '/images/offer-providers/fyber_logo.png'],
            [Offer::POLLFISH, 1, 'PollFish', 'PollFish', '/images/offer-providers/pollfish.png'],
            [Offer::PAYMENTWALL, 1, 'PaymentWall', 'PaymentWall', '/images/offer-providers/paymentwall-logo.jpg'],
            [Offer::SAYSOPUBS, 1, 'SaySoPubs', 'SaySoPubs', '/images/no-image-default.png'],
            [Offer::DRYVERLESSADS, 1, 'DryverlessAds', 'DryverlessAds', '/images/no-image-default.png'],
            [Offer::MOBILEAVENUE, 1, 'MobileAvenue', 'MobileAvenue', '/images/no-image-default.png'],
        ])->execute();
    }

    public function actionTemplates()
    {
        EmailQueue::deleteAll();
        EmailTemplate::deleteAll();
        \Yii::$app->db->createCommand()->batchInsert(EmailTemplate::tableName(), ['id', 'name', 'content', 'subject'], [
            [EmailTemplate::TEMPLATE_INVITATION_REQUEST_RECEIVED, 'invitation_request_received', '', 'Invite Request Received'],
            [EmailTemplate::TEMPLATE_INVITATION_REQUEST_APPROVED, 'invitation_request_approved', '', 'Invite Request Approved'],
            [EmailTemplate::TEMPLATE_REGISTER_CONFIRMATION, 'signup_confirmation', '', 'Email Confirmation'],
            [EmailTemplate::TEMPLATE_USER_PASSWORD_RECOVERY, 'password_recovery', '', 'Password Recovery'],
            [EmailTemplate::TEMPLATE_REGISTER_REFERRAL_BONUS, 'new_referral_signed_up', '', 'Referral Bonus'],
            [EmailTemplate::TEMPLATE_USER_BLOCKED, 'user_blocked', '', 'Your account has been blocked'],
            [EmailTemplate::TEMPLATE_USER_UNBLOCKED, 'user_unblocked', '', 'Your account has been unblocked'],
            [EmailTemplate::TEMPLATE_ORDER_NEW, 'new_order_confirmation', '', 'Order Request Created'],
            [EmailTemplate::TEMPLATE_ORDER_DECLINED, 'new_order_declined', '', 'Order declined'],
            [EmailTemplate::TEMPLATE_ORDER_APPROVED, 'new_order_approved', '', 'Order approved'],
            [EmailTemplate::TEMPLATE_CONTACT_US, 'contact_reply', '', 'Contact Reply'],
        ])->execute();
    }
}
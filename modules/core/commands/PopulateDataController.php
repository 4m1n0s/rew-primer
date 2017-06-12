<?php

namespace app\modules\core\commands;

use app\modules\core\models\GeoCountry;
use app\modules\offer\models\Offer;
use yii\base\InvalidConfigException;
use yii\console\Controller;

/**
 * Class PopulateDataController
 * @package app\modules\core\commands
 */
class PopulateDataController extends Controller
{
    /**
     * @throws InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function actionGeoCities()
    {
        $csv = \Yii::getAlias('@app') . '/modules/core/components/geolocation/source-maxmind/GeoLite2-Country-Locations-en.csv';

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

            \Yii::$app->db->createCommand()->truncateTable(GeoCountry::tableName())->execute();

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
        \Yii::$app->db->createCommand()->batchInsert(Offer::tableName(), ['id', 'active', 'name', 'img'], [
            [10, 1, 'Adworkmedia', '/images/offer-providers/adwork-media.png'],
            [11, 1, 'KiwiWall', '/images/offer-providers/kiwiwall.png'],
            [12, 1, 'OfferToro', '/images/offer-providers/offertoro.png'],
            [13, 1, 'OfferDaddy', '/images/offer-providers/offerdaddy.png'],
            [14, 1, 'ClixWall', '/images/offer-providers/clixwall.png'],
            [15, 1, 'PtcWall', '/images/offer-providers/ptcwall.jpg'],
            [16, 1, 'SuperRewards', '/images/offer-providers/superrewards.png'],
            [17, 1, 'MinuteStaff', '/images/offer-providers/minutestaff.png'],
            [18, 1, 'CpaLead', '/images/offer-providers/cpalead.png'],
            [19, 1, 'Persona', '/images/offer-providers/persona.jpg'],
            [20, 1, 'Fyber', '/images/offer-providers/fyber_logo.png'],
            [21, 1, 'PollFish', '/images/offer-providers/pollfish.png'],
            [22, 1, 'PaymentWall', '/images/offer-providers/paymentwall-logo.jpg'],
        ])->execute();
    }

    public function actionMockCategories()
    {
        \Yii::$app->db->createCommand()->batchInsert('{{%category}}', ['id', 'active', 'name'], [
            [1, 1, 'Category 1'],
            [2, 1, 'Category 2'],
            [3, 1, 'Category 3'],
            [4, 1, 'Category 4'],
            [5, 1, 'Category 5'],
        ])->execute();

        \Yii::$app->db->createCommand()->batchInsert('{{%category_offer}}', ['category_id', 'offer_id'], [
            [1, 10],
            [3, 10],
            [4, 10],

            [2, 11],
            [4, 11],
            [5, 11],

            [1, 12],
            [2, 12],
            [5, 12],

            [1, 13],
            [2, 13],
            [5, 13],

            [1, 14],
            [3, 14],
            [4, 14],

            [2, 15],
            [3, 15],
            [5, 15],

            [2, 16],
            [4, 16],
            [5, 16],

            [1, 17],
            [2, 17],
            [3, 17],

            [3, 18],
            [4, 18],
            [5, 18],

            [1, 19],
            [3, 19],
            [5, 19],

            [1, 20],
            [2, 20],
            [4, 20],

            [3, 21],
            [4, 21],
            [5, 21],

            [2, 22],
            [3, 22],
            [5, 22],
        ])->execute();
    }
}
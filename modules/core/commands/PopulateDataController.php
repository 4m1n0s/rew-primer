<?php

namespace app\modules\core\commands;

use app\modules\core\models\GeoCountry;
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
}
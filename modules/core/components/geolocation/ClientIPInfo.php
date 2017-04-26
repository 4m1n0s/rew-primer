<?php

namespace app\modules\core\components\geolocation;

/**
 * Class LocationServiceIPInfo
 * @package app\modules\core\components\geolocation
 */
class ClientIPInfo implements LocationClientInterface
{
    /**
     * @var \stdClass
     */
    protected $data;

    /**
     * @param $ip
     * @return $this|bool
     */
    public function getResult($ip)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://ipinfo.io/$ip/json");
        curl_setopt($curl, CURLOPT_FAILONERROR, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);

        $result = curl_exec($curl); // run the whole process
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        $errorno = curl_errno($curl);

        curl_close($curl);

        if (false === $result) {
            $error =  "Curl error occurred: $error, curl error code: $errorno, response code: $status";
            // TODO Handle Curl error
            return false;
        }

        $decodedResult = json_decode($result);

        if (is_null($decodedResult)) {
            $jsonErrorCode = json_last_error();
            $jsonErrorMsg = json_last_error_msg();
            // TODO Handle wrong decode result data
            return false;
        }

        $this->data = $decodedResult;
        return true;
    }


    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->data->country;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->data->city;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->data->region;
    }
}
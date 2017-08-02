<?php

namespace app\modules\core\components\tasks;

use app\modules\user\models\UserIpLog;
use yii\base\ErrorException;
use yii\base\Object;
use yii\helpers\Json;
use yii\queue\Job;
use Yii;

class RiskScoreJob extends Object implements Job
{
    public $ipLogModelID;

    public function execute($queue)
    {
        try {
            $model = UserIpLog::find()->where(['id' => $this->ipLogModelID])->one();
            /* @var UserIpLog $model */
            if (!$model) {
                return false;
            }

            $scoreUrl = 'https://minfraud.maxmind.com/minfraud/v2.0/score';
            $data = ["device" => ['ip_address' => $model->ip]];

            $s = curl_init();

            curl_setopt($s,CURLOPT_URL, $scoreUrl);
            curl_setopt($s,CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($s,CURLOPT_FOLLOWLOCATION, 1);

            curl_setopt($s, CURLOPT_POST, 1);
            curl_setopt($s, CURLOPT_POSTFIELDS, json_encode($data));

            curl_setopt($s,CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($s,CURLOPT_USERPWD, Yii::$app->params['maxmind_user'] . ':' . Yii::$app->params['maxmind_pwd']);

            $response = curl_exec($s);
            $status = curl_getinfo($s, CURLINFO_HTTP_CODE);
            $error = curl_error($s);
            $errorno = curl_errno($s);

            curl_close($s);

            if (CURLE_OPERATION_TIMEOUTED == $errorno) {
                throw new ErrorException('Connection timeout');
            }
            if (false === $response) {
                throw new ErrorException(sprintf("Curl error occurred. \nResponse status: %s\nCurl error code: %s\nCurl error: %s", $status, $errorno, $error));
            }

            $decoded_result = Json::decode($response, false);
            if (is_null($decoded_result)) {
                throw new ErrorException('Could not decode ajax response');
            }
            if (empty($decoded_result->risk_score)) {
                throw new ErrorException($response);
            }

            $model->risk_score = $decoded_result->risk_score;
            if (!$model->save()) {
                throw new ErrorException('Could not save model');
            }

            return true;
        } catch (\Exception $e) {
            Yii::error($e->getMessage(), 'ip_log');
        }

        return false;
    }
}

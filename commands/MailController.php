<?php

namespace app\commands;

use app\components\MandrillMailer;
use app\helpers\DateHelper;
use app\models\EmailQueue;
use Yii;
use yii\console\Controller;
use yii\helpers\Json;

/**
 * @author Stableflow
 */
class MailController extends Controller
{
    public function actionSend()
    {
        if ($this->checkProcessStatus()) {
            exit();
        }

        $limit = (isset(Yii::$app->params['emailLimit']) && (int) Yii::$app->params['emailLimit'] > 0) ? (int) Yii::$app->params['emailLimit'] : 20;
        $collection = EmailQueue::find()->joinWith('template')->status(EmailQueue::STATUS_PROCESSING)->limit($limit)->all();
        $mandrill = Yii::$app->get('mandrillMailer');
        /* @var MandrillMailer $mandrill */

//        $keyStorage = Yii::$app->get('keyStorage');
//        $defaultTemplate = $keyStorage->get('mandrill_default_template');

        foreach ($collection as $key => $email) {
            $response = $mandrill->send($email->recipient, $email->sender, 'main_template', $email->template, Json::decode($email->params));

            if (isset($response[0], $response[0]['status']) && in_array($response[0]['status'], ['scheduled', 'queued', 'sent'])) {
                $email->updateAttributes([
                    'status'    => EmailQueue::STATUS_SENT,
                    'send_date' => DateHelper::getCurrentDateTime()
                ]);
            } else {
                $email->updateAttributes([
                    'status'    => EmailQueue::STATUS_REJECTED,
                    'send_date' => DateHelper::getCurrentDateTime(),
                    'note'  => Json::encode($response)
                ]);
            }
        }
    }

    /**
     * Check process exist.
     * @return boolean If process exist return true else false.
     */
    protected function checkProcessStatus() {
        $result = array();
        $isProccessExist = exec('ps aux | grep -v "/bin/sh"| grep mail/send', $result);
        if (count($result) > 2) {
            return true;
        }
        return false;
    }
}

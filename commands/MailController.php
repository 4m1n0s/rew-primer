<?php

namespace app\commands;

use app\helpers\DateHelper;
use app\modules\core\models\EmailQueue;
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

        $limit = (isset(Yii::$app->params['emailLimit']) && (int)Yii::$app->params['emailLimit'] > 0) ? (int) Yii::$app->params['emailLimit'] : 20;
        $collection = EmailQueue::find()->joinWith('template')->status(EmailQueue::STATUS_PROCESSING)->limit($limit)->all();
        $mailContainer = Yii::$app->mailContainer;

        foreach ($collection as $key => $email) {
            $mailContainer->send(
                $email,
                ['mandrill_template' => 'main_template']
            );

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

<?php

namespace app\modules\core\components\mailer\clients;

use app\helpers\DateHelper;
use app\modules\core\components\mailer\MailerInterface;
use app\modules\core\models\EmailQueue;
use app\modules\core\models\EmailTemplate;
use Aws\Credentials\Credentials;
use Aws\Ses\Exception\SesException;
use Aws\Ses\SesClient;
use yii\helpers\Json;

class Amazon implements MailerInterface
{
    public function send(EmailQueue $emailQueue, array $config = [])
    {
        $credentials = new Credentials(\Yii::$app->params['amazon_access_key'], \Yii::$app->params['amazon_secret_key']);
        $client = SesClient::factory(array(
            'version' => 'latest',
            'credentials' => $credentials,
            'region' => 'us-east-1',
        ));

        $request = [];
        $request['Source'] = $emailQueue->sender;
        $request['Destination']['ToAddresses'] = [$emailQueue->recipient];
        $request['Message']['Subject']['Data'] = $emailQueue->template->subject;
        $request['Message']['Body']['Text']['Data'] = $this->compose($emailQueue->template, $emailQueue->params);

        try {
            $result = $client->sendEmail($request);
            $emailQueue->updateAttributes([
                'status'    => EmailQueue::STATUS_SENT,
                'send_date' => DateHelper::getCurrentDateTime()
            ]);

            return true;
        } catch (SesException $e) {
            $emailQueue->updateAttributes([
                'status'    => EmailQueue::STATUS_REJECTED,
                'send_date' => DateHelper::getCurrentDateTime(),
                'note'  => Json::encode($e->getAwsErrorCode() . ' : ' . $e->getAwsErrorMessage())
            ]);
        } catch (\Exception $e) {
            $emailQueue->updateAttributes([
                'status'    => EmailQueue::STATUS_REJECTED,
                'send_date' => DateHelper::getCurrentDateTime(),
                'note'  => Json::encode($e->getMessage())
            ]);
        }

        return false;
    }

    /**
     * @param EmailTemplate $template
     * @param array $params
     * @return mixed
     */
    public function compose(EmailTemplate $template, array $params)
    {
        $needle = [];
        foreach ($params as $k => $item) {
            $needle[] = '[' . $k . ']';
        }
        return str_ireplace($needle, $params, $template->content);
    }
}
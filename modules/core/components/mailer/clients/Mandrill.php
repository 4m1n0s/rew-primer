<?php

namespace app\modules\core\components\mailer\clients;

use app\helpers\DateHelper;
use app\modules\core\components\mailer\MailerInterface;
use app\modules\core\models\EmailQueue;
use app\modules\core\models\EmailTemplate;
use yii\base\InvalidConfigException;
use yii\helpers\Json;

/**
 * Class Mandrill
 * @package app\modules\core\components\mailer\clients
 */
class Mandrill implements MailerInterface
{
    /**
     * @var \Mandrill instance
     */
    protected $mandrill;

    public function __construct()
    {
        $keyStorage = \Yii::$app->keyStorage;
        $apiKey = $keyStorage->get('mandrill_api_key');

        if (empty($apiKey)) {
            throw new InvalidConfigException('Not found API Key for Mandrill.');
        }

        $this->mandrill = new \Mandrill($apiKey);
    }

    /**
     * @param EmailQueue $emailQueue
     * @param array $config
     * @return array
     */
    public function send(EmailQueue $emailQueue, array $config = [])
    {
        $message = [
            'from_email' => $emailQueue->sender,
            'subject' => $emailQueue->template->subject,
            'to' => array(
                array(
                    'email' => $emailQueue->recipient,
                    'type' => 'to'
                )
            ),
            'merge' => true,
            'merge_language' => 'mailchimp',
        ];

        $template_content = [
            [
                'name' => 'body',
                'content' => $this->compose($emailQueue->template, Json::decode($emailQueue->params))
            ]
        ];

        $response = $this->mandrill->messages->sendTemplate($config['mandrill_template'], $template_content, $message);

        if (isset($response[0], $response[0]['status']) && in_array($response[0]['status'], ['scheduled', 'queued', 'sent'])) {
            $emailQueue->updateAttributes([
                'status'    => EmailQueue::STATUS_SENT,
                'send_date' => DateHelper::getCurrentDateTime()
            ]);

            return true;
        }

        $emailQueue->updateAttributes([
            'status'    => EmailQueue::STATUS_REJECTED,
            'send_date' => DateHelper::getCurrentDateTime(),
            'note'  => Json::encode($response)
        ]);
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
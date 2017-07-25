<?php

namespace app\modules\core\components\mailer;

use app\helpers\DateHelper;
use app\modules\core\models\EmailQueue;
use app\modules\core\models\EmailTemplate;
use yii\base\InvalidConfigException;
use yii\base\Object;
use yii\di\Instance;
use yii\helpers\Json;

class MailContainer extends Object
{
    /**
     * @var MailerInterface
     */
    protected $mailerClient;

    public function init()
    {
        $this->mailerClient = \Yii::createObject($this->mailerClient);
        if (!Instance::ensure($this->mailerClient, MailerInterface::class)) {
            throw new InvalidConfigException('Client must be ' . MailerInterface::class . ' instance');
        }
    }

    /**
     * mailerClient setter
     * @param $mailerClient
     */
    public function setMailerClient($mailerClient)
    {
        $this->mailerClient = $mailerClient;
    }

    /**
     * Add email to queue for further processing
     *
     * @param $recipient
     * @param $template
     * @param $params
     * @param bool $sender
     * @return bool
     * @throws InvalidConfigException
     */
    public function addToQueue($recipient, $template, $params = [], $sender = null)
    {
        $model = new EmailQueue([
            'template_id'   => $template,
            'sender'        => $sender ?: \Yii::$app->keyStorage->get('email'),
            'recipient'     => $recipient,
            'status'        => EmailQueue::STATUS_PROCESSING,
            'params'        => Json::encode($params),
            'create_date'   => DateHelper::getCurrentDateTime()
        ]);

        return $model->save();
    }

    /**
     * @param EmailQueue $emailQueue
     * @param array $config
     * @return mixed
     */
    public function send(EmailQueue $emailQueue, array $config = [])
    {
        return $this->mailerClient->send($emailQueue, $config);
    }
}

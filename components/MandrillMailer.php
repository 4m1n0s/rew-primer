<?php

namespace app\components;

use app\helpers\DateHelper;
use app\models\EmailQueue;
use app\models\EmailTemplate;
use yii\base\InvalidConfigException;
use yii\helpers\Json;

/**
 * Description of Email
 *
 * @author Stableflow
 */
class MandrillMailer
{
    /**
     * @var \Mandrill instance
     */
    protected $_mandrill;

    public function __construct()
    {
        $keyStorage = \Yii::$app->get('keyStorage');
        $apiKey = $keyStorage->get('mandrill_api_key');

        if (empty($apiKey)) {
            throw new InvalidConfigException('Not found API Key for Mandrill.');
        }

        $this->_mandrill = new \Mandrill($apiKey);
    }
    
    /**
     * Get template list
     * @param string $label
     * @return array
     */
    public function getTemplateList($label = null) {
        return $this->_mandrill->templates->getList($label);
    }

    /**
     * @param $recipient
     * @param $sender
     * @param $mandrillTemplate
     * @param $template
     * @param $params
     * @return array
     */
    public function send($recipient, $sender, $mandrillTemplate, EmailTemplate $template, $params)
    {
        $message = [
            'from_email' => $sender,
            'subject' => $template->subject,
            'to' => array(
                array(
                    'email' => $recipient,
                    'type' => 'to'
                )
            ),
            'merge' => true,
            'merge_language' => 'mailchimp',
        ];

        $template_content = [
            [
                'name' => 'body',
                'content' => $this->getDynamicData($template->content, $params)
            ]
        ];

        return $this->_mandrill->messages->sendTemplate($mandrillTemplate, $template_content, $message);
    }

    /**
     * @param $content
     * @param $params
     * @return mixed
     */
    protected function getDynamicData($content, $params)
    {
        $needle = [];

        foreach ($params as $k => $item) {
            $needle[] = '[' . $k . ']';
        }

        return str_ireplace($needle, $params, $content);
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
            'sender'        => $sender ?: \Yii::$app->get('keyStorage')->get('email'),
            'recipient'     => $recipient,
            'status'        => EmailQueue::STATUS_PROCESSING,
            'params'        => Json::encode($params),
            'create_date'   => DateHelper::getCurrentDateTime()
        ]);

        return $model->save();
    }
}

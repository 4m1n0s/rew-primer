<?php

namespace app\modules\core\components\mailer;

use app\modules\core\models\EmailQueue;

interface MailerInterface
{
    public function send(EmailQueue $emailQueue, array $config = []);
}
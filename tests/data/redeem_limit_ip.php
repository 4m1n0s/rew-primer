<?php

return [
    'first' => [
        'ip' => (new \app\modules\core\components\IPNormalizer())->getIP(),
        'amount' => 50,
        'created_at' => date('Y:m:d H:i:s', strtotime("-25 hours", time())),
        'updated_at' => date('Y:m:d H:i:s', strtotime("-25 hours", time())),
    ],
    'second' => [
        'ip' => (new \app\modules\core\components\IPNormalizer())->getIP(),
        'amount' => 100,
        'created_at' => \app\helpers\DateHelper::getCurrentDateTime(),
        'updated_at' => \app\helpers\DateHelper::getCurrentDateTime(),
    ]
];
<?php

return [
    'first' => [
        'user_id' => 2,
        'amount' => 50,
        'created_at' => date('Y:m:d H:i:s', strtotime("-25 hours", time())),
        'updated_at' => date('Y:m:d H:i:s', strtotime("-25 hours", time())),
    ],
    'second' => [
        'user_id' => 2,
        'amount' => 100,
        'created_at' => \app\helpers\DateHelper::getCurrentDateTime(),
        'updated_at' => \app\helpers\DateHelper::getCurrentDateTime(),
    ]
];
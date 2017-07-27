<?php

return [
    [
        'username' => 'admin',
        'email' => 'sf_admin@gmail.com',
        'role' => \app\modules\user\models\User::ROLE_ADMIN,
        'password' => \app\modules\user\helpers\Password::hash('SfPass123'),
        'referral_code' => Yii::$app->security->generateRandomString(12),
        'create_date' => gmdate("Y-m-d H:i:s", time()),
        'status' => \app\modules\user\models\User::STATUS_APPROVED
    ],
    [
        'username' => 'sf_user',
        'email' => 'sf_user@gmail.com',
        'role' => \app\modules\user\models\User::ROLE_USER,
        'password' => \app\modules\user\helpers\Password::hash('pass123123'),
        'referral_code' => Yii::$app->security->generateRandomString(12),
        'create_date' => gmdate("Y-m-d H:i:s", time()),
        'status' => \app\modules\user\models\User::STATUS_APPROVED
    ]
];
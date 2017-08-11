<?php

return [
    'admin' => [
        'id' => 1,
        'username' => 'admin',
        'email' => 'sf_admin@gmail.com',
        'role' => \app\modules\user\models\User::ROLE_ADMIN,
        'password' => \app\modules\user\helpers\Password::hash('SfPass123'),
        'referral_code' => Yii::$app->security->generateRandomString(12),
        'create_date' => gmdate("Y-m-d H:i:s", time()),
        'status' => \app\modules\user\models\User::STATUS_APPROVED,
        'virtual_currency' => 0
    ],
    'sf_user' => [
        'id' => 2,
        'username' => 'sf_user',
        'email' => 'sf_user@gmail.com',
        'role' => \app\modules\user\models\User::ROLE_USER,
        'password' => \app\modules\user\helpers\Password::hash('pass123123'),
        'referral_code' => Yii::$app->security->generateRandomString(12),
        'create_date' => gmdate("Y-m-d H:i:s", time()),
        'status' => \app\modules\user\models\User::STATUS_APPROVED,
        'virtual_currency' => 105
    ],
    'test_name' => [
        'id' => 3,
        'username' => 'test_name',
        'email' => 'test-email@virtual.box',
        'role' => \app\modules\user\models\User::ROLE_USER,
        'password' => \app\modules\user\helpers\Password::hash('qwerty'),
        'create_date' => \Faker\Provider\DateTime::date('Y-m-d H:i:s'),
        'status' => \app\modules\user\models\User::STATUS_TEMP,
        'virtual_currency' => 0
    ],
    'simple_user_1' => [
        'id' => 4,
        'username' => 'test_simple_name_1',
        'email' => 'test-simple_email_1@mail.com',
        'role' => \app\modules\user\models\User::ROLE_USER,
        'password' => \app\modules\user\helpers\Password::hash('qwerty'),
        'create_date' => \Faker\Provider\DateTime::date('Y-m-d H:i:s'),
        'status' => \app\modules\user\models\User::STATUS_APPROVED,
        'virtual_currency' => 0
    ],
    'affiliate' => [
        'id' => 5,
        'username' => 'test_affiliate',
        'email' => 'test-email-affiliate@mail.com',
        'role' => \app\modules\user\models\User::ROLE_PARTNER,
        'password' => \app\modules\user\helpers\Password::hash('qwerty'),
        'create_date' => \Faker\Provider\DateTime::date('Y-m-d H:i:s'),
        'status' => \app\modules\user\models\User::STATUS_APPROVED,
        'virtual_currency' => 0
    ]
];
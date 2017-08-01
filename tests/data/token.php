<?php

return [
    'activate_token' => [
        'user_id' => 3,
        'code' => 'test_token',
        'create_date' => \app\helpers\DateHelper::getCurrentDateTime(),
        'type' => \app\modules\user\models\Token::TYPE_ACTIVATE,
        'expire' => \app\helpers\DateHelper::getCurrentDateTime(),
        'status' => \app\modules\user\models\Token::STATUS_NEW,
        'ip' => \Yii::$app->params['localIP']
    ]
];
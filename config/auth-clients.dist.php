<?php

return [
    'google' => [
        'class' => 'yii\authclient\clients\Google',
        'clientId' => 'google_client_id',
        'clientSecret' => 'google_client_secret',
    ],
    'twitter' => [
        'class' => 'yii\authclient\clients\Twitter',
        'attributeParams' => [
            'include_email' => 'true'
        ],
        'consumerKey' => 'twitter_consumer_key',
        'consumerSecret' => 'twitter_consumer_secret',
    ],
    'facebook' => [
        'class' => 'yii\authclient\clients\Facebook',
        'clientId' => 'facebook_client_id',
        'clientSecret' => 'facebook_client_secret',
    ],
];
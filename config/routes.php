<?php

return [
    
    'dashboard/profile' => 'user/index-backend/profile',
    
    'dashboard/login' => 'user/account/back-login',
    
    'dashboard' => 'dashboard/index-backend/index',

    'sign-up/<code:[a-zA-Z0-9_-]+>' => 'user/account/sign-up',
    'sign-up/' => 'user/account/sign-up',
    'sign-in/' => 'user/account/login',
    'profile' => 'profile/index/account',
    'recovery/request' => 'user/account/recovery-request',

    'contact-us' => 'site/contact-us',
    'faq' => 'site/faq',
    'invite' => '/user/account/invitation-request',

    'activate/<token:[a-zA-Z0-9_-]+>' => 'user/account/activate',
    'recovery/reset/<code:[a-zA-Z0-9_-]+>' => 'user/account/recovery-reset',

    '/' => 'site/index'
];

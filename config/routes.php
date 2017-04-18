<?php

return [

    // frontend
    'contact-us' => 'site/contact-us',
    'faq' => 'site/faq',
    'invite' => '/user/account/invitation-request',

    'sign-up/<code:[a-zA-Z0-9_-]+>' => 'user/account/sign-up',
    'sign-up/' => 'user/account/sign-up',
    'sign-in/' => 'user/account/login',
    'recovery/request' => 'user/account/recovery-request',
    'activate/<token:[a-zA-Z0-9_-]+>' => 'user/account/activate',
    'recovery/reset/<code:[a-zA-Z0-9_-]+>' => 'user/account/recovery-reset',
    'profile' => 'profile/index/account',
    'referral/<code>' => 'profile/default/referral-request',
    '/' => 'site/index',

    // backend
    'dashboard/invitation/index' => 'invitation/index-backend/index',
    'dashboard/settings/index' => 'settings/index-backend/index',
    'dashboard/user/<action>' => 'user/index-backend/<action>',
    'dashboard/profile' => 'user/index-backend/profile',
    'dashboard/login' => 'user/account/back-login',
    'dashboard' => 'dashboard/index-backend/index',
];

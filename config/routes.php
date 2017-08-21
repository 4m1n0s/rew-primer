<?php

return [

    // Profile
    '/profile/offerwall/<id>' => '/profile/offer/single',
    '/profile/offerwall' => '/profile/offer/list',
    '/profile/account/info' => '/profile/index/account',
    '/profile/order-history'=> '/catalog/order-history/list',
    '/profile/completion-history'=> '/profile/stats/completion-history',
    '/profile/stats' => '/profile/stats/index',
    '/profile/account/<action>' => '/profile/index/<action>',

    // Frontend
    'pb/<action>/<access_hash>' => '/offer/post-back/<action>',
    'contact-us' => '/contact/index/index',
    'faq' => 'site/faq',
    'about' => 'site/about',
    'terms' => 'site/terms',
    'invite' => '/user/account/invitation-request',
    'catalog' => '/catalog/catalog/index',
    'catalog/<id>' => '/catalog/catalog/single',
    'catalog/group/<id>' => '/catalog/catalog/group',
    'cart/<_a>' => '/catalog/cart/<_a>',

    'sign-up/<code:[a-zA-Z0-9_-]+>' => 'user/account/sign-up',
    'sign-up/' => 'user/account/sign-up',
    'sign-in/' => 'user/account/login',
    'recovery/request' => 'user/account/recovery-request',
    'activate/<token:[a-zA-Z0-9_-]+>' => 'user/account/activate',
    'recovery/reset/<code:[a-zA-Z0-9_-]+>' => 'user/account/recovery-reset',
    'referral/<code>' => 'profile/default/referral-request',
    '/' => 'site/index',

    // Backend
    'dashboard/invitation/index' => 'invitation/index-backend/index',
    'dashboard/email/<_a>' => 'core/email-template/<_a>',
    'dashboard/catalog/order/<_a>' => 'catalog/backend-order/<_a>',
    'dashboard/catalog/product/<_a>' => 'catalog/backend-product/<_a>',
    'dashboard/catalog/category/<_a>' => 'catalog/backend-category/<_a>',
    'dashboard/catalog/product-group/<_a>' => 'catalog/backend-product-group/<_a>',
    'dashboard/catalog/group-category/<_a>' => 'catalog/backend-category-group/<_a>',
    'dashboard/offer/<_a>' => 'offer/backend-offer/<_a>',
    'dashboard/category/<_a>' => 'offer/backend-category/<_a>',
    'dashboard/settings/<_a>' => 'settings/index-backend/<_a>',
    'dashboard/user-group/<action>' => 'user/user-group-backend/<action>',
    'dashboard/contact/<action>' => 'contact/index-backend/<action>',
    'dashboard/user/<action>' => 'user/index-backend/<action>',
    'dashboard/profile' => 'user/index-backend/profile',
    'dashboard/login' => 'user/account/back-login',
    'dashboard' => 'dashboard/index-backend/index',
];

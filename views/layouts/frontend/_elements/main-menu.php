<nav id="mainMenu" class="main-menu mega-menu">
    <?php
    $module = Yii::$app->controller->module->id;
    $controller = Yii::$app->controller->id;
    $action = Yii::$app->controller->action->id;

    echo \yii\widgets\Menu::widget([
        'options' => [
            'class' => 'main-menu nav nav-pills',
        ],
        'encodeLabels' => false,
        'activeCssClass' => 'active',
        'submenuTemplate' => "<ul class=\"dropdown-menu\">{items}</ul>",
        'items' => [
            [
                'label' => '<i class="fa fa-home"></i>',
                'url' => Yii::$app->user->isGuest ? ['/site/index'] : ['/profile/offer/wall']
            ],
            ['label' => Yii::t('app', 'Contact Us'), 'url' => ['/contact/index/index']],
            ['label' => Yii::t('app', 'FAQ') , 'url' => ['/site/faq']],
            [
                'label' => Yii::t('app', 'Sign Up'),
                'url' => ['/user/account/sign-up'],
                'active' => $module == 'user' && $controller == 'account' && ($action == 'invitation-request' || $action == 'sign-up'),
                'visible' => Yii::$app->user->isGuest,
            ],
            Yii::$app->user->isGuest ?
                [
                    'label' => Yii::t('app', 'Sign In'),
                    'url' => ['/user/account/login'],
                    'active' => $module == 'user' && $controller == 'account' && $action == 'login',
                    'visible' => Yii::$app->user->isGuest,
                ] :
                [
                    'label' => Yii::$app->getUser()->getIdentity()->username,
                    'url' => '#',
                    'options' => [
                        'class' => 'dropdown'
                    ],
                    'items' => [
                        [
                            'label' => \Yii::t('app', 'Offer Walls'),
                            'url' => ['/profile/offer/wall'],
                        ],
                        [
                            'label' => \Yii::t('app', 'My Account'),
                            'url' => Yii::$app->getUser()->getIdentity()->role == 1 ? ['/user/index-backend/profile'] : ['/profile/index/account'],
                        ],
                        [
                            'label' => \Yii::t('app', 'Referral Program'),
                            'url' => ['/profile/referral/index'],
                        ],
                        [
                            'label' => \Yii::t('app', 'Log Out'),
                            'url' => ['/user/account/logout'],
                        ],
                    ],
                    'visible' => !Yii::$app->user->isGuest,
                ],
        ],
    ]);
    ?>
</nav>
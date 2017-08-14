<?php
use app\modules\user\models\User;
?>
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
                'label' => Yii::t('app', 'Sign Up'),
                'url' => ['/user/account/sign-up'],
                'active' => $module == 'user' && $controller == 'account' && ($action == 'invitation-request' || $action == 'sign-up'),
                'visible' => Yii::$app->user->isGuest && !($controller == 'site' && $action == 'index'),
            ],
            Yii::$app->user->isGuest ?
                [
                    'label' => Yii::t('app', 'Sign In'),
                    'url' => ['/user/account/login'],
                    'active' => $module == 'user' && $controller == 'account' && $action == 'login',
                    'visible' => Yii::$app->user->isGuest,
                    'template' => '<a href="{url}" class="link-active"><span>{label}</span></a>',
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
                            'url' => ['/profile/offer/list'],
                            'visible' => !Yii::$app->getUser()->getIdentity()->getIsPartner(),
                        ],
                        [
                            'label' => \Yii::t('app', 'Cart') . ' (' . \app\modules\catalog\widgets\CartCount::widget() . ')',
                            'url' => ['/catalog/cart/view'],
                            'visible' => !Yii::$app->getUser()->getIdentity()->getIsPartner(),

                        ],
                        [
                            'label' => \Yii::t('app', 'Orders History'),
                            'url' => ['/catalog/order-history/list'],
                            'visible' => !Yii::$app->getUser()->getIdentity()->getIsPartner(),

                        ],
                        [
                            'label' => \Yii::t('app', 'Completion History'),
                            'url' => ['/profile/stats/completion-history'],
                            'visible' => !Yii::$app->getUser()->getIdentity()->getIsPartner(),

                        ],
                        [
                            'label' => \Yii::t('app', 'Stats'),
                            'url' => ['/profile/stats/index'],
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
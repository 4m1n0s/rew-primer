<?php

/* @var \yii\web\View $this */


use yii\helpers\Url;
use yii\widgets\Menu;
?>
<header id="header" class="header-light">
    <div id="header-wrap">
        <div class="container">

            <!--LOGO-->
            <div id="logo">
                <a href="/" class="logo" data-dark-logo="/images/logo-dark.png">
                    <img src="/images/logo.png" alt="Polo Logo">
                </a>
            </div>
            <!--END: LOGO-->

            <!--MOBILE MENU -->
            <div class="nav-main-menu-responsive">
                <button class="lines-button x">
                    <span class="lines"></span>
                </button>
            </div>
            <!--END: MOBILE MENU -->


            <!--NAVIGATION-->
            <div class="navbar-collapse collapse main-menu-collapse navigation-wrap">
                <div class="container">
                    <nav id="mainMenu" class="main-menu mega-menu">
                        <?php
                        $module = Yii::$app->controller->module->id;
                        $controller = Yii::$app->controller->id;
                        $action = Yii::$app->controller->action->id;

                        echo Menu::widget([
                            'options' => [
                                'class' => 'main-menu nav nav-pills',
                            ],
                            'encodeLabels' => false,
                            'activeCssClass' => 'active',
                            'items' => [
                                ['label' => '<i class="fa fa-home"></i>', 'url' => ['/site/index']],
                                ['label' => Yii::t('app', 'Contact Us'), 'url' => ['/site/contact-us']],
                                ['label' => Yii::t('app', 'FAQ') , 'url' => ['/site/faq']],
                                [
                                    'label' => Yii::t('app', 'Sign Up'),
                                    'url' => ['/user/account/sign-up'],
                                    'active' => $module == 'user' && $controller == 'account' && ($action == 'invitation-request' || $action == 'sign-up'),
                                ],
                                [
                                    'label' => Yii::t('app', 'Sign In'),
                                    'url' => ['/user/account/login'],
                                    'active' => $module == 'user' && $controller == 'account' && ($action == 'login' || $action == 'login'),
                                ],
                            ],
                        ]);
                        ?>
                    </nav>
                </div>
            </div>
            <!--END: NAVIGATION-->
        </div>
    </div>
</header>
<div class="row">
    <?php
    if (Yii::$app->session->getFlash('success')) {
        ?>
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p class="text-center"><?= Yii::$app->session->getFlash('success') ?></p>
        </div>
        <?php
    }
    if (Yii::$app->session->getFlash('error')) {
        ?>
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p class="text-center"><?= Yii::$app->session->getFlash('error') ?></p>
        </div>
        <?php
    }
    ?>
</div>
<!-- END: HEADER -->
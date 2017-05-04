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
                    <img src="/images/rewardbuckslogo.png" alt="Polo Logo" >
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
                    <?= $this->render('main-menu')?>
                </div>
            </div>
            <!--END: NAVIGATION-->
        </div>
    </div>
</header>
<div class="row">
    <?php
    if (Yii::$app->session->hasFlash('success')) {
        ?>
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p class="text-center"><?= Yii::$app->session->getFlash('success') ?></p>
        </div>
        <?php
    }
    if (Yii::$app->session->hasFlash('error')) {
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
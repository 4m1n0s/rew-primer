<?php 
use yii\helpers\Html;
?>

<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="/">
<!--                <img src="/backend/global/img/logo.png" alt="logo" class="logo-default" style="height: 25px" /> -->
                <h4>Home</h4>
            </a>
            <div class="menu-toggler sidebar-toggler"> </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        
                        <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->avatar !== null): ?>
                            <img alt="" class="img-circle" src="<?= Yii::$app->user->identity->avatar ?>" />
                        <?php else: ?>
                            <img src="http://www.placehold.it/29x29/EFEFEF/AAAAAA&amp;text=no+image" alt="" class="img-responsive">
                        <?php endif; ?>
                        <span class="username username-hide-on-mobile"> <?= !Yii::$app->user->isGuest && Yii::$app->user->identity->email !== null ? Yii::$app->user->identity->email : 'Email' ?> </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <?= Html::a('<i class="icon-user"></i>' . Yii::t('admin', 'My Profile'), ['/user/index-backend/profile']); ?>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <?= Html::a('<i class="icon-key"></i>' . Yii::t('admin', 'Log Out'), ['/user/account/logout']); ?>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>

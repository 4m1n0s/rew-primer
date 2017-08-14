<?php

/* @var \yii\web\View $this */

use yii\helpers\Url;
use yii\widgets\Menu;
?>

<header id="header" class="header-light header-sticky <?php echo Yii::$app->user->isGuest ? '' : 'logged' ?>">
    <div id="header-wrap">
        <div class="container">

            <!--LOGO-->
            <div id="logo">
                <a href="/">
                    <img class="logo-desktop" src="/images/rewardbuckslogo.png" alt="Polo Logo" >
                    <img class="logo-mob" src="/images/rewardbuckslogo-mob.png" alt="Polo Logo mob" >
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
            <div class="navigation-wrap pull-right">
                <div class="container">
                    <?= $this->render('main-menu') ?>
                </div>
            </div>
            <!--END: NAVIGATION-->

            <?php if (!Yii::$app->user->isGuest): ?>
                <div class="mob-position">
                    <div class="block-point">
                        <a href="<?php echo Url::toRoute(['/profile/stats/index']) ?>">
                            <div title="<?php echo Yii::$app->user->identity->virtual_currency ?>">
                                <span><img src="/images/coins.png" alt="" ></span>
                                <?php echo \yii\bootstrap\Html::tag('span', Yii::$app->user->identity->getVC()) ?>
                            </div>
                        </a>
                    </div>
                    <?php if (!Yii::$app->getUser()->getIdentity()->getIsPartner()): ?>
                    <div class="block-header">
                        <a href="<?php echo Url::toRoute(['/profile/stats/completion-history']) ?>">
                            <span class="vertical-align-top"><img src="/images/1.png" alt=""></span>
                            <span class="txt-bl-header"><?php echo \app\modules\core\widgets\TransactionCount::widget([
                                'type' => \app\modules\core\models\Transaction::TYPE_OFFER_INCOME
                            ]) ?></span>
                        </a>
                    </div>
                    <?php endif ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</header>
<?php echo \app\modules\core\widgets\AdsBlock::widget() ?>
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
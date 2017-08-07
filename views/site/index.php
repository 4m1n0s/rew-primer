<?php

use yii\bootstrap\ActiveForm;
use app\assets\DatePickerAsset;
use yii\helpers\Html;
use yii\authclient\widgets\AuthChoice;

DatePickerAsset::register($this);

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\user\forms\RegistrationForm */

$urlPortfolio = '/images/portfolio/';
$urlMockup = '/images/mockup/';

?>

<!-- PAGE TITLE -->
<section id="page-title" class="page-title-parallax page-title-center" style="height: 500px; background-image:url(/images/large-phone-bg.jpg);">
    <div class="container">
        <?php if (!Yii::$app->keyStorage->get('invite_only_signup')): ?>
            <div class="form-relative clearfix">
                <?php echo \app\modules\user\widgets\RegisterBriefForm::widget() ?>
            </div>
        <?php else: ?>
            <div class="form-relative text-light clearfix">
                <?php echo \app\modules\user\widgets\RegisterInviteForm::widget() ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<!-- END: PAGE TITLE -->

<!-- WHAT WE DO -->
<section class="background-grey">
    <div class="container">
        <div class="text-center">
            <h2>Get Rewards For Doing Stuff Online!</h2>
        </div>
        <div class="row">
            <br>
            <div class="col-md-4 col-sm-12">
                <div class="icon-box effect medium center border">
                    <div class="icon"> <a href="/about#section-1"><i class="fa fa-check-square"></i></a> </div>
                    <h3>Completing surveys</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="icon-box effect medium center border">
                    <div class="icon"> <a href="/about#section-2"><i class="fa fa-video-camera"></i></a> </div>
                    <h3>Watching videos</h3>
                    <p>Suspendisse condimentum porttitor cursumus. Lorem ipsum dolor sit amet, consecte.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="icon-box effect medium center border">
                    <div class="icon"> <a href="/about#section-3"><i class="fa fa-search"></i></a> </div>
                    <h3>Searching the web</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END WHAT WE DO -->

<section>
    <div class="container">
        <div class="text-left">
            <h2>Join RewardBucks - Make "Bucks" Now.</h2>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <p class="text-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Vestibulum id metus ac nisl bibendum scelerisque non non purus. Suspendisse varius nibh non aliquet sagittis. In tincidunt orci sit amet elementum vestibulum. Vivamus fermentum in arcu in aliquam.</p>
            </div>
        </div>
        <div class="text-center">
            <a class="button btn-primary button-3d effect fill" href="/sign-up"><span>Sign up & get "Bucks" today</span></a>
        </div>
    </div>
</section>

<?php
$js = <<<JS
$(function () {
    $('#datePickerBirthday').datetimepicker({
        viewMode: 'years',
        format: 'YYYY-MM-DD',
        useCurrent: false
    });
    
    
});
JS;
$this->registerJs($js, $this::POS_READY);
?>
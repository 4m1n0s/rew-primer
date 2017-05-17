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
        <div class="page-title col-md-8">
            <!--            <h1>Left page title version</h1>-->
            <!--            <span>Subtext for page title. Lorem ipsum viverra a!</span>-->
        </div>
        <?php if (!Yii::$app->keyStorage->get('invite_only_signup')): ?>

            <div class="form-relative clearfix">
                <div class="form-group form-group-sm">
                    <?php $form = ActiveForm::begin([
                        'enableClientScript' => false,
                        'options' => [
                            'id' => 'front-sign-form',
                        ],
                        'fieldConfig' => [
                            'template' => '{input}<p class="m-t-5"></p>',
                            'options' => ['class' => 'col-md-6']
                        ],
                    ]); ?>

                    <div class="form-group text-center">
                        <p>Join Now to Start Earning Extra Bucks!</p>
                    </div>                  
                    
                    <div class="form-group btn-group btn-group-justified" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                            <?php echo Html::a('<i class="fa fa-facebook"></i> facebook',
                                ['user/account/auth', 'authclient'=> Yii::$app->authClientCollection->getClient('facebook')->name],
                                ['class' => 'social-facebook btn-sm btn']
                            ) ?>
                        </div>
                        <div class="btn-group" role="group">
                            <?php echo Html::a('<i class="fa fa-twitter"></i> twitter',
                                ['user/account/auth', 'authclient'=> Yii::$app->authClientCollection->getClient('twitter')->name],
                                ['class' => 'social-twitter btn-sm btn']
                            ) ?>
                        </div>
                        <div class="btn-group" role="group">
                            <?php echo Html::a('<i class="fa fa-google-plus"></i> google',
                                ['user/account/auth', 'authclient'=> Yii::$app->authClientCollection->getClient('google')->name],
                                ['class' => 'social-google btn-sm btn']
                            ) ?>
                        </div>
                    </div>

                    <div class="form-group-or text-center">
                        <p>or</p>
                    </div> 

                    <div class="row">

                        <?= $form->field($model, 'first_name')->textInput([
                            'placeholder' => 'First Name',
                        ]); ?>

                        <?= $form->field($model, 'last_name')->textInput([
                            'placeholder' => 'Last Name',
                        ]); ?>

                    </div>

                    <div class="row">

                        <?= $form->field($model, 'username')->textInput([
                            'placeholder' => Yii::t('app', 'Username'),
                            'class' => 'form-control'
                        ]); ?>

                        <?= $form->field($model, 'email')->textInput([
                            'placeholder' => Yii::t('app', 'E-mail'),
                            'type' => 'email',
                            'class' => 'form-control'
                        ]); ?>

                    </div>

                    <div class="row">

                        <?php echo $form->field($model, 'password')->passwordInput([
                            'placeholder' => Yii::t('app', 'Password'),
                            'type' => 'password',
                            'class' => 'form-control'
                        ]); ?>

                        <?php echo $form->field($model, 'confirmPassword')->passwordInput([
                            'placeholder' => Yii::t('app', 'Confirm Password'),
                            'class' => 'form-control'
                        ]); ?>

                    </div>

                    <div class="row">

                        <?= $form->field($model, 'birthday', [
                        ])->textInput([
                            'placeholder' => Yii::t('app', 'Birthday'),
                            'class' => 'form-control',
                            'id' => 'datePickerBirthday'
                        ]); ?>

                        <?= $form->field($model, 'gender')->dropDownList($model->getGender(), [
                            'prompt' => Yii::t('app', 'Gender'),
                            'class' => 'form-control'
                        ]); ?>

                    </div>

                    <div class="row">

                        <?php echo $form->field($model, 'referralCode')->textInput([
                            'placeholder' => Yii::t('app', 'Referral Code'),
                        ]); ?>

                    </div>

                    <div class="row">

                        <div class="form-group">
                            <?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className()) ?>
                        </div>

                    </div>

                    <div class="text-left">
                        <?php echo Html::submitButton(Yii::t('app', 'sign up and get 100 free points'), ['class' => 'btn btn-primary btn-sm btn-block']) ?>
                    </div>

                    <div class="text-left">
                        <?php echo Html::a('Already have an account?', ['user/account/login']); ?>
                    </div>

                    <?php $form->end(); ?>
                </div>
            </div>
        <?php else: ?>

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
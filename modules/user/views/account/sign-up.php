<?php

use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
use app\assets\DatePickerAsset;
use yii\bootstrap\Html;

DatePickerAsset::register($this);

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\user\forms\RegistrationForm */

?>

    <!-- PAGE TITLE -->
    <section id="page-title" class="page-title-parallax page-title-center text-dark" style="background-image:url(/images/page-title-parallax.jpg);">
        <div class="container">
            <div class="page-title col-md-8">
                <h1>User Register</h1>
                <span>User register page</span>
            </div>
        </div>
    </section>
    <!-- END: PAGE TITLE -->
    <!-- SECTION -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 center no-padding">
                    <div class="col-md-12">
                        <h3>Register New Account</h3>
                        <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group btn-group btn-group-justified" role="group" aria-label="...">
                            <div class="btn-group" role="group">
                                <?php echo Html::a('<i class="fa fa-facebook"></i> facebook',
                                    ['/user/account/auth', 'authclient'=> Yii::$app->authClientCollection->getClient('facebook')->name],
                                    ['class' => 'social-facebook btn-sm btn']
                                ) ?>
                            </div>
                            <div class="btn-group" role="group">
                                <?php echo Html::a('<i class="fa fa-twitter"></i> twitter',
                                    ['/user/account/auth', 'authclient'=> Yii::$app->authClientCollection->getClient('twitter')->name],
                                    ['class' => 'social-twitter btn-sm btn']
                                ) ?>
                            </div>
                            <div class="btn-group" role="group">
                                <?php echo Html::a('<i class="fa fa-google-plus"></i> google',
                                    ['/user/account/auth', 'authclient'=> Yii::$app->authClientCollection->getClient('google')->name],
                                    ['class' => 'social-google btn-sm btn']
                                ) ?>
                            </div>
                        </div>

                        <div class="form-group-or text-center">
                            <p>or</p>
                        </div>
                    </div>
                    

                    <?php yii\widgets\Pjax::begin(['id' => 'register', 'enablePushState' => false]) ?>
                    <?php $form = ActiveForm::begin([
                        'options' => [
                            'id' => 'sign-form',
                            'enctype' => 'multipart/form-data'
                        ],
                        'fieldConfig' => [
                            'template' => '<div class="col-md-12"><label class="sr-only">{label}</label>{input}{error}</div>',
                            'options' => ['class' => 'col-md-6']
                        ],
                    ]); ?>
                    <div class="row">

                        <?= $form->field($model, 'username')->textInput([
                            'placeholder' => Yii::t('app', 'Username'),
                            'class' => 'form-control input-lg'
                        ]); ?>
                        <?= $form->field($model, 'email')->textInput([
                            'placeholder' => Yii::t('app', 'E-mail'),
                            'type' => 'email',
                            'class' => 'form-control input-lg'
                        ]); ?>

                    </div>
                    <div class="row">

                        <?php echo $form->field($model, 'password')->passwordInput([
                            'placeholder' => Yii::t('app', 'Password'),
                            'type' => 'password',
                            'class' => 'form-control input-lg'
                        ]); ?>

                        <?php echo $form->field($model, 'confirmPassword')->passwordInput([
                            'placeholder' => Yii::t('app', 'Confirm Password'),
                            'class' => 'form-control input-lg'
                        ]); ?>

                    </div>
                    <div class="row">

                        <?= $form->field($model, 'first_name')->textInput([
                            'placeholder' => Yii::t('app', 'First Name'),
                            'class' => ' form-control input-lg'
                        ]); ?>

                        <?= $form->field($model, 'last_name')->textInput([
                            'placeholder' => Yii::t('app', 'Last Name'),
                            'class' => 'form-control input-lg'
                        ]); ?>

                    </div>
                    <div class="row">

                        <?= $form->field($model, 'birthday')->textInput([
                            'placeholder' => Yii::t('app', 'Birthday'),
                            'class' => 'form-control',
                            'id' => 'datePickerBirthday'
                        ]); ?>

                        <?= $form->field($model, 'gender')->dropDownList($model->getGender(), [
                            'prompt' => Yii::t('app', 'Gender'),
                            'class' => 'form-control input-lg'
                        ]); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->field($model, 'referralCode')->textInput([
                            'placeholder' => Yii::t('app', 'Referral Code'),
                        ]); ?>

                        <?php if ($inviteSignup): ?>
                            <?= $form->field($model, 'invitationCode')->textInput([
                                'placeholder' => Yii::t('app', 'Invite Code'),
                                'readonly' => true
                            ]);
                            ?>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className()) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="" id="register-terms">
                            <div class="form-group">
                                <?php echo $form->field($model, 'terms')->checkbox([
                                    'placeholder' => Yii::t('app', 'Referral Code'),
                                    'template' => "<div class='checkbox'>\n<div>You must agree and have read our <a onclick='window.open(\"/terms#terms\")' href='javascript:void(0)'>Terms of Service</a> and <a onclick='window.open(\"/terms#Privacy_policy\")'>Privacy Policy</a>.</div>{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{error}\n{hint}\n</div>"
                                ])->label('I Agree') ?>
                            </div>
                        </div>


                    </div>

                    <div class="col-md-12 form-group">
                        <?php echo Html::submitButton(Yii::$app->globalTexts->getFreePoints(), ['class' => 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                    <?php yii\widgets\Pjax::end() ?>

                </div>

            </div>
        </div>
    </section>
    <!-- SECTION -->
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

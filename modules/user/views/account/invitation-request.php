<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\modules\user\forms\RegistrationForm */

$this->title = Yii::t('app', 'Sign Up');
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageTitle'] = Yii::t('app', 'Sign Up');
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
            <div class="col-sm-6 col-sm-offset-3">
                <div class="col-md-12">
                    <h3>Register New Account</h3>
                    <p>Leave Your email</p>
                </div>
                <?php yii\widgets\Pjax::begin(['id' => 'register', 'enablePushState' => false]) ?>

                <?php
                $form = ActiveForm::begin([
                    'options' => [
//                        'data-pjax' => 1,
                        'id' => 'sign-form',
                    ],
                    'fieldConfig' => [
                        'template' => '<div class="col-md-12"><label class="sr-only">{label}</label>{input}{error}</div>',
                        'options' => ['class' => 'col-md-12']
                    ],
                ]);
                ?>
                <div class="row">
                    <?=
                    $form->field($model, 'email')->textInput([
                        'placeholder' => Yii::t('app', 'Email')
                    ]);
                    ?>
                </div>

                <div class="row">
                    <div class="form-group">
                        <?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className()) ?>
                    </div>
                </div>

                <div class="col-md-12 form-group">
                    <?php echo Html::submitButton(Yii::t('app', 'Request Invite'), ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
                <?php yii\widgets\Pjax::end() ?>

            </div>
        </div>
    </div>
</section>
<!-- SECTION -->

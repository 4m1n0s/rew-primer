<?php

use yii\bootstrap\ActiveForm;
use app\assets\DatePickerAsset;
use yii\helpers\Html;

DatePickerAsset::register($this);

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\user\forms\RegistrationForm */

?>

<div class="form-group form-group-sm">
    <?php $form = ActiveForm::begin([
        'action' => ['/user/account/sign-up'],
        'enableClientScript' => false,
        'options' => [
            'id' => 'front-sign-form',
        ],
        'fieldConfig' => [
            'template' => '{input}<p class="m-t-5"></p>',
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

    <?= $form->field($model, 'isWidget')->hiddenInput(['value' => 1]) ?>

    <div class="row">

        <?= $form->field($model, 'username')->textInput([
            'placeholder' => Yii::t('app', 'Username'),
            'class' => 'form-control'
        ]); ?>

    </div>

    <div class="row">
        <?= $form->field($model, 'email')->textInput([
            'placeholder' => Yii::t('app', 'E-mail'),
            'type' => 'email',
            'class' => 'form-control'
        ]); ?>
    </div>

    <div class="row">

        <div class="col-md-6">
            <?php echo $form->field($model, 'password')->passwordInput([
                'placeholder' => Yii::t('app', 'Password'),
                'type' => 'password',
                'class' => 'form-control'
            ]); ?>
        </div>

        <div class="col-md-6">

            <?php echo $form->field($model, 'confirmPassword')->passwordInput([
                'placeholder' => Yii::t('app', 'Confirm Password'),
                'class' => 'form-control'
            ]); ?>
        </div>
        
    </div>

    <div class="text-left">
        <?php echo Html::submitButton(Yii::$app->globalTexts->getFreePoints(), ['class' => 'btn btn-primary btn-sm btn-block']) ?>
    </div>

    <div class="text-left">
        <?php echo Html::a('Already have an account?', ['user/account/login']); ?>
    </div>

    <?php $form->end(); ?>
</div>
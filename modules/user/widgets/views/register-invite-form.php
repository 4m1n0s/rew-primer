<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\user\forms\RegistrationForm */
?>

<div class="form-group-sm">
    <p class="title-txt-bold">Join Now to Start Earning Extra Bucks!</p>
    <p class="txt-sm margin-bottom-5">Leave your email below and we will invite you as soon as we can!</p>

    <?php $form = ActiveForm::begin([
        'action' => ['/user/account/invitation-request'],
        'enableClientScript' => false,
        'options' => [
            'id' => 'front-invite-form',
        ],
        'fieldConfig' => [
            'template' => '{input}<p class="m-t-5"></p>',
        ],
    ]); ?>
    <?= $form->field($model, 'isWidget')->hiddenInput(['value' => 1]) ?>
    <div class="row">
        <?= $form->field($model, 'email')->textInput([
            'placeholder' => Yii::t('app', 'E-mail'),
            'type' => 'email',
            'class' => 'form-control'
        ]); ?>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm btn-block">Request an Invite</button>
        </div>
    </div>
    <?php $form->end() ?>
</div>

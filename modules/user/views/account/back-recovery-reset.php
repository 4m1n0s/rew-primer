<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Forgot Password';

$this->registerJsFile('/back/assets/scripts/custom/login.js', ['depends' => [app\assets\BackAsset::className()]]);
$this->registerCssFile("/back/assets/css/pages/login.css", [
    'depends' => [app\assets\BackAsset::className()],
    ], 'login-page-css');

$this->registerJs("
            jQuery(document).ready(function() {
                Login.init();
            });", yii\web\View::POS_END, 'login-page-scripts');
?>
<?php
$form = ActiveForm::begin([
        'id' => 'forgot-password-form',
        'options' => ['class' => 'forget-form', 'style' => 'display: block'],
        'fieldConfig' => [
            'template' => "<div class=\"form-group\">{label}\n<div class=\"input-icon\">{input}</div>\n<div class=\"col-lg-8\">{error}</div></div>",
            'labelOptions' => ['class' => 'control-label visible-ie8 visible-ie9'],
            'inputOptions' => [
                'class' => 'form-control placeholder-no-fix',
            ]
        ],
    ]);
?>
<h3><?= Yii::t('user', 'Reset your password') ?></h3>
<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger">
        <button class="close" data-close="alert"></button>
        <span>
            <?= Yii::$app->session->getFlash('error'); ?>
        </span>
    </div>
<?php endif; ?>
<?=
$form->field($model, 'password', [
    'template' => "<div class=\"form-group\">{label}\n<div class=\"input-icon\"><i class=\"fa fa-lock\"></i>{input}</div>{error}</div>",
    'inputOptions' => [
        'class' => 'form-control placeholder-no-fix',
        'placeholder' => $model->getAttributeLabel('password'),
        'autocomplete' => 'off',
    ],
    'errorOptions' => [
        'tag' => 'span'
    ],
])->passwordInput();
?>
<?=
$form->field($model, 'confirmPassword', [
    'template' => "<div class=\"form-group\">{label}\n<div class=\"input-icon\"><i class=\"fa fa-lock\"></i>{input}</div>{error}</div>",
    'inputOptions' => [
        'class' => 'form-control placeholder-no-fix',
        'placeholder' => $model->getAttributeLabel('confirmPassword'),
        'autocomplete' => 'off',
    ],
    'errorOptions' => [
        'tag' => 'span'
    ],
])->passwordInput();
?>
<div class="form-actions">
    <?= Html::submitButton(Yii::t('user', 'Submit') . ' <i class="m-icon-swapright m-icon-white"></i>', ['class' => 'btn green pull-right']); ?>
</div>
<?php ActiveForm::end(); ?>

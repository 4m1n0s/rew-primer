<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Admin Log In';

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
        'id' => 'login-form',
        'options' => ['class' => 'login-form'],
        'fieldConfig' => [
            'template' => "<div class=\"form-group\">{label}\n<div class=\"input-icon\">{input}</div>\n<div class=\"col-lg-8\">{error}</div></div>",
            'labelOptions' => ['class' => 'control-label visible-ie8 visible-ie9'],
            'inputOptions' => [
                'class' => 'form-control placeholder-no-fix',
            ]
        ],
    ]);
?>
<h3 class="form-title"><?= Yii::t('user', 'Login to your account'); ?></h3>
<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger">
        <button class="close" data-close="alert"></button>
        <span>
            <?= Yii::$app->session->getFlash('error'); ?>
        </span>
    </div>
<?php endif; ?>
<?=
$form->field($model, 'username', [
    'template' => "<div class=\"form-group\">{label}\n<div class=\"input-icon\"><i class=\"fa fa-user\"></i>{input}</div></div>",
    'inputOptions' => [
        'class' => 'form-control placeholder-no-fix',
        'placeholder' => $model->getAttributeLabel('username'),
        'autocomplete' => 'off',
    ]
])
?>
<?=
$form->field($model, 'password', [
    'template' => "<div class=\"form-group\">{label}\n<div class=\"input-icon\"><i class=\"fa fa-lock\"></i>{input}</div></div>",
    'inputOptions' => [
        'class' => 'form-control placeholder-no-fix',
        'placeholder' => $model->getAttributeLabel('password'),
        'autocomplete' => 'off',
    ]
])->passwordInput()
?>
<div class="form-actions">
    <?=
    $form->field($model, 'rememberMe', [
        'checkboxTemplate' => "{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{hint}",
        'options' => [
            'class' => 'checkbox'
        ]
    ])->checkbox([
        'tag' => false
    ]);
    ?> 
    <?= Html::submitButton(Yii::t('user', 'Login') . ' <i class="m-icon-swapright m-icon-white"></i>', ['class' => 'btn green pull-right']); ?>
</div>
<div class="forget-password">
    <h4><?= Yii::t('user', 'Forgot your password ?'); ?></h4>
    <p>
        <?= Yii::t('user', 'no worries, click'); ?>
        <?= Html::a(Yii::t('user', 'here'), ['/user/account/back-recovery-request']); ?>
        <?= Yii::t('user', 'to reset your password.'); ?>
    </p>
</div>
<?php ActiveForm::end(); ?>

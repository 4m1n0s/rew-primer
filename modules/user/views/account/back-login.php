<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Admin Log In';

$this->registerJsFile('/backend/global/plugins/jquery-validation/js/jquery.validate.min.js', ['depends' => [app\assets\BackendAsset::className()]]);
$this->registerJsFile('/backend/global/plugins/jquery-validation/js/additional-methods.min.js', ['depends' => [app\assets\BackendAsset::className()]]);
$this->registerJsFile('/backend/global/plugins/select2/js/select2.full.min.js', ['depends' => [app\assets\BackendAsset::className()]]);

$this->registerJsFile('/backend/pages/scripts/login.min.js', ['depends' => [app\assets\BackendAsset::className()]]);
$this->registerCssFile("/backend/pages/css/login.min.css", ['depends' => [app\assets\BackendAsset::className()]]);

?>

<?php
$form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'login-form'],
        'fieldConfig' => [
            'template' => "{label}\n{input}",
            'labelOptions' => ['class' => 'control-label visible-ie8 visible-ie9'],
            'inputOptions' => [
                'class' => 'form-control form-control-solid placeholder-no-fix',
            ]
        ],
    ]);
?>
<h3 class="form-title"><?= Yii::t('admin', 'Sign In'); ?></h3>
<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger">
        <button class="close" data-close="alert"></button>
        <span>
            <?= Yii::$app->session->getFlash('error'); ?>
        </span>
    </div>
<?php endif; ?>

<?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
<?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>


<div class="form-actions">
    <?= Html::submitButton(Yii::t('admin', 'Login'), ['class' => 'btn green uppercase']); ?>
    <?= Html::activeCheckbox($model, 'rememberMe') ?>
</div>
<?php ActiveForm::end(); ?>

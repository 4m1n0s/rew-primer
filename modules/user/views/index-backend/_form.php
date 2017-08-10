<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\user\models\User;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="users-form">
    <?php
    $form = ActiveForm::begin([
            'options' => [
                'class' => 'form-horizontal',
            ],
            'fieldConfig' => [
                'template' => "<div class=\"form-group\">{label}<div class=\"col-md-4\">{input}{error}</div></div>",
                'labelOptions' => ['class' => 'col-md-3 control-label'],
                'inputOptions' => [
                    'class' => 'form-control',
                ]
            ],
    ]);
    ?>
    <div class="form-body">
        <h3 class="form-section"><?= Yii::t('user', 'General details'); ?></h3>
        <?= $form->field($model, 'username')->textInput(['maxlength' => 60, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('username')]) ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => 100, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('email')]) ?>
        <?= $form->field($model, 'status')->dropDownList($statusList); ?>

        <? if ($model->role != User::ROLE_PARTNER): ?>
        <?= $form->field($model, 'role')->dropDownList($roleList); ?>

        <h3 class="form-section"><?= Yii::t('user', 'Personal details'); ?></h3>
        <?= $form->field($model, 'last_name')->textInput(['maxlength' => 255, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('last_name')]) ?>
        <?= $form->field($model, 'first_name')->textInput(['maxlength' => 255, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('first_name')]) ?>
        <?php endif; ?>

        <? if ($model->role == User::ROLE_PARTNER): ?>
            <h3 class="form-section"><?= Yii::t('user', 'Affiliate specific'); ?></h3>
            <?= $form->field($model, 'referral_code')->textInput(['maxlength' => 255, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('referral_code')]) ?>
            <?= $form->field($model, 'referral_percents')->textInput(['maxlength' => 255, 'autocomplete' => 'off', 'placeholder' => 'Referral Percents']) ?>
            <?= $form->field($model, 'referral_register_value')->textInput(['maxlength' => 255, 'autocomplete' => 'off', 'placeholder' => 'Referral Sign up Payout']) ?>
        <?php endif; ?>

        <?php
        if ($model->isNewRecord) {
            echo '<h3 class="form-section">' . Yii::t('user', 'Password') . '</h3>';
            echo $form->field($model, 'password')->passwordInput(['maxlength' => 64, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('password')]);
            echo $form->field($model, 'confirmPassword')->passwordInput(['maxlength' => 64, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('confirmPassword')]);
        }
        ?>
    </div>
    <div class="form-actions fluid">
        <div class="col-md-offset-3 col-md-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('user', 'Cancel'), ['index'], ['class' => 'btn default']); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

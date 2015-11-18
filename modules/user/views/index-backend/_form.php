<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
        <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => 64, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('newPassword')]) ?>
        <?= $form->field($model, 'confirmPassword')->passwordInput(['maxlength' => 64, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('confirmPassword')]) ?>
        <?= $form->field($model, 'status')->dropDownList($statusList); ?>
        <?= $form->field($model, 'role')->dropDownList($roleList); ?>
        <?= $form->field($model, 'note')->textarea(['autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('note')]) ?>

        <h3 class="form-section"><?= Yii::t('user', 'Billing details'); ?></h3>
        <?= $form->field($model, 'last_name')->textInput(['maxlength' => 255, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('last_name')]) ?>
        <?= $form->field($model, 'first_name')->textInput(['maxlength' => 255, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('first_name')]) ?>
        <?= $form->field($model, 'companyName')->textInput(['maxlength' => 255, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('companyName')]) ?>
        <?= $form->field($model, 'address')->textInput(['maxlength' => 255, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('address')]) ?>
        <?= $form->field($model, 'city')->textInput(['maxlength' => 255, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('city')]) ?>
        <?=
        $form->field($model, 'state')->dropDownList($stateList, [
            'id' => 'jsf_select_state',
        ])->label($model->getAttributeLabel('state'));
        ;
        ?>
        <?= $form->field($model, 'zip')->textInput(['maxlength' => 255, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('zip')]) ?>
        <?= $form->field($model, 'phone')->textInput(['maxlength' => 255, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('phone')]) ?>

    </div>
    <div class="form-actions fluid">
        <div class="col-md-offset-3 col-md-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('user', 'Cancel'), ['index'], ['class' => 'btn default']); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

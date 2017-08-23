<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\dashboard\helpers\FormTemplateHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\offer\models\LogPostback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-postback-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'form-horizontal',
        ],
        'fieldConfig' => FormTemplateHelper::baseFieldConfig()
    ]); ?>

    <div class="form-body">

        <h3 class="form-section">General details</h3>

              <?= $form->field($model, 'id')->textInput() ?>

      <?= $form->field($model, 'level')->textInput() ?>

      <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'offer_id')->textInput() ?>

      <?= $form->field($model, 'prefix')->textarea(['rows' => 6]) ?>

      <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

      <?= $form->field($model, 'log_vars')->textarea(['rows' => 6]) ?>

      <?= $form->field($model, 'log_time')->textInput() ?>


    </div>

    <div class="form-actions fluid">
        <div class="col-md-offset-3 col-md-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('user', 'Cancel'), ['index'], ['class' => 'btn default']); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\dashboard\helpers\FormTemplateHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\CategoryProductGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-product-group-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'form-horizontal',
        ],
        'fieldConfig' => FormTemplateHelper::baseFieldConfig()
    ]); ?>

    <div class="form-body">

        <h3 class="form-section">General details</h3>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'active')->dropDownList([1 => 'Yes', 0 => 'No']) ?>

    </div>

    <div class="form-actions fluid">
        <div class="col-md-offset-3 col-md-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('user', 'Cancel'), ['index'], ['class' => 'btn default']); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

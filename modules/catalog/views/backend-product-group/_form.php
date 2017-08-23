<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\dashboard\helpers\FormTemplateHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\ProductGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-group-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'form-horizontal',
        ],
        'fieldConfig' => FormTemplateHelper::baseFieldConfig()
    ]); ?>

    <div class="form-body">

        <h3 class="form-section">General details</h3>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->dropDownList([1 => 'Yes', 0 => 'No']) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 12]) ?>

        <h3 class="form-section"><?= Yii::t('user', 'Additionally'); ?></h3>
        <?= $form->field($model, 'categoriesBuff')->dropDownList(\app\modules\catalog\models\CategoryProductGroup::getList(), ['id' => 'category-product-group-select', 'multiple' => 'multiple'])->label('Categories') ?>

    </div>

    <div class="form-actions fluid">
        <div class="col-md-offset-3 col-md-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('user', 'Cancel'), ['index'], ['class' => 'btn default']); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerAssetBundle(\app\assets\SelectAsset::class);
$js = <<< JS
$('#category-product-group-select').select2({
    width: '100%',
    theme: 'classic',
    allowClear: true
});
JS;

$this->registerJs($js);
?>
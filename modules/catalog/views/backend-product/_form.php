<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\catalog\models\Product;

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'form-horizontal',
        ],
        'fieldConfig' => \app\modules\dashboard\helpers\FormTemplateHelper::baseFieldConfig()
    ]); ?>

    <div class="form-body">
        <h3 class="form-section"><?= Yii::t('user', 'General details'); ?></h3>

        <?= $form->field($model, 'type')->dropDownList(Product::getTypeList()) ?>

        <?= $form->field($model, 'vendor')->dropDownList(Product::getVendorList()) ?>

        <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->dropDownList(Product::getStatusList()) ?>

        <h3 class="form-section"><?= Yii::t('user', 'Additionally'); ?></h3>
        <?= $form->field($model, 'groupsBuff')->dropDownList(\app\modules\catalog\models\ProductGroup::getList(), ['id' => 'product-group-select', 'multiple' => 'multiple'])->label('Belongs to Groups') ?>

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
$('#product-group-select').select2({
    width: '100%',
    theme: 'classic',
    allowClear: true
});
JS;

$this->registerJs($js);
?>
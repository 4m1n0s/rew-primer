<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\offer\models\Offer */
/* @var $form yii\widgets\ActiveForm */
/* @var $categoryList array */
?>

<?php
$form = ActiveForm::begin([
    'options' => [
        'class' => 'form-horizontal',
        'enctype' => 'multipart/form-data'
    ],
    'fieldConfig' => [
        'template' => "<div class='col-xs-12'><div class=\"form-group\">{label}<div class=\"col-md-4\">{input}{error}</div></div></div>",
        'labelOptions' => ['class' => 'col-md-3 control-label'],
        'inputOptions' => [
            'class' => 'form-control',
        ]
    ],
]);
?>
    <div class="form-body">
        <h3 class="form-section"><?= Yii::t('user', 'General details'); ?></h3>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'readonly' => true])
            ->label($model->getAttributeLabel('name') . ' <i class="fa fa-question-circle" title="Unique identifier in the application" aria-hidden="true"></i>') ?>
        <?= $form->field($model, 'label')->textInput(['maxlength' => true])
            ->label($model->getAttributeLabel('label') . ' <i class="fa fa-question-circle" title="Will be shown for end Users" aria-hidden="true"></i>') ?>
        <?= $form->field($model, 'imageFile')->fileInput() ?>
        <?= $form->field($model, 'active')->dropDownList([1 => 'Yes', 0 => 'No']) ?>
        <h3 class="form-section"><?= Yii::t('user', 'Additionally'); ?></h3>
        <?= $form->field($model, 'categoriesBuff')->dropDownList($categoryList, ['id' => 'offer-category-select', 'multiple' => 'multiple'])->label('Categories') ?>
    </div>
    <div class="form-actions fluid">
        <div class="col-md-offset-3 col-md-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('user', 'Cancel'), ['index'], ['class' => 'btn default']); ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>

<?php
$this->registerAssetBundle(\app\assets\SelectAsset::class);
$js = <<< JS
$('#offer-category-select').select2({
    width: '100%',
    theme: 'classic',
    allowClear: true
});
JS;

$this->registerJs($js);
?>
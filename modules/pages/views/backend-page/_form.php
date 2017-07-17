<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pages\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'form-horizontal',
        ],
        'fieldConfig' => \app\modules\dashboard\helpers\FormTemplateHelper::baseFieldConfig()
    ]); ?>

    <div class="form-body">
        <h3 class="form-section"><?= Yii::t('user', 'General details'); ?></h3>

        <?= $form->field($model, 'template')->dropDownList(\app\modules\pages\models\Page::getTemplateList(), ['prompt' => '-- Select Page Template --']) ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'content', [
            'template' => "<div class='col-xs-12'><div class=\"form-group\">{label}<div>{input}{error}</div></div></div>",
            'labelOptions' => ['class' => 'control-label'],
        ])->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => [
                'language' => 'en',
                'height' => '500',
                'allowedContent' => true,
                'fullPage' => false,
                'qtBorder' => '0',
                'startupShowBorders' => false,
                'extraPlugins' => 'justify',
                'disableNativeSpellChecker' => true,
                'removePlugins' => 'scayt',
            ],
        ]) ?>

        <h3 class="form-section"><?= Yii::t('user', 'SEO'); ?></h3>
        <?= $form->field($model, 'seoTitle')->textInput(); ?>
        <?= $form->field($model, 'seoKeywords')->textInput(); ?>
        <?= $form->field($model, 'seoDescription')->textarea(); ?>
    </div>

    <div class="form-actions fluid">
        <div class="col-md-offset-3 col-md-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('user', 'Cancel'), ['index'], ['class' => 'btn default']); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

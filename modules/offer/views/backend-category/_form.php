<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\offer\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin([
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
]); ?>

<div class="form-body">
    <h3 class="form-section"><?= Yii::t('user', 'General details'); ?></h3>
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
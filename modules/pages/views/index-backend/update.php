<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\redactor\widgets\Redactor;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $pagesMetaForm app\modules\pages\forms\PagesMetaForm */
/* @var $scenario */

?>
<?php
$form = ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data'
    ],
//    'enableAjaxValidation' => true,
]);
?>

<div class="portlet light portlet-fit bordered">
    <?php if(in_array('headerImage', $scenario)) :?>
    <div class="portlet-title">
        <div class="caption">
            <?php
            echo $form->field($pagesMetaForm, 'imageHeaderFile')->widget(FileInput::className(), [
                'options' => [
                    'accept' => 'image/*',
                ],
                'pluginOptions' => [
                    'initialPreview' => [
                        $pagesMetaForm->headerImage
                    ],
                    'initialPreviewAsData' => true,
                    'showPreview' => true,
                    'showUpload' => false,
                    'maxFileCount' => 1,
                    'allowedFileExtensions'=>['jpg', 'png'],
                    'showRemove' => false,
                    'showCancel' => false,
                    'showClose' => false
                ],
            ]);
            ?>
        </div>
    </div>
    <?php endif; ?>
    <?php if(in_array('text', $scenario)) : ?>
    <div class="portlet-title">
        <div class="caption">
            <?=
            $form->field($pagesMetaForm, 'text')->textarea([
                    'width' => '100%',
                    'autocomplete' => 'off',
                    'placeholder' => $pagesMetaForm->getAttributeLabel('text')
                ])->widget(Redactor::className(), [
                    'clientOptions' => [
                        'buttonsHide' => ['image', 'file']
                    ]
                ])
            ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<!--<div class="form-actions fluid">-->
<!--    <div class="col-md-offset-3 col-md-9">-->
        <?php echo Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'btn default']); ?>
<!--    </div>-->
<!--</div>-->
<?php ActiveForm::end(); ?>


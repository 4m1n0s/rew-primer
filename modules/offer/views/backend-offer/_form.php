<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\offer\models\OfferDeviceType;

/* @var $this yii\web\View */
/* @var $model app\modules\offer\models\Offer */
/* @var $form yii\widgets\ActiveForm */
/* @var $categoryList array */
/* @var $deviceTypes array */
/* @var $countriesList array */
/* @var $deviceTypeList array */
/* @var $deviceOsList array */
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

        <div class="form-group last">
            <label class="control-label col-md-3">Image</label>
            <div class="col-md-9">
                <div class="fileinput fileinput-<?php echo empty($model->img) ? 'new' : 'exists' ?>" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;">
                        <img src="<?= $model->img ?>" alt="<?= Yii::t('admin', 'offer') ?>">
                    </div>
                    <div>
                        <span class="btn default btn-file">
                            <span class="fileinput-new"> Select image </span>
                            <span class="fileinput-exists"> Change </span>
                            <?= Html::activeFileInput($model, 'imageFile') ?>
                            <?= Html::activeHiddenInput($model, 'imageFile') ?>
                        </span>
                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                    </div>
                </div>
            </div>
        </div>

        <?= $form->field($model, 'active')->dropDownList([1 => 'Yes', 0 => 'No']) ?>
        <h3 class="form-section"><?= Yii::t('user', 'Additionally'); ?></h3>
        <?= $form->field($model, 'categoriesBuff')->dropDownList($categoryList, ['id' => 'offer-category-select', 'multiple' => 'multiple'])->label('Categories') ?>

        <h3 class="form-section"><?= Yii::t('user', 'Targeting'); ?></h3>
        <?= $form->field($model, 'newCountries')->dropDownList($countriesList, ['id' => 'offer-country-select', 'multiple' => 'multiple'])->label('Location');?>
        <?= $form->field($model, 'newDeviceTypes')->dropDownList($deviceTypeList, ['id' => 'offer-device-type-select', 'multiple' => 'multiple', 'data-type-mobile' => OfferDeviceType::DEVICE_TYPE_MOBILE/*, 'onchange' => 'displaing(this)'*/])->label('Device type');?>
        <div class="device-os">
            <?= $form->field($model, 'newDeviceOs')->dropDownList($deviceOsList, ['id' => 'offer-device-os-select', 'multiple' => 'multiple'])->label('Device OS');?>
        </div>
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
$this->registerAssetBundle(\app\assets\FileInputAsset::class);
$this->registerAssetBundle(\app\modules\offer\assets\BackendOfferAsset::class);
$this->registerJs('offer_display_device_os_module.init({select2:{width: "100%", theme: "classic", allowClear: true}})');
?>
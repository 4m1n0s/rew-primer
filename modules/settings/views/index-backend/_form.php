<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\modules\settings\models\Settings */

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
        <?= $form->field($model, 'email')->textInput(['maxlength' => 100, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('email')]) ?>
        <?= $form->field($model, 'site_key')->textInput(['maxlength' => 100, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('site_key')]) ?>
        <?= $form->field($model, 'secret_key')->textInput(['maxlength' => 100, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('secret_key')]) ?>
        <?= $form->field($model, 'header_scripts')->textarea(['autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('header_scripts')]) ?>
        <?= $form->field($model, 'footer_scripts')->textarea(['autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('footer_scripts')]) ?>
        <?= $form->field($model, 'mandrill_api_key')->textInput(['maxlength' => 100, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('mandrill_api_key')]) ?>
        <?= $form->field($model, 'invite_only_signup', [
            'template' => "<div class=\"form-group\">{label}<div class=\"col-md-4\">{input}<span>{hint}<span></div></div>",

        ])->checkbox([
            'id' => 'checkbox_invite',
            'label' => ($model->invite_only_signup == 1) ? '<span id="label_checkbox">On</span>' : '<span id="label_checkbox">Off</span>',
            'labelOptions' => [
                'id' => '_label_checkbox_invite',
                'style' => 'margin-top:8px;',
            ],
        ])->label($model->getAttributeLabel('invite_only_signup')); ?>


    </div>
    <div class="form-actions fluid">
        <div class="col-md-offset-3 col-md-9">
            <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php

$script = <<<JS
    // $('#_label_checkbox_invite').on('click', function() {
    //     console.log($(this));
       
        // var ccexists = false;
        // $('#member-options input:checked').each(function() {
        //     if ($(this).attr('value') == 'CC') {
        //         ccexists = true;
        //     }
        // });
        // if (ccexists == true) {
        //     $('#otherfieldlbl').show();
        //     $('#otherfield').show();
        // } else {
        //     $('#otherfieldlbl').hide();
        //     $('#otherfield').hide();
        // };
    // });
    $("#uniform-checkbox_invite>span").bind('cssClassChanged', function(){ 
        console.log($(this));
    });
    $('#checkbox_invite').on('change', function() {
        if($(this).is(':checked')){
            $('#label_checkbox').text('On');
        } else {
            $('#label_checkbox').text('Off');
        }
    })
JS;
$this->registerJs($script, \yii\web\View::POS_END);
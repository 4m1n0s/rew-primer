<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\modules\settings\models\Settings */

?>
<div class="users-form">
    <?php echo \app\modules\settings\widgets\FormRender::widget([
        'model' => $model,
        'formClass' => '\yii\bootstrap\ActiveForm',
        'formOptions' => [
            'id' => 'default-settings-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "<div class=\"form-group\">{label}<div class=\"col-md-4\">{input}{error}</div></div>",
                'labelOptions' => ['class' => 'col-md-3 control-label'],
                'inputOptions' => [
                    'class' => 'form-control',
                ]
            ],
        ],
        'formBodyWrapOptions' => ['class' => 'form-body'],
        'formControls' => Html::tag('div', "<div class=\"col-md-offset-3 col-md-9\">" .
            Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) . "</div>",
            ['class' => 'form-actions fluid']
        )
    ]);
    ?>
</div>
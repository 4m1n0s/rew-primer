<?php

use yii\helpers\Html;
use app\modules\settings\widgets\FormRender;

/* @var $this yii\web\View */
/* @var $model app\modules\settings\models\Settings */
/* @var $pageTitle string */

$this->title = Yii::t('app', 'Edit {modelClass}', [
    'modelClass' => $pageTitle,
]);

$this->params['pageTitle'] = $pageTitle;
$this->params['pageSmallTitle'] = Yii::t('app', 'edit');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php echo FormRender::widget([
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
]); ?>

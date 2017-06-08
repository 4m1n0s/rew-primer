<?php

use yii\helpers\Html;
use app\modules\settings\widgets\FormRender;

/* @var $this yii\web\View */
/* @var $model app\modules\settings\models\Settings */

$this->title = Yii::t('app', 'Edit {modelClass}', [
    'modelClass' => 'Settings',
]);

$this->title = Yii::t('app', 'Offer Targeting');
$this->params['pageTitle'] = Yii::t('app', 'Offer Targeting');
$this->params['pageSmallTitle'] = Yii::t('app', 'edit');
$this->params['breadcrumbs'][] = $this->title;
?>

<span id="country-link" data-link="<?php echo \yii\helpers\Url::toRoute(['/settings/index-backend/get-country']) ?>"></span>

<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-reorder"></i>Targeting
        </div>
    </div>
    <div class="portlet-body" style="display: block;">
        <div class="tabbable-custom ">
            <ul class="nav nav-tabs ">
                <li class="active">
                    <a href="#tab_5_1" data-toggle="tab" aria-expanded="false"> Countries </a>
                </li>
                <li class="">
                    <a href="#tab_5_2" data-toggle="tab" aria-expanded="true"> Devices </a>
                </li>
                <li class="">
                    <a href="#tab_5_3" data-toggle="tab" aria-expanded="false"> User Groups </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_5_1">

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

                </div>
                <div class="tab-pane" id="tab_5_2">
                    <p> Howdy, I'm in Devices Section. </p>
                </div>
                <div class="tab-pane" id="tab_5_3">
                    <p> Howdy, I'm in User Groups Section. </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->registerJsFile('/backend/js/offer_targeting_module.js', ['depends' => \app\assets\SelectAsset::class]);
$this->registerJs('offer_targeting_module.init()');
?>

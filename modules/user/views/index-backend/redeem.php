<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\modules\user\forms\RedeemForm */

$this->title = 'Redeem';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginBlock('title') ?>
<h3><?php echo Html::a($user->username  . ' (#' . $user->id . ')',
        ['/user/index-backend/view', 'id' => $user->id],
        ['class' => 'view-modal-btn'])
    ?>
</h3>
<?php $this->endBlock() ?>
<div id="users-form">
    <?php
    $form = ActiveForm::begin([
        'id' => 'redeem-form',
        'options' => [
            'class' => 'form-horizontal',
            'data-pjax' => ''
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
        <?= $form->field($model, 'amount') ?>
    </div>

    <div class="form-actions fluid">
        <div class="col-md-offset-3 col-md-9">
            <?= Html::submitButton(Yii::t('app', 'Redeem'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

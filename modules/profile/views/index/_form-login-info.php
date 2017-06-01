<?php
/* @var \yii\web\View $this */
/* @var \app\modules\user\models\User $currentUser */
/* @var \app\modules\user\forms\RegistrationForm $model  */

use yii\helpers\Html;
?>
<div class="col-md-9 center no-padding">

    <?php $form = \yii\widgets\ActiveForm::begin([
        'options' => ['data-pjax' => true],
        'fieldConfig' => [
            'template' => '<label class="col-md-2">{label}</label><div class="col-md-10">{input}{error}</div>',
        ]

    ]) ?>
    <div class="row">
        <?php echo $form->field($model, 'username'); ?>
    </div>
    <div class="row">
        <?php echo $form->field($model, 'email'); ?>
    </div>
    <div class="col-md-offset-2">
        <div class="col-md-10">
            <?php echo Html::a('Back', ['/profile/index/account'], ['class' => 'btn btn-primary']); ?>
            <?php echo Html::submitButton('Submit', ['class' => 'btn btn-primary']); ?>
        </div>
    </div>
    <?php $form->end(); ?>
</div>
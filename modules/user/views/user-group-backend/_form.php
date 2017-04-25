<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\UserGroup */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="user-group-form">

        <?php $form = ActiveForm::begin([
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
        ]); ?>

        <div class="form-body">
            <h3 class="form-section"><?= Yii::t('user', 'General details'); ?></h3>
            <div class="row">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('name')]) ?>
            </div>
        </div>

        <div class="form-actions fluid">
            <div class="col-md-offset-3 col-md-9">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('user', 'Cancel'), ['index'], ['class' => 'btn default']); ?>
            </div>
        </div>

        <div class="form-body">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="form-section"><?= Yii::t('user', 'Users'); ?></h3>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="usergroup-user">Add User</label>
                            <div class="col-md-4">
                                <select id="usergroup-user" data-link="<?= \yii\helpers\Url::toRoute(['/user/user-group-backend/get-user']) ?>" style="width: 100%"></select>
                            </div>
                            <div class="col-md-1">
                                <?= Html::a('<span class="fa fa-plus"></span>', '#', [
                                    'id' => 'add-user',
                                    'title' => 'Add this user to group',
                                    'data-link' => \yii\helpers\Url::toRoute(['/user/user-group-backend/add-user'])
                                ]); ?>
                            </div>
                        </div>
                    </div>

                    <div class="list-group" id="user-list-group">
                        <?php foreach ($model->userGroupRelations as $groupRelation): ?>
                            <?php echo $this->render('_user-group-item', [
                                'user' => $groupRelation->user
                            ]); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

<?php
$this->registerJsFile('/backend/js/user_group_module.js', ['depends' => \app\assets\SelectAsset::class]);
$this->registerJs('user_group_module.init()');
?>

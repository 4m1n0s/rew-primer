<?php

/* @var \yii\web\View $this */
/* @var \app\modules\user\models\User $currentUser */

use yii\helpers\Html;

$this->title = Yii::t('app', 'My Account');
?>
<?php $this->beginBlock('title') ?>
<?= $this->title ?>
<?php $this->endBlock() ?>
<!-- post content -->
<div class="post-content">
    <!-- Post item-->
    <div class="post-item">
        <div class="post-content-details">
            <div class="col-md-12">
                <div class="seperator"><span>Login Information</span></div>
                <?php \yii\widgets\Pjax::begin(['id' => 'login-info-pjax', 'enablePushState' => true]); ?>
                <?php echo $this->render('_login-info', [
                    'currentUser' => $currentUser
                ]); ?>
                <?php \yii\widgets\Pjax::end(); ?>
            </div>

            <div class="col-md-12">
                <div class="seperator"><span>Personal Information</span></div>
                <?php \yii\widgets\Pjax::begin(['id' => 'personal-info-pjax', 'enablePushState' => true]); ?>
                <?php echo $this->render('_personal-info', [
                    'currentUser' => $currentUser
                ]); ?>
                <?php \yii\widgets\Pjax::end(); ?>
            </div>
        </div>
    </div>

</div>
<!-- END: post content -->
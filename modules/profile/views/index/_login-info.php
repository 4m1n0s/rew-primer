<?php
/* @var \yii\web\View $this */
/* @var \app\modules\user\models\User $currentUser */

use yii\helpers\Html;
?>
<dl class="dl-horizontal">
    <dt>Username</dt>
    <dd><?php echo Html::a($currentUser->username, ['/profile/index/login-form']) ?></dd>
    <dt>Email</dt>
    <dd><?php echo Html::a($currentUser->email, ['/profile/index/login-form']) ?></dd>
    <dt>Password</dt>
    <dd><?php echo Html::a('******', ['/profile/index/password-form']) ?></dd>
</dl>
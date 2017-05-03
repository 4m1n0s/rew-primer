<?php
/* @var \yii\web\View $this */
/* @var \app\modules\user\models\User $currentUser */

use yii\helpers\Html;
?>
<dl class="dl-horizontal">
    <dt>First Name</dt>
    <dd><?php echo Html::a($currentUser->first_name ?: '[edit]', ['/profile/index/personal-form'])?></dd>
    <dt>Last Name</dt>
    <dd><?php echo Html::a($currentUser->last_name ?: '[edit]', ['/profile/index/personal-form'])?></dd>
    <dt>Birthday</dt>
    <dd><?php echo Html::a($currentUser->birthday ?: '[edit]', ['/profile/index/personal-form'])?></dd>
    <dt>Gender</dt>
    <dd><?php echo Html::a($currentUser->getGenderName(), ['/profile/index/personal-form'])?></dd>
</dl>
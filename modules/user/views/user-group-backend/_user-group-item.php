<?php

use yii\helpers\Html;

/* @var \yii\web\View $this */
/* @var \app\modules\user\models\User $user */
?>

<div class="user-group-item">
    <span class="list-group-item col-md-4">
        <?= $user->email ?>
        <?= Html::a('<span class="fa fa-minus"></span>', '#', [
            'class' => 'remove-user',
            'title' => 'Remove this user from group',
            'style' => 'float: right !important;'
        ]); ?>
    </span>
    <?= Html::hiddenInput('UserGroupRelation[user_id][' . $user->id . ']', $user->email); ?>
</div>
<?php

use yii\helpers\Html;

/* @var \yii\web\View $this */
/* @var \app\modules\user\models\User $user */
?>

<div class="user-group-item col-md-4" style="margin: 5px 0 5px 0">
    <span class="list-group-item">
        <?= $user->email ?>
        <?= Html::a('<span class="fa fa-minus"></span>', '#', [
            'class' => 'remove-user',
            'title' => 'Remove this user from group',
            'style' => 'float: right !important;'
        ]); ?>
    </span>
    <?= Html::hiddenInput('UserGroupRelation[user_id][' . $user->id . ']', $user->email); ?>
</div>
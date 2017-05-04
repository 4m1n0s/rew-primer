<?php

/* @var \yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Offer Wall';
?>

<div class="row">
    <div class="col-md-3">
        <?= Html::a(
            Html::img('/images/offer-providers/adwork-media.png', ['alt' => 'adwork-media']),
            ['/profile/offer/adworkmedia']
        ); ?>
    </div>
</div>

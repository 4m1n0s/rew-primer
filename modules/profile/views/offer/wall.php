<?php

/* @var \yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Offer Wall';
?>

<div class="row">
    <div class="col-md-3">
        <?= Html::a(
            Html::img('/images/offer-providers/adwork-media.png', ['alt' => 'adwork-media', 'style' => 'width:100%']),
            ['/profile/offer/adworkmedia']
        ); ?>
    </div>
    <div class="col-md-3">
        <?= Html::a(
            Html::img('/images/offer-providers/offertoro.png', ['alt' => 'offer-toro', 'style' => 'width:100%']),
            ['/profile/offer/offertoro']
        ); ?>
    </div>
</div>
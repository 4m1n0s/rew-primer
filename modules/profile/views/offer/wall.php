<?php

/* @var \yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Offer Walls';
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
    <div class="col-md-3">
        <?= Html::a(
            Html::img('/images/offer-providers/clixwall.png', ['alt' => 'clixwall', 'style' => 'width:100%']),
            ['/profile/offer/clixwall']
        ); ?>
    </div>
    <div class="col-md-3">
        <?= Html::a(
            Html::img('/images/offer-providers/offerdaddy.png', ['alt' => 'offer-daddy', 'style' => '']),
            ['/profile/offer/offerdaddy']
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <?= Html::a(
            Html::img('/images/offer-providers/ptcwall.jpg', ['alt' => 'ptcwall', 'style' => 'width:100%']),
            ['/profile/offer/ptcwall']
        ); ?>
    </div>
    <div class="col-md-3">
        <?= Html::a(
            Html::img('/images/offer-providers/kiwiwall.png', ['alt' => 'kiwiwall', 'style' => '']),
            ['/profile/offer/kiwiwall']
        ); ?>
    </div>
</div>
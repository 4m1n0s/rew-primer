<?php

/* @var \yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Offer Walls';
?>

<div class="row">
    <div class="col-md-3">
        <div class="timeline-img">            
           <?= Html::a(
                Html::img('/images/offer-providers/adwork-media.png', ['alt' => 'adwork-media', 'class' => 'timeline-badge-userpic']),
                ['/profile/offer/adworkmedia']
            ); ?>
        </div>  
    </div>
    <div class="col-md-3">
        <div class="timeline-img">
            <?= Html::a(
                Html::img('/images/offer-providers/offertoro.png', ['alt' => 'offer-toro', 'class' => 'timeline-badge-userpic']),
                ['/profile/offer/offertoro']
            ); ?>
        </div>  
    </div>
    <div class="col-md-3">
        <div class="timeline-img">
            <?= Html::a(
                Html::img('/images/offer-providers/clixwall.png', ['alt' => 'clixwall', 'class' => 'timeline-badge-userpic']),
                ['/profile/offer/clixwall']
            ); ?>
        </div>  
    </div>
    <div class="col-md-3">
        <div class="timeline-img">
            <?= Html::a(
                Html::img('/images/offer-providers/offerdaddy.png', ['alt' => 'offer-daddy', 'class' => 'timeline-badge-userpic']),
                ['/profile/offer/offerdaddy']
            ); ?>
        </div>  
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="timeline-img">
            <?= Html::a(
                Html::img('/images/offer-providers/ptcwall.jpg', ['alt' => 'ptcwall', 'class' => 'timeline-badge-userpic']),
                ['/profile/offer/ptcwall']
            ); ?>
        </div>  
    </div>
    <div class="col-md-3">
        <div class="timeline-img">
            <?= Html::a(
                Html::img('/images/offer-providers/kiwiwall.png', ['alt' => 'kiwiwall', 'class' => 'timeline-badge-userpic']),
                ['/profile/offer/kiwiwall']
            ); ?>
        </div>  
    </div>
    <div class="col-md-3">
        <div class="timeline-img">
            <?= Html::a(
                Html::img('/images/offer-providers/superrewards.png', ['alt' => 'kiwiwall', 'class' => 'timeline-badge-userpic']),
                ['/profile/offer/superrewards']
            ); ?>
        </div>
    </div>
</div>
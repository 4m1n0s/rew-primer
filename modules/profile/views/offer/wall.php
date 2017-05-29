<?php

/* @var \yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Offer Walls';
?>
<div>

    <!--Portfolio Filter-->
    <div class="filter-active-title">Banner</div>
    <ul class="portfolio-filter" id="portfolio-filter" data-isotope-nav="isotope">
        <li class="ptf-active" data-filter="*">Show All</li>
        <li data-filter=".cat1" class="">Category 1</li>
        <li data-filter=".cat2" class="">Category 2</li>
        <li data-filter=".cat3" class="">Category 3</li>
        <li data-filter=".cat4" class="">Category 4</li>
        <li data-filter=".cat5" class="">Category 5</li>
    </ul>
    <!-- END: Portfolio Filter -->

    <!-- Portfolio Items -->
    <div id="isotope" class="isotope portfolio-items" data-isotope-item-space="0" data-isotope-mode="masonry" data-isotope-col="4" data-isotope-item=".portfolio-item" style="position: relative; height: 100%; margin-right: 0%;">
        <div class="col-md-3 portfolio-item">
            <div class="timeline-img">
                <?= Html::a(
                    Html::img('/images/offer-providers/adwork-media.png', ['alt' => 'adwork-media', 'class' => 'timeline-badge-userpic']),
                    ['/profile/offer/adworkmedia']
                ); ?>
            </div>
        </div>

        <div class="col-md-3 portfolio-item cat3 cat4">
            <div class="timeline-img">
                <?= Html::a(
                    Html::img('/images/offer-providers/offertoro.png', ['alt' => 'offer-toro', 'class' => 'timeline-badge-userpic']),
                    ['/profile/offer/offertoro']
                ); ?>
            </div>
        </div>
        <div class="col-md-3 portfolio-item cat2 cat3 cat4">
            <div class="timeline-img">
                <?= Html::a(
                    Html::img('/images/offer-providers/clixwall.png', ['alt' => 'clixwall', 'class' => 'timeline-badge-userpic']),
                    ['/profile/offer/clixwall']
                ); ?>
            </div>
        </div>
        <div class="col-md-3 portfolio-item cat1 cat5">
            <div class="timeline-img">
                <?= Html::a(
                    Html::img('/images/offer-providers/offerdaddy.png', ['alt' => 'offer-daddy', 'class' => 'timeline-badge-userpic']),
                    ['/profile/offer/offerdaddy']
                ); ?>
            </div>
        </div>
        <div class="portfolio-item col-md-3 cat2 cat4">
            <div class="timeline-img">
                <?= Html::a(
                    Html::img('/images/offer-providers/ptcwall.jpg', ['alt' => 'ptcwall', 'class' => 'timeline-badge-userpic']),
                    ['/profile/offer/ptcwall']
                ); ?>
            </div>
        </div>
        <div class="col-md-3 portfolio-item cat4 cat5">
            <div class="timeline-img">
                <?= Html::a(
                    Html::img('/images/offer-providers/kiwiwall.png', ['alt' => 'kiwiwall', 'class' => 'timeline-badge-userpic']),
                    ['/profile/offer/kiwiwall']
                ); ?>
            </div>
        </div>
        <div class="col-md-3 portfolio-item cat1 cat3">
            <div class="timeline-img">
                <?= Html::a(
                    Html::img('/images/offer-providers/superrewards.png', ['alt' => 'superrewards', 'class' => 'timeline-badge-userpic']),
                    ['/profile/offer/superrewards']
                ); ?>
            </div>
        </div>
        <div class="col-md-3 portfolio-item cat3 ca5">
            <div class="timeline-img">
                <?= Html::a(
                    Html::img('/images/offer-providers/minutestaff.png', ['alt' => 'minutestaff', 'class' => 'timeline-badge-userpic']),
                    ['/profile/offer/minutestaff']
                ); ?>
            </div>
        </div>
        <div class="col-md-3 portfolio-item cat1 cat2">
            <div class="timeline-img">
                <?= Html::a(
                    Html::img('/images/offer-providers/cpalead.png', ['alt' => 'cpalead', 'class' => 'timeline-badge-userpic']),
                    ['/profile/offer/cpalead']
                ); ?>
            </div>
        </div>
        <div class="col-md-3 portfolio-item cat3 cat4 cat5">
            <div class="timeline-img">
                <?= Html::a(
                    Html::img('/images/offer-providers/persona.jpg', ['alt' => 'persona', 'class' => 'timeline-badge-userpic']),
                    ['/profile/offer/persona']
                ); ?>
            </div>
        </div>
        <div class="col-md-3 portfolio-item cat1 cat2">
            <div class="timeline-img">
                <?= Html::a(
                    Html::img('/images/offer-providers/fyber_logo.png', ['alt' => 'fyber', 'class' => 'timeline-badge-userpic']),
                    ['/profile/offer/fyber']
                ); ?>
            </div>
        </div>
    </div>
    <!-- END: Portfolio Items -->
    <hr class="space">
</div>
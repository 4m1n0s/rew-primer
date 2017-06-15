<?php

/* @var \yii\web\View $this */
/* @var \app\modules\offer\components\OfferCollection $offers */
/* @var array $categories */

use yii\helpers\Html;

$this->title = 'Offer Walls';
?>

<div>
    <!--Offer Filter-->
    <div class="filter-active-title">Show All</div>
    <ul class="portfolio-filter" id="portfolio-filter" data-isotope-nav="isotope">
        <li class="ptf-active" data-filter="*">Show All</li>
        <?php foreach ($categories as $category): ?>
            <li data-filter=".<?= \yii\helpers\Inflector::variablize($category['name']) ?>"><?= $category['name'] ?></li>
        <?php endforeach ?>
    </ul>
    <!-- END: Offer Filter -->

    <?php if ($offers->count()): ?>
        <div id="isotope" class="isotope"
             data-isotope-item-space="3"
             data-isotope-mode="fitRows"
             data-isotope-col="4"
             data-isotope-item=".offer-item"
             style="position: relative; height: 100%; margin-right: 0%;">
            <!-- Offer Items -->
            <?php foreach ($offers as $offer): ?>
                <div class="offer-item <?= $offer->getCategoriesViewList() ?>">
                    <div class="timeline-img">
                        <?= Html::a(
                            Html::img($offer->img, ['alt' => strtolower($offer->label), 'class' => 'timeline-badge-userpic']),
                            ['/profile/offer/single', 'id' => $offer->id]
                        ); ?>
                    </div>
                </div>
            <?php endforeach ?>
            <!-- END: Offer Items -->
        </div>
    <?php else: ?>
        <p>No available offers</p>
    <?php endif ?>

    <hr class="space">
</div>
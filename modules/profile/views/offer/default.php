<?php
/* @var \yii\web\View $this */
/* @var string $offerFrameUrl */
?>

<div id="offer-page-wrap" style="height: 1000px;"
     data-link="<?php echo \yii\helpers\Url::toRoute(['/profile/offer/single', 'id' => $offerID]) ?>"
     data-pk="<?php echo $offerID ?>">
    <section>
        <div class="loader text-center">
            <img width="40" src="/images/svg-loaders/bars.svg" alt="">
            <div class="m-t-100"></div>
        </div>
    </section>
</div>
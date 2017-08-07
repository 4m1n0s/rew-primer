<?php
/* @var \app\modules\pages\models\Page $page */

use yii\helpers\Html;

\romi45\seoContent\components\SeoContentHelper::registerAll($page);
?>

<!-- PAGE TITLE -->
<section id="page-title" class="page-title-parallax page-title-center text-dark" style="background-image:url(/images/page-title-parallax.jpg);">
    <div class="container">
        <div class="page-title col-md-8">
            <h1><?php echo Html::encode($page->title) ?></h1>
            <span><?php echo Html::encode($page->description) ?></span>
        </div>
    </div>
</section>
<!-- END: PAGE TITLE -->
<!-- SECTION -->
<section>
    <div class="container">
        <?php echo $page->content ?>
    </div>
</section>
<!-- END: SECTION -->
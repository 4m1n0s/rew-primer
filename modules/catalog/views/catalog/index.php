<?php

/* @var \yii\base\View $this */
/* @var \app\modules\catalog\models\Product[] $products */
/* @var \app\modules\catalog\models\CategoryProduct[] $categories */
/* @var \yii\data\ActiveDataProvider $productDataProvider */

use yii\helpers\Html;
use yii\widgets\ListView;
?>

<section>
    <div class="container">
        <h3 class="text-justify">Gift Cards</h3>

        <div class="row">
            <!-- Post content-->
            <?php \yii\widgets\Pjax::begin() ?>
            <div class="post-content col-md-9">
                <div class="row m-b-20">
                    <div class="col-md-6 p-t-20 m-b-20">
                        <form id="widget-subscribe-form-sidebar" role="form" method="get" class="form-inline" novalidate="novalidate">
                            <div class="input-group">
                                <input type="email" aria-required="true" name="name" class="form-control required email" placeholder="Search">
                                <span class="input-group-btn">
                                    <button type="submit" id="widget-subscribe-submit-button" class="btn btn-primary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span></div>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <div class="order-select">
                            <h6>Sort by</h6>
                            <form method="get">
                                <select>
                                    <option selected="selected" value="order">Default sorting</option>
                                    <option value="popularity">Sort by popularity</option>
                                    <option value="rating">Sort by average rating</option>
                                    <option value="date">Sort by newness</option>
                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="order-select">
                            <h6>Sort by Price</h6>
                            <form method="get">
                                <select>
                                    <option selected="selected" value="">0$ - 50$</option>
                                    <option value="">51$ - 90$</option>
                                    <option value="">91$ - 120$</option>
                                    <option value="">121$ - 200$</option>
                                </select>
                            </form>
                        </div>
                    </div>


                </div>
                <!--Product list-->
                <div class="shop">
                    <div class="row"></div>

                    <?php echo ListView::widget([
                        'dataProvider' => $productDataProvider,
                        'itemView' => '_product-item',
                        'layout' => "{summary}\n<div class='row'>{items}</div>\n<nav class='text-center'>{pager}</nav>",
                        'itemOptions' => [
                            'tag' => false,
                        ]
                    ]); ?>

                </div>
                <!--END: Product list-->

            </div>
            <?php \yii\widgets\Pjax::end() ?>
            <!-- END: Post content-->

            <!-- Sidebar-->
            <div class="sidebar col-md-3">
                <!--widget newsletter-->
                <div class="widget clearfix widget-archive">
                    <h4 class="widget-title">Categories</h4>
                    <ul class="list list-lines">
                        <?php foreach ($categories as $category): ?>
                            <li><a href="#"><?php echo $category['name'] ?></a> <span class="count">(<?php echo $category['count'] ?>)</span></li>
                        <?php endforeach ?>
                    </ul>
                </div>


            </div>
            <!-- END: Sidebar-->
        </div>
    </div>
</section>
<?php

/* @var \yii\base\View $this */
/* @var \app\modules\catalog\models\CategoryProduct[] $categories */
/* @var \yii\data\ActiveDataProvider $productDataProvider */
/* @var string $productsCount */

use yii\helpers\Html;
use yii\widgets\ListView;
?>

<section>
    <div class="container">
        <h3 class="text-justify">Gift Cards</h3>

        <?php \yii\widgets\Pjax::begin() ?>
        <div class="row">
            <!-- Post content-->
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
                                    <option value="date">Sort by alphabetical: A to Z</option>
                                    <option value="date">Sort by alphabetical: Z to A</option>
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
                                    <option selected="selected" value="">0 - 200</option>
                                    <option value="">201 - 500</option>
                                    <option value="">501 - 800</option>
                                    <option value="">from 801</option>
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
            <!-- END: Post content-->

            <!-- Sidebar-->
            <div class="sidebar col-md-3">
                <!--widget newsletter-->
                <div class="widget clearfix widget-archive">
                    <h4 class="widget-title">Categories</h4>
                    <ul class="list list-lines">
                        <li><?php echo Html::a('All', ['/catalog/catalog/index', 'cat' => 0]) ?> <span class="count">(<?php echo $productsCount ?>)</span></li>
                        <?php foreach ($categories as $category): ?>
                            <li><?php echo Html::a(Html::encode($category['name']), ['/catalog/catalog/index', 'cat' => $category['id']]) ?> <span class="count">(<?php echo $category['count'] ?>)</span></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <!-- END: Sidebar-->
        </div>
        <?php \yii\widgets\Pjax::end() ?>
    </div>
</section>
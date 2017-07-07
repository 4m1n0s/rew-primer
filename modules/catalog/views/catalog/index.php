<section>
    <div class="container">
        <h3 class="text-justify">Gift Cards</h3>

        <div class="row">
            <!-- Post content-->
            <div class="post-content col-md-9">
                <div class="row m-b-20">
                    <div class="col-md-6 p-t-60 m-b-20">
                        <form id="widget-subscribe-form-sidebar" action="include/subscribe-form.php" role="form" method="post" class="form-inline" novalidate="novalidate">
                            <div class="input-group">
                                <input type="email" aria-required="true" name="widget-subscribe-form-email" class="form-control required email" placeholder="Search">
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
                            <p>Showing 1–12 of 25 results</p>
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
                            <p>From 0 - 190$</p>
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
                    <div class="row">

                        <div class="col-md-4">
                            <div class="product">
                                <div class="product-description">
                                    <div class="product-category">Category</div>
                                    <div class="product-title">
                                        <h3><a href="#">Gift Card #1</a></h3>
                                    </div>
                                    <div class="product-price">
                                        <ins>$15.00</ins>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <nav class="text-center">
                        <div class="pagination-wrap">
                            <ul class="pagination">
                                <li>
                                    <a href="#" aria-label="Previous">
                                        <span aria-hidden="true"><i class="fa fa-angle-left"></i></span>

                                    </a>
                                </li>
                                <li><a href="#">1</a>
                                </li>
                                <li><a href="#">2</a>
                                </li>
                                <li class="active"><a href="#">3</a>
                                </li>
                                <li><a href="#">4</a>
                                </li>
                                <li><a href="#">5</a>
                                </li>
                                <li>
                                    <a href="#" aria-label="Next">
                                        <span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
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
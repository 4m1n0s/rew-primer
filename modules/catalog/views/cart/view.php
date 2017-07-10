<?php

/* @var \yii\web\View $this */
/* @var \app\modules\catalog\models\Product $product */

use yii\helpers\Html;
?>

<section id="shop-cart">
    <div class="container">
        <div class="shop-cart">
            <div class="table table-condensed table-striped table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="cart-product-remove"></th>
                        <th class="cart-product-thumbnail">Product</th>
                        <th class="cart-product-price">Unit Price</th>
                        <th class="cart-product-quantity">Quantity</th>
                        <th class="cart-product-subtotal">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="cart-item">
                        <td class="cart-product-remove">
                            <a href="#"><i class="fa fa-close"></i></a>
                        </td>

                        <td class="cart-product-thumbnail">

                            <div class="cart-product-thumbnail-name">Bolt Sweatshirt</div>
                        </td>

                        <td class="cart-product-price">
                            <span class="amount">$20.00</span>
                        </td>

                        <td class="cart-product-quantity">
                            <div class="quantity">
                                <input type="text" class="qty" value="1" name="quantity">
                            </div>
                        </td>

                        <td class="cart-product-subtotal">
                            <span class="amount">$20.00</span>
                        </td>
                    </tr>

                    </tbody>

                </table>

            </div>

            <div class="row">

                <div class="col-md-6 p-r-10 ">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>

                            <tr>
                                <td class="cart-product-name">
                                    <strong>Total</strong>
                                </td>

                                <td class="cart-product-name text-right">
                                    <span class="amount color lead"><strong>$100.76</strong></span>
                                </td>
                            </tr>
                            </tbody>

                        </table>

                    </div>

                    <a href="#" class="button rounded icon-left float-right"><span>Redeem</span></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$this->registerAssetBundle(\app\assets\TouchSpinAsset::class);
$js = <<< JS
    $('.qty').TouchSpin({
        min: 1,
        max: 50,
    });
JS;
$this->registerJs($js);
?>
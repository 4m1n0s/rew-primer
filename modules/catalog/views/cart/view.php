<?php

/* @var \yii\web\View $this */
/* @var \app\modules\catalog\models\Product[] $positions */
/* @var string $totalCost */

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
                    <?php foreach ($positions as $position): ?>
                        <tr class="cart-item">
                            <td class="cart-product-remove">
                                <a href="#"><i class="fa fa-close"></i></a>
                            </td>

                            <td class="cart-product-thumbnail">
                                <div class="cart-product-thumbnail-name"><?php echo $position->name ?></div>
                            </td>

                            <td class="cart-product-price">
                                <span class="amount"><?php echo $position->price ?></span>
                            </td>

                            <td class="cart-product-quantity">
                                <div class="quantity-min-width">
                                    <input type="text" class="qty" value="<?php echo $position->getQuantity() ?>" name="quantity">
                                </div>
                            </td>

                            <td class="cart-product-subtotal">
                                <span class="amount"><?php echo $position->getCost() ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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
                                    <span class="amount color lead"><strong><?php echo $totalCost ?></strong></span>
                                </td>
                            </tr>
                            </tbody>

                        </table>

                    </div>

                    <a href="#" class="btn btn-primary btn-lg float-right"><span>Redeem</span></a>
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
        buttondown_class: 'btn btn-default btn-sm',
        buttonup_class: 'btn btn-default btn-sm'
    });
JS;
$this->registerJs($js);
?>
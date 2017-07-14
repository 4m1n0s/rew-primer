<?php

/* @var \yii\web\View $this */
/* @var \app\modules\catalog\models\Product[] $positions */
/* @var string $totalCost */
/* @var string $totalCount */

use yii\helpers\Html;
?>
<div class="container">
    <div class="shop-cart">
        <h3 class="text-justify">Cart</h3>
        <?php if (empty($positions)): ?>
            <div class="p-t-10 m-b-20 text-center">
                <div class="heading-fancy heading-line text-center">
                    <h4>Your cart is currently empty.</h4>
                </div>
                <?php echo Html::a('<span>Return To Shop</span>', ['/catalog/catalog/index'], ['class' => 'btn btn-primary btn-lg', 'data-pjax' => 0]) ?>
            </div>
        <?php else: ?>
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
                                <?php echo Html::a('<i class="fa fa-close"></i>', '#', [
                                    'class' => 'cart-product-remove-item',
                                    'data-url' => \yii\helpers\Url::toRoute(['/catalog/cart/remove']),
                                    'data-id' => $position->id
                                ]) ?>
                            </td>

                            <td class="cart-product-thumbnail">
                                <div class="cart-product-thumbnail-name">
                                    <?php echo Html::a(Html::encode($position->name), ['/catalog/catalog/single', 'id' => $position->id]) ?>
                                </div>
                            </td>

                            <td class="cart-product-price">
                                <span class="amount"><?php echo $position->price ?></span>
                            </td>

                            <td class="cart-product-quantity">
                                <div class="quantity-min-width">
                                    <input type="text" class="qty" value="<?php echo $position->getQuantity() ?>"
                                           name="quantity"
                                           data-url="<?php echo \yii\helpers\Url::toRoute(['/catalog/cart/update-qty']) ?>"
                                           data-id="<?php echo $position->id ?>">
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
                                    <strong>Total (<span id="cart-total-count"><?php echo $totalCount ?>)</span></strong>
                                </td>

                                <td class="cart-product-name text-right">
                                    <span class="amount color lead"><strong><?php echo $totalCost ?></strong></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php echo Html::a('Redeem', ['/catalog/order/checkout'], ['class' => 'btn btn-primary btn-lg float-right']) ?>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>

<?php
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

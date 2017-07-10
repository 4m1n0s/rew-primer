<?php

/* @var \yii\base\Widget $this */
/* @var string $cartCount */

use yii\helpers\Html;
?>

<div id="shopping-cart">
    <span class="shopping-cart-items"><?php echo $cartCount ?></span>
    <?php echo Html::a('<i class="fa fa-shopping-cart"></i>', ['/catalog/cart/view']) ?>
</div>
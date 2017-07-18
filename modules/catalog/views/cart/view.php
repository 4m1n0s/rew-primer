<?php

/* @var \yii\web\View $this */
/* @var \app\modules\catalog\models\Product[] $positions */
/* @var string $totalCost */
/* @var string $totalCount */

use yii\helpers\Html;
$this->title = 'Cart';
?>

<section id="shop-cart">
    <?php echo $this->render('_cart', [
        'positions' => $positions,
        'totalCost' => $totalCost,
        'totalCount' => $totalCount
    ]) ?>
</section>

<?php
$this->registerAssetBundle(\app\assets\TouchSpinAsset::class);
$this->registerAssetBundle(\app\modules\catalog\assets\Cart::class);
$js = <<< JS
    cart_module.init();
JS;
$this->registerJs($js);
?>
<?php

/* @var \yii\web\View $this */
/* @var \app\modules\catalog\models\ProductGroup $productGroup */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\ArrayHelper;
?>

<section>
    <div class="container">
        <h3 class="text-justify"><?php echo Html::encode($productGroup->name) ?></h3>
        <p><?php echo $productGroup->description ?></p>
        <?php \yii\widgets\Pjax::begin(['id' => 'catalog-product-pjax']) ?>
        <div class="row">
            <!-- Post content-->
            <div class="post-content col-md-12">
                <!--Product list-->
                <div class="shop">
                    <div class="row">
                        <?php foreach ($productGroup->products as $product): ?>
                            <div class="col-md-2 display-price clearfix">
                                <div class="product product-block" data-pk="<?php echo $product->id ?>" title="Add to Cart">
                                    <div class="product-description clearfix">
                                        <div class="product-price in-usd">
                                            <ins><?php echo Yii::$app->formatter->asDecimal(Yii::$app->virtualCurrencyExchanger->toUSD($product->price)) ?>($)</ins>
                                        </div>
                                        <div class="in-vc">
                                            <?php echo Yii::$app->formatter->asDecimal($product->price) ?>(bucks)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="m-t-20">
                        <?php echo Html::a('<i class="fa fa-shopping-cart"></i> Go to Cart', ['/catalog/cart/view'], ['class' => 'btn btn-primary btn-lg']) ?>
                    </div>
                </div>
                <!--END: Product list-->
            </div>
            <!-- END: Post content-->
        </div>
        <?php \yii\widgets\Pjax::end() ?>
    </div>
</section>

<?php
$js = <<< JS
$('.product-block').on('click', function(e) {
    var pk = $(this).data('pk');
    
    $.ajax({
        url: '/catalog/cart/add',
        method: 'POST',
        dataType: 'json',
        data: {pk: pk, qty: 1},
        success: function (response) {
            $.notify("Item has been added to cart");
        }
     });
})
JS;
if (!Yii::$app->getUser()->getIsGuest()) {
    $this->registerJs($js);
}
?>
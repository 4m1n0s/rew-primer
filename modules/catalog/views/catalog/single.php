<?php

/* @var \yii\web\View $this */
/* @var \app\modules\catalog\models\Product $product */

use yii\helpers\Html;
?>

<section id="product-page" class="product-page p-b-0">
    <div class="container">
        <div class="product">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-description">
                        <div class="product-title">
                            <h3><?php echo Html::encode($product->name) ?></h3>
                        </div>
                        <div class="product-price"><ins><?php echo Html::encode($product->price) ?></ins>
                        </div>
                        <div class="seperator m-b-10"></div>
                        <p><?php echo Html::encode($product->description) ?></p>
                        <div class="product-meta">
                            <div class="product-category">Categories: <?php echo $product->categoryList() ?></div>
                        </div>
                        <div class=" m-t-20 m-b-10"></div>
                    </div>
                    <?php if (!Yii::$app->getUser()->getIsGuest()): ?>
                        <?php if (Yii::$app->getUser()->getIdentity()->role != \app\modules\user\models\User::ROLE_PARTNER): ?>
                            <form method="post" id="cart-form" action="<?php echo \yii\helpers\Url::toRoute(['/catalog/cart/add']) ?>">
                                <div class="m-t-10">
                                    <h6>Select quantity</h6>
                                    <div class="cart-product-quantity">
                                        <div class="quantity-min-width">
                                            <input type="text" value="1" id="qty" name="qty" class="input-sm">
                                        </div>
                                    </div>
                                    <input type="hidden" value="<?php echo $product->id ?>" name="pk">
                                    <?php echo Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []); ?>
                                </div>
                                <div class="m-t-20">
                                    <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                                </div>
                            </form>
                        <?php endif ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$this->registerAssetBundle(\app\assets\TouchSpinAsset::class);
$js = <<< JS
    $('#qty').TouchSpin({
        min: 1,
        max: 50,
        buttondown_class: 'btn btn-grey btn-sm',
        buttonup_class: 'btn btn-grey btn-sm'
    });
JS;
$this->registerJs($js);
?>
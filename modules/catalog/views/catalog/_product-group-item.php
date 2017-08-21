<?php

/* @var \yii\base\View $this */
/* @var \app\modules\catalog\models\ProductGroup $model */

use yii\helpers\Html;
?>

<div class="col-md-4 category-content clearfix">
    <div class="product">
        <div class="product-description clearfix">
            <div class="product-category"><?php echo $model->categoryList() ?></div>
            <div class="category-list">
            	<?php echo Html::a(Html::img($model->image), ['/catalog/catalog/group', 'id' => $model->id], ['data-pjax' => 0]) ?>
            </div>
        </div>
    </div>
</div>
<?php

/* @var \yii\web\View $this */
/* @var \app\modules\catalog\models\CategoryProductGroup[] $categories */
/* @var \yii\data\ActiveDataProvider $productGroupDataProvider */
/* @var \app\modules\catalog\models\search\ProductGroupSearch $searchModel */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\ArrayHelper;
?>

<section>
    <div class="container">
        <h3 class="text-justify">Gift Cards</h3>
        <?php \yii\widgets\Pjax::begin(['id' => 'catalog-pjax']) ?>
        <div class="row">
            <!-- Post content-->
            <div class="post-content col-md-9">
                <div class="row m-b-20">
                    <form role="form" method="get" class="form-inline" id="order-filter" novalidate="novalidate" data-pjax="">
                        <div class="col-md-8 p-t-20 m-b-20">
                            <div class="input-group">
                                <input type="text" aria-required="true" name="ProductGroupSearch[name]" class="form-control"
                                       placeholder="Search"
                                       value="<?php echo ArrayHelper::getValue(Yii::$app->request->get('ProductGroupSearch'), 'name'); ?>">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary" id="name-search">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="order-select">
                                <h6>Sort by Name</h6>
                                <?php echo Html::dropDownList('ProductGroupSearch[name_order]', ArrayHelper::getValue(Yii::$app->request->get('ProductGroupSearch'), 'name_order'), [
                                    'name-asc' => 'A to Z',
                                    'name-desc' => 'Z to A',
                                ], ['id' => 'name-order-dropdown']) ?>
                            </div>
                        </div>

                        <?php echo Html::hiddenInput('ProductGroupSearch[category]', ArrayHelper::getValue(Yii::$app->request->get('ProductGroupSearch'), 'category'), ['id' => 'filter-category'])?>
                    </form>
                </div>
                <!--Product list-->
                <div class="shop">
                    <div class="row"></div>
                    <?php echo ListView::widget([
                        'dataProvider' => $productGroupDataProvider,
                        'itemView' => '_product-group-item',
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
                        <li></li>
                        <li><a href="javascript: void(0)" class="filter-categories" data-id="0">All</a></li>
                        <?php foreach ($categories as $category): ?>
                            <li><a href="javascript: void(0)" class="filter-categories" data-id="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <!-- END: Sidebar-->
        </div>
        <?php \yii\widgets\Pjax::end() ?>
    </div>
</section>

<?php
$js = <<< JS
$(document).on('change', '#name-order-dropdown', function(event) {
    $('#order-filter').submit();
})
$(document).on('click', '#name-search', function(event) {
    $('#order-filter').submit();
})
$(document).on('click', '.filter-categories', function(event) {
    $('#filter-category').val($(this).data('id'));
    $('#order-filter').submit();
})
JS;
$this->registerJs($js);
?>
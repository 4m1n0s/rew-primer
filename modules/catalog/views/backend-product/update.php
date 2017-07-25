<?php

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\Product */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Product',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="product-update">
    <?= $this->render('_form', [
        'model' => $model,
        'categoryList' => $categoryList
    ]) ?>

</div>
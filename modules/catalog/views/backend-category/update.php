<?php

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\CategoryProduct */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Category',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="category-product-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

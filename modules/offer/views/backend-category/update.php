<?php

/* @var $this yii\web\View */
/* @var $model app\modules\offer\models\Category */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Category',
]) . $model->name;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Categories'),
    'url' => ['index'],
];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

echo $this->render('_form', [
    'model' => $model
])
?>


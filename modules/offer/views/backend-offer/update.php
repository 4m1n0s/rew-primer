<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\offer\models\Offer */
/* @var $categoryList array */
/* @var $countriesList array */
/* @var $deviceTypeList array */
/* @var $deviceOsList array */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Offer',
]) . $model->name;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Offers'),
    'url' => ['index'],
    'template' => '<li> {link} <i class="fa fa-circle"></i></li>'
];

$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<?= $this->render('_form', [
    'model' => $model,
    'categoryList' => $categoryList,
    'countriesList' => $countriesList,
    'deviceTypeList' => $deviceTypeList,
    'deviceOsList' => $deviceOsList
]) ?>


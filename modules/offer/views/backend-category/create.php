<?php

/* @var $this yii\web\View */
/* @var $model app\modules\offer\models\Category */

$this->title = Yii::t('app', 'Create Category');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Categories'),
    'url' => ['index'],
];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_form', [
    'model' => $model
])

?>

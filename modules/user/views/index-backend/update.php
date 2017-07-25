<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = Yii::t('user', 'Update {modelClass}: ', [
        'modelClass' => 'User',
    ]) . ' ' . $model->email;

$this->title = $this->title;
$this->params['pageTitle'] = Yii::t('user', 'Users');
$this->params['pageSmallTitle'] = Yii::t('user', 'update') . " \"$model->email\"";

$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('user', 'Update');
?>

<?=
$this->render('_form', [
    'model' => $model,
    'roleList' => $model->getRoleList(),
    'statusList' => $model->getStatusList(),
//    'stateList' => $stateList,
])
?>
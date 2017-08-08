<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\modules\user\models\User */

$this->title = Yii::t('user', 'Create {modelClass}', [
        'modelClass' => 'Users',
    ]);

$this->params['pageTitle'] = Yii::t('user', 'Users');
$this->params['pageSmallTitle'] = Yii::t('user', 'create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?=
$this->render('_form', [
    'model' => $model,
    'roleList' => $model->getRoleList(),
    'statusList' => $model->getStatusList(),
])
?>


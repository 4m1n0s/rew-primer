<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = Yii::t('user', 'Create {modelClass}', [
        'modelClass' => 'Users',
    ]);

$this->title = $this->title;
$this->params['pageTitle'] = Yii::t('user', 'Users');
$this->params['pageSmallTitle'] = Yii::t('user', 'create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-reorder"></i><?= Html::encode($this->title); ?>
        </div>
    </div>
    <div class="portlet-body form">
        <?=
        $this->render('_form', [
            'model' => $model,
            'roleList' => $roleList,
            'statusList' => $statusList,
            'stateList' => $stateList,
        ])
        ?>
    </div>
</div>

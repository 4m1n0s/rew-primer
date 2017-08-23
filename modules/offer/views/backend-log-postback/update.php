<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\offer\models\LogPostback */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Log Postback',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Log Postbacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="log-postback-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\offer\models\LogPostback */

$this->title = Yii::t('app', 'Create Log Postback');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Log Postbacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-postback-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

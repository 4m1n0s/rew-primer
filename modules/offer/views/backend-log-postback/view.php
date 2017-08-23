<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\offer\models\LogPostback */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Log Postbacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-postback-view" style="overflow: scroll">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'level',
            'category',
            'offer_id',
            'prefix:ntext',
            'message:ntext',
            'log_vars:ntext',
            'log_time',
        ],
    ]) ?>

</div>

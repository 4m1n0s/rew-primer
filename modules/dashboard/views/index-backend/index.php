<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */


$this->title = Yii::t('admin', 'Dashboard');
$this->params['pageTitle'] = $this->title;

?>

<h4>General statistic will be placed here</h4>

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <a class="dashboard-stat dashboard-stat-v2 blue" href="<?= \yii\helpers\Url::toRoute(['/user/index-backend/index'])?>">
        <div class="visual">
            <i class="fa fa-users"></i>
        </div>
        <div class="details">
            <div class="number">
                <span data-counter="counterup" data-value="<?= $countUsers ?>"><?= $countUsers ?></span>
            </div>
            <div class="desc">Users</div>
        </div>
    </a>
</div>

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <a class="dashboard-stat dashboard-stat-v2 blue" href="<?= \yii\helpers\Url::toRoute(['/settings/index-backend/index'])?>">
        <div class="visual">
            <i class="fa fa-gear"></i>
        </div>
        <div class="details">
            <div class="number">

            </div>
            <div class="desc">Settings</div>
        </div>
    </a>
</div>

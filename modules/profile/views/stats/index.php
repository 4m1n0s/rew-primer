<?php

/* @var \yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Stats';
?>

<div class="row">
    <div class="pricing-table">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="plan">
                <div class="plan-header">
                    <h4>Total "Bucks"</h4>
                    <p class="text-muted">Short description</p>
                    <div class="plan-price"><?php echo Yii::$app->user->identity->virtual_currency ?></div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="plan">
                <div class="plan-header">
                    <h4>Total $$</h4>
                    <p class="text-muted">Short description</p>
                    <div class="plan-price"><sup>$</sup><?php echo Yii::$app->user->identity->getExchangedCurrency() ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
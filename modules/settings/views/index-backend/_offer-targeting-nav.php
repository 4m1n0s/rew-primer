<?php
\yii\bootstrap\NavBar::begin();
echo \yii\bootstrap\Nav::widget([
    'items' => [
        ['label' => 'Countries', 'url' => ['/settings/index-backend/offer-targeting-countries']],
        ['label' => 'Devices', 'url' => ['/settings/index-backend/offer-targeting-devices']],
    ],
    'options' => ['class' => 'navbar-nav'],
]);
\yii\bootstrap\NavBar::end();
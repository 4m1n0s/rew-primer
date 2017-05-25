<?php

namespace app\modules\profile\controllers;

class StatsController extends ProfileController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
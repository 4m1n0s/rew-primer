<?php

namespace app\modules\catalog\controllers;

use app\modules\core\components\controllers\FrontController;
use yii\helpers\Json;

class CartController extends FrontController
{
    public function actionView()
    {
        return $this->render('view');
    }

    public function actionAdd()
    {
        var_dump(\Yii::$app->request->post());
    }
}

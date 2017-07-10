<?php

namespace app\modules\catalog\controllers;

use app\modules\catalog\models\Product;
use app\modules\core\components\controllers\FrontController;
use yii\helpers\Json;

class CartController extends FrontController
{
    public function actionView()
    {
        return $this->render('view', [
            'positions' => \Yii::$app->cart->getPositions(),
            'totalCost' => \Yii::$app->cart->getCost()
        ]);
    }

    public function actionAdd()
    {
        $product = Product::find()->where(['id' => \Yii::$app->request->post('pk')])->one();

        if (!$product) {
            return false;
        }

        \Yii::$app->cart->put($product, \Yii::$app->request->post('qty'));
        return Json::encode(['data' => ['cartCount' => \Yii::$app->cart->getCount()]]);
    }
}

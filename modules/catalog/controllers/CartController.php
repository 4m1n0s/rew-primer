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
            'totalCost' => \Yii::$app->cart->getCost(),
            'totalCount' => \Yii::$app->cart->getCount()
        ]);
    }

    public function actionAdd()
    {
        $product = Product::find()->where(['id' => \Yii::$app->request->post('pk')])->one();

        if (!$product) {
            return false;
        }

        \Yii::$app->cart->put($product, \Yii::$app->request->post('qty'));

        if (\Yii::$app->request->isAjax) {
            return Json::encode(['data' => ['cartCount' => \Yii::$app->cart->getCount()]]);
        }

        return $this->redirect(['/catalog/cart/view']);
    }

    public function actionUpdate($id, $qty = 0)
    {

    }

    public function actionRemove($id)
    {
        if (\Yii::$app->cart->hasPosition($id)) {
            \Yii::$app->cart->removeById($id);
        }

        return $this->render('view', [
            'positions' => \Yii::$app->cart->getPositions(),
            'totalCost' => \Yii::$app->cart->getCost(),
            'totalCount' => \Yii::$app->cart->getCount()
        ]);
    }
}

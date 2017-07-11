<?php

namespace app\modules\catalog\controllers;

use app\modules\catalog\models\Product;
use app\modules\core\components\controllers\FrontController;
use app\modules\core\traits\AjaxResponseTrait;
use yii\helpers\Json;

class CartController extends FrontController
{
    use AjaxResponseTrait;

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

    public function actionUpdateQty()
    {
        if (!\Yii::$app->request->isAjax) {
            return false;
        }

        $id = \Yii::$app->request->post('id');
        $qty= \Yii::$app->request->post('qty');

        $product = Product::find()->where(['id' => $id])->one();

        if (\Yii::$app->cart->hasPosition($id) && $product) {
            \Yii::$app->cart->update($product, $qty);
        }

        return $this->renderAjax('_cart', [
            'positions' => \Yii::$app->cart->getPositions(),
            'totalCost' => \Yii::$app->cart->getCost(),
            'totalCount' => \Yii::$app->cart->getCount()
        ]);
    }

    public function actionRemove()
    {
        if (!\Yii::$app->request->isAjax) {
            return false;
        }

        $id = \Yii::$app->request->post('id');

        if (\Yii::$app->cart->hasPosition($id)) {
            \Yii::$app->cart->removeById($id);
        }

        return $this->renderAjax('_cart', [
            'positions' => \Yii::$app->cart->getPositions(),
            'totalCost' => \Yii::$app->cart->getCost(),
            'totalCount' => \Yii::$app->cart->getCount()
        ]);
    }

    public function actionData()
    {
        if (!\Yii::$app->request->isAjax) {
            return false;
        }

        return $this->sendAjaxResponse(1, '', [
            'count' => \Yii::$app->cart->getCount()
        ]);
    }
}

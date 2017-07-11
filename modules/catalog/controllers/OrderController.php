<?php

namespace app\modules\catalog\controllers;

use app\modules\catalog\models\Order;
use app\modules\catalog\models\RefProductOrder;
use app\modules\core\components\controllers\FrontController;
use app\modules\core\components\VirtualCurrency;
use Yii;
use yii\base\ErrorException;
use yii\base\InvalidValueException;

class OrderController extends FrontController
{
    public function actionCheckout()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/account/login']);
        }

        if (Yii::$app->cart->isEmpty) {
            return $this->redirect(['/catalog/catalog/index']);
        }

        $transaction = Yii::$app->db->beginTransaction();

        try {
            $virtualCurrency = \Yii::$app->virtualCurrency;
            $virtualCurrency->setUser(Yii::$app->user->identity);

            $order = new Order();
            $order->user_id = Yii::$app->user->identity->id;
            $order->status = Order::STATUS_PROCESSING;
            if (!$order->save()) {
                throw new ErrorException('Could not save order');
            }

            foreach (Yii::$app->cart->getPositions() as $product) {
                $productOrderModel = new RefProductOrder();
                $productOrderModel->order_id = $order->id;
                $productOrderModel->product_id = $product->id;
                $productOrderModel->quantity = $product->getQuantity();
                if (!$productOrderModel->save()) {
                    throw new ErrorException('Could not save order');
                }
            }

            if (!$virtualCurrency->debiting(Yii::$app->cart->getCost())) {
                throw new ErrorException('Funds cannot be charged');
            }

            $transaction->commit();
            Yii::$app->cart->removeAll();
            Yii::$app->session->setFlash('success', 'Your order is processed. We will email you shortly');
            return $this->redirect(['/catalog/catalog/index']);

        } catch (InvalidValueException $e) {
            switch ($e->getCode()) {
                case VirtualCurrency::ERROR_CODE_MIN_REDEEM:
                    $message = 'Minimum funds to redeem shall not be less than ' . Yii::$app->keyStorage->get('redeem.minLimit');
                    break;
                case VirtualCurrency::ERROR_CODE_MAX_REDEEM:
                    $message = 'Your limit is exceeded';
                    break;
                case VirtualCurrency::ERROR_CODE_INSUFFICIENT_FUNDS:
                    $message = 'Insufficient funds';
                    break;
                default:
                    $message = 'Unexpected error occurred. Please contact us!';
            }
            Yii::$app->session->setFlash('error', $message);
        } catch (\ErrorException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        $transaction->rollBack();
        return $this->redirect(['/catalog/cart/view']);
    }
}

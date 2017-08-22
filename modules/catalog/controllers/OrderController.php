<?php

namespace app\modules\catalog\controllers;

use app\modules\catalog\models\Order;
use app\modules\catalog\models\RefProductOrder;
use app\modules\core\components\controllers\FrontController;
use app\modules\core\components\VirtualCurrency;
use app\modules\core\components\VirtualCurrencyExchanger;
use app\modules\core\models\EmailTemplate;
use app\modules\core\models\Transaction;
use app\modules\user\models\User;
use Yii;
use yii\base\ErrorException;
use yii\base\InvalidValueException;
use yii\helpers\ArrayHelper;

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
        $currentUser = Yii::$app->getUser()->getIdentity();
        /* @var User $currentUser */

        try {
            $cartTotalCost = Yii::$app->cart->getCost();

            // Init Order
            $order = new Order();
            $order->user_id = $currentUser->getId();
            $order->status = Order::STATUS_PROCESSING;
            $order->cost = $cartTotalCost;
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

            // Init Transaction
            Yii::$app->transactionCreator->redeem(
                Transaction::STATUS_COMPLETED,
                $cartTotalCost,
                $currentUser,
                Yii::$app->ipNormalizer->getIP()
            );

            $keyStorage = Yii::$app->keyStorage;
            $virtualCurrency = new VirtualCurrency($currentUser);
            $virtualCurrency->redemptionMaxLimit = $keyStorage->get('redeem.maxLimit');
            $virtualCurrency->redemptionMinLimit = $keyStorage->get('redeem.minLimit');
            $virtualCurrency->redemptionResetHours = $keyStorage->get('redeem.reset');
            $virtualCurrency->debiting($cartTotalCost);

            // Notify user of new order
            Yii::$app->mailContainer->addToQueue(
                $currentUser->email,
                EmailTemplate::TEMPLATE_ORDER_NEW, [
                'username' => $currentUser->username,
                'order_id' => $order->id,
                'order_products' => implode(', ', $order->getFormattedProducts())
            ]);

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
        } catch (\Exception $e) {
            Yii::error('Order create exception' . PHP_EOL . $e->getMessage(), 'transaction');
            Yii::$app->session->setFlash('error', 'Could not create the order');
        }
        $transaction->rollBack();
        return $this->redirect(['/catalog/cart/view']);
    }
}

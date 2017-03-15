<?php

namespace app\modules\subscriber\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\subscriber\models\Subscribers;
use app\modules\subscriber\widgets\subscribeform\SubscribeFormWidget;
use yii\web\NotFoundHttpException;

/**
 * Class AjaxController
 *
 * @author Stableflow
 */
class AjaxController extends Controller {

    public function actionSubscribe() {
        if (Yii::$app->request->isAjax) {
            $model = new Subscribers([
                'status' => Subscribers::STATUS_ACTIVE
            ]);

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->save();
                Yii::$app->session->setFlash('subscribe-success', Yii::t('app', 'You have subscribed to the mailing list'));
            } else {
                $errors = $model->getErrors();
                if (isset($errors['email']) && is_array($errors['email'])) {
                    Yii::$app->session->setFlash('subscribe-error', array_shift($errors['email']));
                }
            }

            return SubscribeFormWidget::widget();
        }

        throw new NotFoundHttpException();
    }

}

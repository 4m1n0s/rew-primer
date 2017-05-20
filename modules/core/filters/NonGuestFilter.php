<?php

namespace app\modules\core\filters;

use yii\base\ActionFilter;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class NonGuestFilter extends ActionFilter
{
    public function beforeAction($action)
    {
        if (!\Yii::$app->user->isGuest) {
            return \Yii::$app->response->redirect('/');
        }

        return parent::beforeAction($action);
    }
}
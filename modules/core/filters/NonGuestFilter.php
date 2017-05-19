<?php

namespace app\modules\core\filters;

use yii\base\ActionFilter;
use yii\web\NotFoundHttpException;

class NonGuestFilter extends ActionFilter
{
    public function beforeAction($action)
    {
        if (!\Yii::$app->user->isGuest) {
            throw new NotFoundHttpException();
        }

        return parent::beforeAction($action);
    }
}
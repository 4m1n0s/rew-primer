<?php

namespace app\modules\profile\controllers;

use app\modules\core\components\controllers\FrontController;
use app\modules\user\models\User;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use \Yii;

/**
 * Class IndexController
 */
class ProfileController extends FrontController
{
    public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['USER', 'admin', 'MOBILE_USER'],
                    ],
                ],
            ],
        ]);
    }

    /**
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionAccount()
    {
        if (null === $userData = User::findOne(Yii::$app->user->id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('account', [

        ]);
    }
}
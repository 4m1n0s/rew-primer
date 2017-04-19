<?php

namespace app\modules\profile\controllers;

use app\modules\core\components\controllers\FrontController;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
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
}
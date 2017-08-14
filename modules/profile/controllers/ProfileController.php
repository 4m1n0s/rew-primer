<?php

namespace app\modules\profile\controllers;

use app\modules\core\components\controllers\FrontController;
use app\modules\core\filters\LayoutFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use \Yii;

/**
 * Class IndexController
 */
class ProfileController extends FrontController
{
    public function behaviors()
    {
        return ArrayHelper::merge([
            'layoutFilter' => LayoutFilter::class,
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['USER', 'admin'],
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['profile/index', 'profile/stats', 'profile/referral'],
                        'roles' => ['PARTNER'],
                    ],
                ],
            ],
        ], parent::behaviors());
    }
}
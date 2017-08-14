<?php

namespace app\modules\core\components\controllers;

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * Class FrontController
 *
 * @author Stableflow
 */
class FrontController extends Controller
{
    public $layout = '//frontend/main';

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'controllers' => ['contact/index', 'catalog/catalog'],
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['catalog/cart', 'catalog/order'],
                        'roles' => ['USER', 'admin'],
                    ],
                ],
            ]
        ]);

    }
}

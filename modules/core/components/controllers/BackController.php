<?php

namespace app\modules\core\components\controllers;

use app\modules\core\filters\LayoutFilter;
use yii\filters\AccessControl;

/**
 * Class BackController
 *
 * @author Stableflow
 */
class BackController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'layoutFilter' => [
                'class' => LayoutFilter::className(),
                'actions' => [
                    'index' => '//backend/default-index',
                    'view' => '//backend/default-index',
                    'create' => '//backend/default-form',
                    'update' => '//backend/default-form',
                ],
                'baseLayout' => '//backend/main'
            ]
        ];
    }
    
}

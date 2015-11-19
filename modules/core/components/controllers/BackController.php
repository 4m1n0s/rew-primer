<?php

namespace app\modules\core\components\controllers;

use yii\filters\AccessControl;

use app\modules\core\components\controllers\Controller;

/**
 * Class BackController
 *
 * @author Stableflow
 */
class BackController extends Controller {
    
    public $layout = '//backend/main';
    
    public function behaviors() {
        
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
        ];
    }
    
}

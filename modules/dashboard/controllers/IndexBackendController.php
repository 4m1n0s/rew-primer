<?php

namespace app\modules\dashboard\controllers;

use app\modules\core\components\controllers\BackController;
use app\modules\user\models\User;

class IndexBackendController extends BackController
{
    public $layout = '//backend/main';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['layoutFilter']);
        return $behaviors;
    }

    public function actionIndex() {

        $countUsers = User::find()->count();
        $countUsers = (int)$countUsers - 1;

        return $this->render('index', [
            'countUsers' => $countUsers
        ]);
    }

}

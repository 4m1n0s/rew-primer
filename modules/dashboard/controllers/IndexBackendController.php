<?php

namespace app\modules\dashboard\controllers;

use app\modules\core\components\controllers\BackController;

class IndexBackendController extends BackController {

    public function actionIndex() {
        return $this->render('index');
    }

}

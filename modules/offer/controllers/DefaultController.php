<?php

namespace app\modules\offer\controllers;

use app\modules\core\components\controllers\FrontController;

/**
 * Default controller for the `offer` module
 */
class DefaultController extends FrontController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}

<?php

namespace app\modules\profile\controllers;

use \Yii;

/**
 * Class IndexController
 */
class IndexController extends ProfileController
{
    /**
     * @return string|\yii\web\Response
     */
    public function actionAccount()
    {

        return $this->render('account', [

        ]);
    }
}
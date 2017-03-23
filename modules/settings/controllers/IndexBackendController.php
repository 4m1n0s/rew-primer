<?php

namespace app\modules\settings\controllers;

use app\modules\core\components\controllers\BackController;
use app\modules\settings\forms\SettingForm;

/**
 * Default controller for the `settings` module
 */
class IndexBackendController extends BackController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new SettingForm();
        $model->getAllSettings();

        $post = \Yii::$app->request->post();

        if ($post && $model->load($post) && $model->validate()) {
            $model->saveSettings();
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }
}

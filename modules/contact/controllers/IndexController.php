<?php

namespace app\modules\contact\controllers;

use app\modules\contact\models\Contact;
use app\modules\core\components\controllers\FrontController;

class IndexController extends FrontController
{
    public function actionIndex()
    {
        $model = new Contact;
        $model->setScenario(Contact::SCENARIO_MAIN);

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($model->save(false)) {
                \Yii::$app->session->setFlash('success', 'Thank you, your message has been delivered. We will contact you shortly');
                return $this->refresh();
            }
            \Yii::$app->session->setFlash('error', 'Unexpected error occurred. Please contact us for more details');
        }
        
        return $this->render('contact-form', [
            'model' => $model
        ]);
    }
}
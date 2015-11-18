<?php

namespace app\modules\user\controllers\account;

use Yii;
use yii\base\Action;
use app\modules\user\forms\RecoveryForm;

/**
 * Class RecoveryRequestAction
 *
 * @author Stableflow
 */
class RecoveryRequestAction extends Action {

    public $layout;

    public function run() {
        if (Yii::$app->user->isGuest) {
            $form = Yii::createObject([
                        'class' => RecoveryForm::className(),
                        'scenario' => RecoveryForm::REQUEST_SCENARIO,
            ]);
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                if (Yii::$app->userManager->passwordRecovery($form->email)) {
                    return $this->controller->redirect(['/user/account/login']);
                }
                Yii::$app->session->setFlash('error', Yii::t('user', 'Password recovery error.'));
                $this->getController()->redirect(['/user/account/recovery']);
            } else {
                if (!empty($this->layout)) {
                    $this->controller->layout = $this->layout;
                }
                return $this->controller->render($this->id, [
                            'model' => $form
                ]);
            }
        }
        return $this->controller->redirect(Yii::$app->user->returnUrl);
    }

}

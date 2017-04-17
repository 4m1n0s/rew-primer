<?php

namespace app\modules\user\controllers\account;

use app\modules\invitation\models\Invitation;
use Yii;
use yii\base\Action;
use app\modules\user\forms\RegistrationForm;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * Class RegisterAction
 *
 * @author Stableflow
 */
class RegisterAction extends Action
{
    public $layout;
    public $returnUrl;

    public function run($code = null)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->controller->redirect(Yii::$app->user->returnUrl);
        }

        $keyStorage = Yii::$app->get('keyStorage');
        $inviteSignup = $keyStorage->get('invite_only_signup');

        if ($inviteSignup && is_null($code)) {
            $this->controller->redirect(['invitation-request']);
        }

        // TODO handle repeated form sending with same inv code
        if (!is_null($code) && (!$inviteSignup || !Invitation::find()->code($code)->status(Invitation::STATUS_APPROVED)->exists())) {
            throw new NotFoundHttpException();
        }

        $form = new RegistrationForm([
            'scenario' => ($inviteSignup && !is_null($code)) ? RegistrationForm::INVITATION_SCENARIO : RegistrationForm::SIGNUP_SCENARIO
        ]);

        if ($inviteSignup) {
            $form->invitationCode = $code;
        }

        $post = Yii::$app->request->post();

        if ($form->load($post) && $form->validate()) {

            if ($user = Yii::$app->userManager->createUser($form)) {
                Yii::$app->session->setFlash('success', Yii::t('user', 'Account was created! Check your email!'));
                return $this->controller->redirect('/');
            }

            Yii::$app->session->setFlash('error', Yii::t('user', 'Error creating account!'));
        }

        return $this->controller->render('sign-up', [
            'model' => $form,
            'inviteSignup' => $inviteSignup
        ]);

    }

}

<?php

namespace app\modules\invitation\actions;

use app\components\MandrillMailer;
use app\models\EmailTemplate;
use app\modules\user\forms\RegistrationForm;
use Yii;
use yii\base\Action;
use app\modules\invitation\models\Invitation;

/**
 * Class InvitionRequestAction
 *
 * @author Stableflow
 */
class InvitationRequestAction extends Action
{
    public function run()
    {
        $keyStorage = Yii::$app->get('keyStorage');
        $inviteSignup = $keyStorage->get('invite_only_signup');

        if (!$inviteSignup) {
            return $this->controller->redirect(['/user/account/sign-up']);
        }

        $invitation = new Invitation([
            'scenario' => Invitation::INVITATION_REQUEST_SCENARIO
        ]);

        $form = new RegistrationForm([
            'scenario' => RegistrationForm::SCENARIO_INVITATION_REQUEST
        ]);

        $post = Yii::$app->request->post();

        if ($form->load($post) && $form->validate() && $invitation->load($post, 'RegistrationForm') && $invitation->validate()) {

            $invitation->status = Invitation::STATUS_NEW;

            if (!$invitation->save()) {
                Yii::$app->session->setFlash('error', 'Unexpected error occurred');
            }

            $mandrill = Yii::$app->get('mandrillMailer');
            /* @var MandrillMailer $mandrill */
            $mandrill->addToQueue(
                $invitation->email,
                EmailTemplate::TEMPLATE_INVITATION_REQUEST_RECEIVED
            );

            Yii::$app->session->setFlash('success', 'Invitation code has been sent to your email!');
            return $this->controller->refresh();
        }

        return $this->controller->render('invitation-request', [
            'model' => $form
        ]);
    }

}

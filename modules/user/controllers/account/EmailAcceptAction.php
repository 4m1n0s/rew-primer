<?php

namespace app\modules\user\controllers\account;

use app\modules\invitation\models\Invitation;
use app\modules\user\components\TokenStorage;
use app\modules\user\models\Referral;
use app\modules\user\models\Token;
use Yii;
use yii\base\Action;
use app\modules\user\forms\RegistrationForm;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * Class EmailAcceptAction
 *
 * @author Stableflow
 */
class EmailAcceptAction extends Action
{
    public $layout;
    public $returnUrl;

    public function run($token = null)
    {
        if (!$tokenModel = (new TokenStorage())->get($token, Token::TYPE_OAUTH_TEMP_USER, Token::STATUS_NEW)) {
            throw new NotFoundHttpException();
        }

        $form = new RegistrationForm([
            'scenario' => RegistrationForm::OAUTH_SCENARIO
        ]);

        $post = Yii::$app->request->post();
        $form->getDefaultReferralCode();
        $user = $tokenModel->user;
        $auth = $user->authSocial;

        if ($form->load($post) && $form->validate()) {

            $form->first_name = $user->first_name;
            $form->last_name = $user->last_name;
            $form->externalID = $auth->external_id;
            $form->clientID = $auth->client_id;

            if ($user = Yii::$app->userManager->createUser($form)) {
                $tokenModel->delete();
                Yii::$app->session->setFlash('success', Yii::t('user', 'Account was created! Check your email!'));
                return $this->controller->redirect('/');
            }

            Yii::$app->session->setFlash('error', Yii::t('user', 'Error creating account!'));
        }

        if (!empty($this->layout)) {
            $this->controller->layout = $this->layout;
        }

        return $this->controller->render('email-accept', [
            'model' => $form,
        ]);
    }

}

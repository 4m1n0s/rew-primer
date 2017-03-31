<?php

namespace app\modules\user\controllers\account;

use Yii;
use yii\base\Action;
//use app\modules\setting\helpers\SettingHelper;
use app\modules\user\forms\RegistrationForm;

/**
 * Class RegisterAction
 *
 * @author Stableflow
 */
class RegisterAction extends Action {

    public $layout;
    public $returnUrl;

    public function run($code = null) {

        $form = new RegistrationForm([
            'scenario' => RegistrationForm::SIGNUP_SCENARIO
        ]);
//
//        if ((null !== $data = SettingHelper::getOption('app-signup')) && isset($data['invite_only']) && (bool) $data['invite_only'] === true) {
//            $form->invitationCode = $code;
//        }
//        $className = explode('\\', $form::className());
//        $className = end($className);
        $post = Yii::$app->request->post();
//
//        if ((null !== $data = SettingHelper::getOption('app-signup')) && isset($data['invite_only']) && (bool) $data['invite_only'] === true) {
//            if (!isset($post[$className]['email'])) {
//                $form->scenario = RegistrationForm::INVITATION_SCENARIO;
//                if ($form->load(Yii::$app->request->post()) && $form->validate()) {
//                    $form->scenario = RegistrationForm::SIGNUP_SCENARIO;
//                    $isValidInvite = true;
//                } else {
//                    return $this->controller->render('invite', [
//                                'model' => $form
//                    ]);
//                }
//            }
//        }

//        $post = Yii::$app->request->post();
        
        $cookies = Yii::$app->request->cookies;
        $form->referralCode = $cookies->getValue('referralCode', null);
        
        if ($form->load($post) && $form->validate()) {

            if ($user = Yii::$app->userManager->createUser($form)) {

                Yii::$app->session->setFlash('success', Yii::t('user', 'Account was created! Check your email!'));

                return $this->controller->goBack();
            }

            Yii::$app->session->setFlash('error', Yii::t('user', 'Error creating account!'));
        }

        return $this->controller->render($this->id, [
            'model' => $form
        ]);

    }

}

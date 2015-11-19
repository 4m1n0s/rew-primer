<?php

namespace app\modules\user\components;

use \Yii;
use \app\modules\user\models\User;
use \app\modules\user\forms\LoginForm;
use \app\modules\user\events\UserEvents;
use \app\modules\user\events\UserLoginEvent;
use \app\modules\user\events\UserLogoutEvent;

/**
 * Class AuthenticationManager
 *
 * @author Stableflow
 */
class AuthenticationManager extends \yii\base\Component {

    public function logout(\yii\web\User $user) {
        \Yii::$app->eventManager->fire(UserEvents::BEFORE_LOGOUT, new UserLogoutEvent($user));
        $user->logout();
        \Yii::$app->eventManager->fire(UserEvents::AFTER_LOGOUT, new UserLogoutEvent($user));

        return true;
    }

    public function login(LoginForm $form, \yii\web\User $user, $request = null) {
        if ($form->hasErrors()) {
            Yii::$app->eventManager->fire(UserEvents::FAILURE_LOGIN, new UserLoginEvent($form, $user));
            return false;
        }
        $identity = new User();
        $identity = $identity->findUserByUsernameOrEmail($form->username);
        if (null !== $identity) {
            switch ($identity->status) {
                case User::STATUS_BLOCKED:
                    $form->addError('email', Yii::t('user', 'Your account was blocked.'));
                    return false;
                    break;
                case User::STATUS_PENDING:
                    $form->addError('email', Yii::t('user', 'Please activate your account.'));
                    return false;
                    break;
                case User::STATUS_APPROVED:
                    Yii::$app->eventManager->fire(UserEvents::BEFORE_LOGIN, new UserLoginEvent($form, $user, $identity));
                    Yii::$app->getUser()->login($identity, $form->rememberMe ? strtotime('+ 1 year', time()) - time() : 0);
                    Yii::$app->eventManager->fire(UserEvents::SUCCESS_LOGIN, new UserLoginEvent($form, $user, $identity));
                    return true;
                    break;
            }
        } else {
            $form->addError('email', Yii::t('user', 'The username and password you entered did not match our records. Please double-check and try again.'));
            Yii::$app->eventManager->fire(UserEvents::FAILURE_LOGIN, new UserLoginEvent($form, $user));
        }
        return false;
    }

}

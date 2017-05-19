<?php

namespace app\modules\user\components;

use app\modules\core\components\EventManager;
use app\modules\user\models\AuthSocial;
use \Yii;
use \app\modules\user\forms\RegistrationForm;
use \app\modules\user\models\User;
use \app\modules\user\helpers\Password;
use \app\modules\user\events\UserEvents;
use \app\modules\user\events\UserRegistrationEvent;
use \app\modules\user\components\TokenStorage;
use \app\modules\user\events\UserPasswordRecoveryEvent;
use \app\modules\user\events\UserPasswordRecoveryResetEvent;
use \app\modules\user\models\Token;
use \app\modules\user\models\Referral;
use \app\modules\user\events\UserActivateEvent;
use yii\base\ErrorException;
use yii\base\Exception;

/**
 * Class UserManager
 *
 * @author Stableflow
 */
class UserManager extends \yii\base\Component
{
    /**
     * @var TokenStorage
     */
    protected $tokenStorage;

    public function init()
    {
        parent::init();
        $this->tokenStorage = Yii::createObject('app\modules\user\components\TokenStorage');
    }

    public function setTokenStorage(TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function getTokenStorage()
    {
        return $this->tokenStorage;
    }

    /**
     * Register new user
     *
     * @param RegistrationForm $form
     * @return User
     */
    public function createUser(RegistrationForm $form)
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $user = new User();
            $user->scenario = ($form->getScenario() == RegistrationForm::OAUTH_SCENARIO) ? User::SCENARIO_REGISTER_OAUTH : User::SCENARIO_REGISTER;
            $data = $form->getAttributes();
            $user->setAttributes($data);
            $user->role = User::ROLE_USER;
            $user->status = User::STATUS_PENDING;

            if ($user->save() && ($token = $this->tokenStorage->createAccountActivationToken($user)) !== false) {
                if (!empty($form->referralCode)) {
                    if (null !== $sourceUser = User::getUserByReferralCode($form->referralCode)) {
                        Referral::linkReferral($sourceUser, $user);
                    }
                }

                if ($form->getScenario() == RegistrationForm::OAUTH_SCENARIO) {
                    $auth = AuthSocial::find()->with(['user'])->where([
                        'client_id' => $form->clientID,
                        'external_id' => $form->externalID,
                    ])->one();

                    if (!$auth || !$auth->save()) {
                        throw new Exception('Auth');
                    }
                }

                Yii::$app->eventManager->fire(
                    UserEvents::SUCCESS_REGISTRATION, new UserRegistrationEvent($form, $user, $token)
                );
                $transaction->commit();
                return $user;
            }

            throw new Exception(Yii::t('user', 'Error creating account!'));
        } catch (Exception $e) {
            Yii::$app->eventManager->fire(
                UserEvents::FAILURE_REGISTRATION, new UserRegistrationEvent($form, $user)
            );
            return false;
        }
    }

    public function createTempUser(RegistrationForm $form)
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $user = new User();
            $user->scenario = User::SCENARIO_TEMP_OAUTH;
            $data = $form->getAttributes();
            $user->setAttributes($data);
            $user->role = User::ROLE_USER;
            $user->status = User::STATUS_PENDING;

            if (!$user->save()) {
                throw new Exception('Could not save user');
            }

            $auth = new AuthSocial([
                'user_id' => $user->id,
                'client_id' => $form->clientID,
                'external_id' => $form->externalID,
            ]);

            if (!$auth->save()) {
                throw new Exception('Could not save auth');
            }

            $transaction->commit();
            $token = (new TokenStorage)->createOauthTempUserToken($user, null);

            return $token;
        } catch (\Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }

    /**
     * Activation user
     *
     * @param string $token
     * @return boolean
     */
    public function activateUser($token)
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $tokenModel = $this->tokenStorage->get($token, Token::TYPE_ACTIVATE);

            if (null === $tokenModel) {
                Yii::$app->eventManager->fire(UserEvents::FAILURE_ACTIVATE_ACCOUNT, new UserActivateEvent($token));
                return false;
            }

            $userModel = User::findOne($tokenModel->user_id);

            if (null === $userModel) {
                Yii::$app->eventManager->fire(UserEvents::FAILURE_ACTIVATE_ACCOUNT, new UserActivateEvent($tokenModel));
                return false;
            }

            $userModel->status = User::STATUS_APPROVED;

            if ($this->tokenStorage->activate($tokenModel) && $userModel->save()) {
                Yii::$app->eventManager->fire(UserEvents::SUCCESS_ACTIVATE_ACCOUNT, new UserActivateEvent($tokenModel, $userModel));
                $transaction->commit();
                return true;
            }

            throw new Exception(Yii::t(
                'user', 'There was a problem with the activation of the account. Please refer to the site\'s administration.'
            ));
        } catch (Exception $exc) {
            $transaction->rollBack();
            Yii::$app->eventManager->fire(UserEvents::FAILURE_ACTIVATE_ACCOUNT, new UserActivateEvent($token));
            return false;
        }
    }

    /**
     * Create recovery token
     *
     * @param $email
     * @return bool
     * @throws ErrorException
     * @throws \yii\db\Exception
     */
    public function passwordRecovery($email)
    {
        Yii::$app->eventManager->fire(UserEvents::BEFORE_PASSWORD_RECOVERY, new UserPasswordRecoveryEvent($email));

        if (!$email) {
            return false;
        }

        $user = new User();
        $user = $user->findUserByEmail($email);

        if (null === $user) {
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();

        try {
            if (($token = $this->tokenStorage->createPasswordRecoveryToken($user)) !== false) {
                Yii::$app->eventManager->fire(
                    UserEvents::SUCCESS_PASSWORD_RECOVERY, new UserPasswordRecoveryEvent($email, $user, $token)
                );
                $transaction->commit();
                return true;
            }

            throw new ErrorException(Yii::t('user', 'Password recovery error.'));
        } catch (Exception $e) {
            $transaction->rollBack();
            Yii::$app->eventManager->fire(
                UserEvents::FAILURE_PASSWORD_RECOVERY, new UserPasswordRecoveryEvent($email, $user)
            );
            return false;
        }
    }

    /**
     * Reset user password
     *
     * @param string $token Description
     * @param string $password Description
     * @return boolean
     */
    public function resetPassword($token, $password)
    {
        Yii::$app->eventManager->fire(UserEvents::BEFORE_PASSWORD_RESET, new UserPasswordRecoveryResetEvent($token, $password));
        $tokenModel = $this->tokenStorage->get($token, Token::TYPE_CHANGE_PASSWORD);

        if (null === $tokenModel) {
            Yii::$app->eventManager->fire(
                UserEvents::FAILURE_PASSWORD_RESET, new UserPasswordRecoveryResetEvent($token)
            );
            return false;
        }

        $userModel = User::find()->where('status NOT IN (:status) AND id = :user_id', [':status' => implode(',', [User::STATUS_BLOCKED, User::STATUS_PENDING]), ':user_id' => $tokenModel->user_id])->one();
        /* @var User $userModel */

        if (null === $userModel) {
            Yii::$app->eventManager->fire(
                UserEvents::FAILURE_PASSWORD_RESET, new UserPasswordRecoveryResetEvent($token)
            );
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();

        try {
            if ($this->changeUserPassword($userModel, $password) && $this->tokenStorage->activate($tokenModel)) {
                Yii::$app->eventManager->fire(
                    UserEvents::SUCCESS_PASSWORD_RESET, new UserPasswordRecoveryResetEvent($token, $password, $userModel)
                );
                $transaction->commit();
                return true;
            }

            throw new Exception(Yii::t('user', 'Error generating new password!'));
        } catch (Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }

    /**
     * Change reset password
     *
     * @param User $user
     * @param string $password
     * @return boolean
     */
    protected function changeUserPassword(User $user, $password)
    {
        $user->password = Password::hash($password);

        if ($user->status === User::STATUS_TRANSFER) {
            $user->status = User::STATUS_APPROVED;
        }

        return $user->save(false);
    }

}

<?php

namespace app\modules\user\components;

use app\modules\user\forms\LoginForm;
use app\modules\user\forms\RegistrationForm;
use app\modules\user\models\AuthSocial;
use app\modules\user\models\Token;
use app\modules\user\models\User;
use yii\authclient\ClientInterface;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * AuthHandler handles successful authentication via Yii auth component
 */
class AuthHandler
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function handle()
    {
        if (!Yii::$app->user->isGuest) {
            return false;
        }

        $clientID = AuthSocial::getClientID($this->client);
        $userAttributes = $this->getUserAttributes($clientID);

        $auth = AuthSocial::find()->with(['user.token'])->where([
            'client_id' => $clientID,
            'external_id' => $userAttributes->externalID,
        ])->one();

        if ($auth) { // login
            $user = $auth->user;
            $oauthTempUserToken = (new TokenStorage())->getUserToken($user, Token::TYPE_OAUTH_TEMP_USER, Token::STATUS_NEW);

            if ($oauthTempUserToken) {
                return Yii::$app->response->redirect(['/user/account/email-accept', 'token' => $oauthTempUserToken->code]);
            }

            $form = new LoginForm();
            $form->username = $user->email;
            $form->setUser($user);
            Yii::$app->authenticationManager->login($form, Yii::$app->getUser());
        } else { // signup
            $form = new RegistrationForm();
            $form->scenario = RegistrationForm::OAUTH_SCENARIO;
            $form->getDefaultReferralCode();
            $form->first_name = $userAttributes->firstName;
            $form->last_name = $userAttributes->lastName;
            $form->email = $userAttributes->email;
            $form->externalID = $userAttributes->externalID;
            $form->clientID = $clientID;

            if ($token = Yii::$app->userManager->createTempUser($form)) {
                return Yii::$app->response->redirect(['/user/account/email-accept', 'token' => $token->code]);
            }
        }
    }

    public function getUserAttributes($clientID)
    {
        $data = new \stdClass();
        $attributes = $this->client->getUserAttributes();

        switch ($clientID) {
            case AuthSocial::CLIENT_ID_FACEBOOK:
                $data->externalID   = ArrayHelper::getValue($attributes, 'id');
                $data->email        = ArrayHelper::getValue($attributes, 'email');
                $data->firstName    = ArrayHelper::getValue($attributes, 'first_name');
                $data->lastName     = ArrayHelper::getValue($attributes, 'last_name');
                break;
            case AuthSocial::CLIENT_ID_TWITTER:
                $data->externalID   = ArrayHelper::getValue($attributes, 'id');
                $data->email        = ArrayHelper::getValue($attributes, 'email');
                $data->firstName    = ArrayHelper::getValue($attributes, 'first_name');
                $data->lastName     = ArrayHelper::getValue($attributes, 'last_name');
                break;
            case AuthSocial::CLIENT_ID_GOOGLE:
                $data->externalID   = ArrayHelper::getValue($attributes, 'id');
                $data->email        = ArrayHelper::getValue($attributes, 'email');
                $data->firstName    = ArrayHelper::getValue($attributes, 'first_name');
                $data->lastName     = ArrayHelper::getValue($attributes, 'last_name');
                break;
        }

        return $data;
    }
}

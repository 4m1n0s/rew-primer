<?php

namespace modules\user\components;

use app\modules\user\forms\RegistrationForm;
use app\modules\user\helpers\Password;
use app\modules\user\models\AuthSocial;
use app\modules\user\models\Token;
use app\modules\user\models\User;
use app\modules\user\models\UserMeta;
use app\tests\fixtures\TokenFixture;
use app\tests\fixtures\UserFixture;
use yii\codeception\DbTestCase;
use yii\i18n\I18N;


/**
 * @property UserFixture $user
 * @property UserFixture $token
 */
class UserManagerTest extends DbTestCase
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected $user_namespace = 'app\modules\user\models\User';
    protected $token_namespace = 'app\modules\user\models\Token';


    protected function _before()
    {
        AuthSocial::deleteAll();
        UserMeta::deleteAll();

        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
            'token' => [
                'class' => TokenFixture::className(),
                'dataFile' => codecept_data_dir() . 'token.php'
            ],
        ]);

        \Yii::configure(\Yii::$app, [
            'components' => [
                'userManager' => [
                    'class' => 'app\modules\user\components\UserManager'
                ],
                'authenticationManager' => [
                    'class' => '\app\modules\user\components\AuthenticationManager'
                ],
                'eventManager' => [
                    'class' => 'app\modules\core\components\EventManager',
                ],
                'i18n' => [
                    'class' => I18N::className(),
                    'translations' => [
                        'admin' => [
                            'class' => 'yii\i18n\PhpMessageSource',
                            'fileMap' => [
                                'admin*' => 'admin.php',
                            ],
                        ],
                        'user*' => [
                            'class' => 'yii\i18n\PhpMessageSource',
                            'basePath' => __DIR__ . '/modules/user/messages',
                            'fileMap' => [
                                'user*' => 'user.php',
                            ],
                        ]
                    ],
                ],
            ],
        ]);
    }

    public function testCreateUser()
    {
        $form = new RegistrationForm([
            'username' => 'test_create_name',
            'email' => 'test@email.com',
            'password' => 'test_password',
        ]);

        $this->assertInstanceOf($this->user_namespace, $user = \Yii::$app->userManager->createUser($form), 'User is not create');
        $this->tester->seeRecord($this->user_namespace, [
            'email' => $user->email,
            'username' => $user->username,
            'password' => $user->password
        ]);

        $this->tester->seeRecord($this->token_namespace, ['user_id' => $user->getId(), 'type' => Token::TYPE_ACTIVATE]);
    }

    public function testCreateUserTemp()
    {
        $form = new RegistrationForm([
            'first_name' => 'test_temp_name',
            'last_name' => 'last_name',
            'email' => 'test_temp_name@email.com',
            'externalID' => '123456',
            'clientID' => '1'
        ]);
        $this->assertInstanceOf($this->user_namespace, $user = \Yii::$app->userManager->createTempUser($form), 'User create has error');
    }

    public function testActivateUser()
    {
        $token = $this->tester->grabFixture('token')['activate_token'];
        $user = $this->tester->grabFixture('user')['test_name'];

        $this->assertTrue(\Yii::$app->userManager->activateUser($token['code']), 'User was not activated');
        $this->tester->seeRecord($this->user_namespace, ['id' => $user['id'], 'status' => User::STATUS_APPROVED]);
    }

    public function testRecoveryResetPassword()
    {
        $email = 'test-email@virtual.box';
        $new_password = 'new_password';

        $this->assertInstanceOf($this->token_namespace, $token = \Yii::$app->userManager->passwordRecovery($email));
        $this->tester->seeRecord($this->token_namespace, ['code' => $token->code, 'type' => Token::TYPE_CHANGE_PASSWORD]);
        $this->assertTrue(\Yii::$app->userManager->resetPassword($token->code, $new_password), 'Reset password invalid');

        $user = User::findOne(['email' => $email]);
        $this->assertTrue(Password::validate($new_password, $user->password), 'Passwords are not same');
    }

}

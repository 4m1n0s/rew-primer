<?php
/**
 * Yii bootstrap file.
 * Used for enhanced IDE code autocompletion.
 * Note: To avoid "Multiple Implementations" PHPStorm warning and make autocomplete faster
 * exclude or "Mark as Plain Text" vendor/yiisoft/yii2/Yii.php file
 */
class Yii extends \yii\BaseYii
{
    /**
     * @var BaseApplication|WebApplication|ConsoleApplication the application instance
     */
    public static $app;
}
/**
 * Class BaseApplication
 * Used for properties that are identical for both WebApplication and ConsoleApplication
 *
 * @property \app\components\MandrillMailer $mandrillMailer
 * @property \app\modules\settings\components\KeyStorage $keyStorage
 * @property \himiklab\yii2\recaptcha\ReCaptcha $reCaptcha
 * @property \app\modules\core\components\geolocation\Location $geoLocation
 * @property \app\modules\user\components\UserManager $userManager
 * @property \app\modules\user\components\AuthenticationManager $authenticationManager
 */
abstract class BaseApplication extends yii\base\Application
{
}
/**
 * Class WebApplication
 * Include only Web application related components here
 *
 * @property User $user User component.
 */
class WebApplication extends yii\web\Application
{
}
/**
 * Class ConsoleApplication
 * Include only Console application related components here
 */
class ConsoleApplication extends yii\console\Application
{
}
/**
 * User component
 * Include only Web application related components here
 *
 * @property \app\modules\user\models\User|\yii\web\IdentityInterface|null $identity The identity object associated with the currently logged-in user. null is returned if the user is not logged in (not authenticated).
 */
class User extends \yii\web\User
{
}
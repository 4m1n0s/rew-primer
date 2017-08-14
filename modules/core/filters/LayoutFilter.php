<?php

namespace app\modules\core\filters;

use app\modules\user\models\User;
use yii\base\ActionFilter;

class LayoutFilter extends ActionFilter
{
    /**
     * @var string $baseLayout
     */
    public $baseLayout;

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (\Yii::$app->getUser()->getIsGuest()) {
            return false;
        }

        $user = \Yii::$app->getUser()->getIdentity();
        /* @var User $user */

        switch ($user->role) {
            case User::ROLE_ADMIN:
            case User::ROLE_USER:
            case User::ROLE_MOBILE_USER:
                $action->controller->layout = '//frontend/profile';
                break;
            case User::ROLE_PARTNER:
                $action->controller->layout = '//frontend/profile-partner';
                break;
            default:
                $action->controller->layout = '//frontend/main';
        }

        return true;
    }
}

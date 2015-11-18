<?php

namespace app\modules\user\events;

use yii\base\Event;

/**
 * Class UserLogoutEvent
 *
 * @author Stableflow
 */
class UserLogoutEvent extends Event {

    protected $user;

    public function __construct(\yii\web\User $user = null) {
        $this->user = $user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user) {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser() {
        return $this->user;
    }

}

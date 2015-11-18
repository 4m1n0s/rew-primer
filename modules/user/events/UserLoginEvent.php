<?php

namespace app\modules\user\events;

use yii\base\Event;

/**
 * Class UserLoginEvent
 *
 * @author Stableflow
 */
class UserLoginEvent extends Event {

    /**
     * @var LoginForm;
     */
    protected $loginForm;
    protected $user;
    protected $identity;

    public function __construct(\app\modules\user\forms\LoginForm $loginForm, \yii\web\User $user, \app\modules\user\models\User $identity = null) {
        $this->identity = $identity;
        $this->loginForm = $loginForm;
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
    
    /**
     * @param mixed $identity
     */
    public function setIdentity($identity){
        $this->identity = $identity;
    }
    
    /**
     * @return mixed
     */
    public function getIdentity(){
        return $this->identity;
    }
    
    /**
     * @param mixed $loginForm
     */
    public function setLoginForm($loginForm) {
        $this->loginForm = $loginForm;
    }

    /**
     * @return mixed
     */
    public function getLoginForm() {
        return $this->loginForm;
    }

}

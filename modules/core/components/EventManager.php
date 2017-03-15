<?php

namespace app\modules\core\components;

/**
 * Class EventManager
 *
 * @author Stableflow
 */
class EventManager extends \yii\base\Component {

    /**
     * @var array
     */
    public $events = [];

    public function init() {
        foreach ($this->events as $event => $listeners) {
            if(!\Yii::$app->hasEventHandlers($event)){
                \Yii::$app->on($event, $listeners);
            }
        }
        parent::init();
    }

    /**
     * Trigger event
     * 
     * @param $eventName
     * @param \yii\base\Event $event
     */
    public function fire($eventName, \yii\base\Event $event) {
        $this->init();
        \Yii::$app->trigger($eventName, $event);
    }

}

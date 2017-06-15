<?php

namespace app\modules\core\components;

use yii\base\Component;
use yii\base\Event;

/**
 * Class EventManager
 *
 * @author Stableflow
 */
class EventManager extends Component
{
    /**
     * @var array
     */
    protected $events = [];

    /**
     * Trigger event
     * 
     * @param $eventName
     * @param Event $event
     */
    public function fire($eventName, Event $event)
    {
        \Yii::$app->trigger($eventName, $event);
    }

    /**
     * @param string $name
     * @param callable $handler
     */
    public function attachEvent($name, $handler)
    {
        $this->events[$name] = $handler;
        \Yii::$app->on($name, $handler);
    }

    /**
     * @param string $name
     * @param null $handler
     */
    public function detachEvent($name, $handler = null)
    {
        unset($this->events[$name]);
        \Yii::$app->off($name, $handler);
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasEvent($name)
    {
        return array_key_exists($name, $this->events);
    }

    /**
     * @return array
     */
    public function getEvents()
    {
        return $this->events;
    }
}

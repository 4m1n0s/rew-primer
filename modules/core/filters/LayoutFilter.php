<?php

namespace app\modules\core\filters;

use yii\base\ActionFilter;
use yii\base\InvalidConfigException;

class LayoutFilter extends ActionFilter
{
    /**
     * @var array $actions
     */
    public $actions;

    /**
     * @var string $baseLayout
     */
    public $baseLayout;

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (!is_array($this->actions)) {
            throw new InvalidConfigException('Expected parameter array, ' . gettype($this->actions) . ' given.');
        }

        $action->controller->layout = $this->baseLayout;

        foreach ($this->actions as $actionName => $layout) {
            if ($actionName == $action->id) {
                $action->controller->layout = $layout;
            }
        }

        return true;
    }
}

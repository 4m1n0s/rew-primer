<?php

namespace app\modules\offer\controllers\offerwalls;

use yii\base\Action;

/**
 * Class Pollfish
 * @package app\modules\offer\controllers\actions
 */
class Pollfish extends Action
{
    /**
     * @var string
     */
    public $view;

    public function run()
    {
        return $this->controller->render($this->view);
    }
}
<?php

namespace app\modules\offer\controllers\offerwalls;

use yii\base\Action;

/**
 * Class Ptcwall
 * @package app\modules\offer\controllers\actions
 */
class Ptcwall extends Action
{
    /**
     * @var string
     */
    public $view;

    public function run()
    {
        $offerUrl = 'http://www.ptcwall.com/index.php?view=ptcwall&pubid={site_id}&usrid={username}'; // TODO: Store it somewhere else
        $replace = [
            '{site_id}' => '45swi56i8nj08b9z19',
            '{username}' => \Yii::$app->user->identity->username,
        ];
        $offerFrameUrl = strtr($offerUrl, $replace);

        return $this->controller->render($this->view, [
            'offerFrameUrl' => $offerFrameUrl
        ]);
    }
}
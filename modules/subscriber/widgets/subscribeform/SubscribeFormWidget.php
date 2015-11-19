<?php

namespace app\modules\subscriber\widgets\subscribeform;

use Yii;
use yii\base\Widget;
use app\modules\subscriber\models\Subscribers;

/**
 * Class SubscribeForm
 *
 * @author Stableflow
 */
class SubscribeFormWidget extends Widget {
    public function init() {
        parent::init();
    }

    public function run() {
        parent::run();
        $model = new Subscribers();
        
        return $this->render('form', [
            'model' => $model
        ]);
    }

}

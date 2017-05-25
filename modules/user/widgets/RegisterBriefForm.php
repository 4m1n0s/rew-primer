<?php

namespace app\modules\user\widgets;

use app\modules\user\forms\RegistrationForm;
use yii\base\Widget;

class RegisterBriefForm extends Widget
{
    public function run()
    {
        $form = new RegistrationForm([
            'scenario' => RegistrationForm::SCENARIO_SIGNUP,
        ]);

        return $this->render('register-brief-form', [
            'model' => $form
        ]);
    }
}
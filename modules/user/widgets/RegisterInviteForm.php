<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 27.07.17
 * Time: 11:53
 */

namespace app\modules\user\widgets;


use app\modules\user\forms\RegistrationForm;
use yii\base\Widget;

class RegisterInviteForm extends Widget
{
    public function run()
    {
        $form = new RegistrationForm([
            'scenario' => RegistrationForm::SCENARIO_INVITATION_REQUEST,
        ]);

        return $this->render('register-invite-form', [
            'model' => $form
        ]);
    }
}
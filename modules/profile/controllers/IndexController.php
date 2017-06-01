<?php

namespace app\modules\profile\controllers;

use app\modules\user\forms\RegistrationForm;
use app\modules\user\helpers\Password;
use app\modules\user\models\User;
use \Yii;

/**
 * Class IndexController
 */
class IndexController extends ProfileController
{
    /**
     * @return string
     */
    public function actionAccount()
    {
        /* @var User $currentUser */
        $currentUser = Yii::$app->user->identity;

        return $this->render('account', [
            'currentUser' => $currentUser
        ]);
    }

    public function actionLoginForm()
    {
        /* @var User $currentUser */
        $currentUser = Yii::$app->user->identity;

        $model = new RegistrationForm([
            'scenario' => RegistrationForm::SCENARIO_UPDATE_LOGIN,
            'username' => $currentUser->username,
            'email' => $currentUser->email,
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $currentUser->setScenario(User::SCENARIO_UPDATE_LOGIN);
            $currentUser->username = $model->username;
            $currentUser->email = $model->email;

            if ($currentUser->save()) {
                Yii::$app->session->setFlash('success', 'Your profile has been updated');
            } else {
                Yii::$app->session->setFlash('error', 'Could not update profile');
            }

            return $this->redirect(['/profile/index/account']);
        }

        if (Yii::$app->request->isPjax || Yii::$app->request->isAjax) {
            return $this->renderAjax('_form-login-info', [
                'currentUser' => $currentUser,
                'model' => $model
            ]);
        }

        return $this->render('_form-login-info', [
            'currentUser' => $currentUser,
            'model' => $model
        ]);
    }

    public function actionPasswordForm()
    {
        /* @var User $currentUser */
        $currentUser = Yii::$app->user->identity;

        $model = new RegistrationForm([
            'scenario' => RegistrationForm::SCENARIO_UPDATE_PASSWORD,
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $currentUser->setScenario(User::SCENARIO_UPDATE_PASSWORD);
            $currentUser->password = Password::hash($model->password);

            if ($currentUser->save()) {
                Yii::$app->session->setFlash('success', 'Your profile has been updated');
            } else {
                Yii::$app->session->setFlash('error', 'Could not update profile');
            }

            return $this->redirect(['/profile/index/account']);
        }

        if (Yii::$app->request->isPjax || Yii::$app->request->isAjax) {
            return $this->renderAjax('_form-password', [
                'currentUser' => $currentUser,
                'model' => $model
            ]);
        }

        return $this->render('_form-password', [
            'currentUser' => $currentUser,
            'model' => $model
        ]);
    }

    public function actionPersonalForm()
    {
        /* @var User $currentUser */
        $currentUser = Yii::$app->user->identity;

        $model = new RegistrationForm([
            'scenario' => RegistrationForm::SCENARIO_UPDATE_PERSONAL_INFO,
            'first_name' => $currentUser->first_name,
            'last_name' => $currentUser->last_name,
            'birthday' => $currentUser->birthday,
            'gender' => $currentUser->gender
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $currentUser->setScenario(User::SCENARIO_UPDATE_PERSONAL);
            $currentUser->first_name = $model->first_name;
            $currentUser->last_name = $model->last_name;
            $currentUser->birthday = $model->birthday;
            $currentUser->gender = $model->gender;

            if ($currentUser->save()) {
                Yii::$app->session->setFlash('success', 'Your profile has been updated');
            } else {
                Yii::$app->session->setFlash('error', 'Could not update profile');
            }

            return $this->redirect(['/profile/index/account']);
        }

        if (Yii::$app->request->isPjax || Yii::$app->request->isAjax) {
            return $this->renderAjax('_form-personal', [
                'currentUser' => $currentUser,
                'model' => $model
            ]);
        }

        return $this->render('_form-personal', [
            'currentUser' => $currentUser,
            'model' => $model
        ]);
    }
}
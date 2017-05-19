<?php

namespace app\modules\profile\controllers;

use app\modules\profile\forms\ProfileForm;
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
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(['/profile/index/account']);
        }

        /* @var User $currentUser */
        $currentUser = Yii::$app->user->identity;

        $model = new ProfileForm([
            'scenario' => ProfileForm::SCENARIO_CHANGE_LOGIN,
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

        return $this->renderAjax('_form-login-info', [
            'currentUser' => $currentUser,
            'model' => $model
        ]);
    }

    public function actionPasswordForm()
    {
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(['/profile/index/account']);
        }

        /* @var User $currentUser */
        $currentUser = Yii::$app->user->identity;

        $model = new ProfileForm([
            'scenario' => ProfileForm::SCENARIO_CHANGE_PASSWORD,
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $currentUser->setScenario(User::SCENARIO_UPDATE_PASSWORD);
            $currentUser->password = Password::hash($model->newPassword);

            if ($currentUser->save()) {
                Yii::$app->session->setFlash('success', 'Your profile has been updated');
            } else {
                Yii::$app->session->setFlash('error', 'Could not update profile');
            }

            return $this->redirect(['/profile/index/account']);
        }

        return $this->renderAjax('_form-password', [
            'currentUser' => $currentUser,
            'model' => $model
        ]);
    }

    public function actionPersonalForm()
    {
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(['/profile/index/account']);
        }

        /* @var User $currentUser */
        $currentUser = Yii::$app->user->identity;

        $model = new ProfileForm([
            'scenario' => ProfileForm::SCENARIO_CHANGE_PERSONAL_INFO,
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

        return $this->renderAjax('_form-personal', [
            'currentUser' => $currentUser,
            'model' => $model
        ]);
    }
}
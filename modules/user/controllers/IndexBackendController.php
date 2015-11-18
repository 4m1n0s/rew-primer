<?php

namespace app\modules\user\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

use app\modules\core\components\controllers\BackController;
use app\modules\user\models\User;
use app\modules\user\forms\ProfileForm;
use app\modules\user\models\UserMeta;
use app\modules\video\helpers\FileUploaderHelper;

/**
 * Class IndexBackendController
 *
 * @author Stableflow
 * 
 */
class IndexBackendController extends BackController {

    public function behaviors() {
        return \yii\helpers\ArrayHelper::merge(parent::behaviors(), [
        ]);
    }

    public function actionProfile() {

        if (($user = User::findOne(/* Yii::$app->user->id */ 1)) === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model = new ProfileForm([
            'phone' => $user->phone,
            'lastName' => $user->lastName,
            'firstName' => $user->firstName,
            'about' => $user->about,
            'interests' => $user->interests,
        ]);
        $post = Yii::$app->request->post();
        if($post !== null && ($model->load($post) || isset($_FILES['ProfileForm']))){
            if(isset($post['ProfileForm']['firstName'])){
                $model->scenario = ProfileForm::SCENARIO_CHANGE_PERSONAL_INFO;
            }elseif(isset($post['ProfileForm']['currentPassword'])){
                $model->scenario = ProfileForm::SCENARIO_CHANGE_PASSWORD;
            }else{
                $model->scenario = ProfileForm::SCENARIO_CHANGE_AVATAR;
                $model->fileAvatar = UploadedFile::getInstance($model, 'fileAvatar');
            }
            
            if($model->validate()){
                switch ($model->scenario){
                    case ProfileForm::SCENARIO_CHANGE_PASSWORD:
                        break;
                    case ProfileForm::SCENARIO_CHANGE_PERSONAL_INFO:
                        UserMeta::updateUserMeta($user->id, 'phone', $model->phone);
                        UserMeta::updateUserMeta($user->id, 'last_name', $model->lastName);
                        UserMeta::updateUserMeta($user->id, 'first_name', $model->firstName);
                        UserMeta::updateUserMeta($user->id, 'about', $model->about);
                        UserMeta::updateUserMeta($user->id, 'interests', $model->interests);
                        break;
                    case ProfileForm::SCENARIO_CHANGE_AVATAR:
                        if ($model->fileAvatar instanceof UploadedFile) {
                            $basePath = Yii::getAlias('@webroot');
                            if (null !== $user->avatar && file_exists($basePath . $user->avatar)) {
                                unlink($basePath . $user->avatar);
                            }

                            if(null !== $avatar = FileUploaderHelper::saveImage($model->fileAvatar, 'avatar')){
                                UserMeta::updateUserMeta($user->id, 'avatar', $avatar);
                            }
                        }
                        break;
                }
                
                return $this->redirect(['profile']);
            }
        }
        
        
        
        return $this->render('profile', [
                    'model' => $model,
                    'user' => $user
        ]);
    }

}

<?php

namespace app\modules\user\controllers;

use app\modules\catalog\models\search\OrderSearch;
use app\modules\core\components\VirtualCurrency;
use app\modules\core\models\search\TransactionSearch;
use app\modules\core\models\Transaction;
use app\modules\user\forms\BackUsersForm;
use app\modules\user\forms\RedeemForm;
use app\modules\user\helpers\Password;
use app\modules\user\models\UsersSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

use app\modules\core\components\controllers\BackController;
use app\modules\user\models\User;
use app\modules\user\forms\ProfileForm;
use app\modules\user\models\UserMeta;
use app\modules\core\helpers\FileUploaderHelper;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * Class IndexBackendController
 *
 * @author Stableflow
 * 
 */
class IndexBackendController extends BackController
{
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'user-to-blacklist' => ['POST'],
                ],
            ],
            'layoutFilter' => [
                'actions' => [
                    'index' => '//backend/default-grid',
                    'create' => '//backend/default-form',
                    'update' => '//backend/default-form',
                    'orders' => '//backend/default-grid',
                    'offers' => '//backend/default-grid',
                    'referrals' => '//backend/default-grid',
                    'redeem' => '//backend/default-form',
                ],
            ]
        ]);
    }

    public function actionProfile() {

        if (($user = User::findOne(Yii::$app->user->id)) === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model = new ProfileForm([
            'phone' => $user->phone,
            'lastName' => $user->last_name,
            'firstName' => $user->first_name,
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
                        $user->newPassword = $model->newPassword;
                        $user->save();
                        break;
                    case ProfileForm::SCENARIO_CHANGE_PERSONAL_INFO:
                        UserMeta::updateUserMeta($user->id, 'phone', $model->phone);
                        $user->last_name = $model->lastName;
                        $user->first_name = $model->firstName;
                        $user->update();
//                        UserMeta::updateUserMeta($user->id, 'last_name', $model->lastName);
//                        UserMeta::updateUserMeta($user->id, 'first_name', $model->firstName);
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

    public function actionView($id)
    {
        if (($model = BackUsersForm::findOne($id)) === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $model
            ]);
        }

        return $this->render('view', [
            'model' => $model
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'statusList' => $searchModel->getStatusList(),
            'roleList' => $searchModel->getRoleList()
        ]);
    }

    public function actionUserToBlacklist() {
        if (Yii::$app->request->isAjax) {

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $id = Yii::$app->request->post('id');

            if (null === $user = User::findOne($id)) {
                return false;
            }

            if ($user->status != User::STATUS_BLACKLIST) {
                $status = User::STATUS_BLACKLIST;
            } else {
                $status = User::STATUS_APPROVED;
            }

            $user->setScenario(User::SCENARIO_UPDATE_STATUS);
            $user->status = $status;
            $user->update();

            return true;
        }
        return false;
    }

    public function actionUpdate($id)
    {
        if (($model = BackUsersForm::findOne($id)) === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model->referral_percents = isset($model->metaData->referral_percents) ? $model->metaData->referral_percents : null;
        $model->referral_register_value = isset($model->metaData->referral_register_value) ? $model->metaData->referral_register_value : null;

        if ($model->role == User::ROLE_PARTNER) {
            $model->scenario = BackUsersForm::EDIT_AFFILIATE_SCENARIO;
        } else {
            $model->scenario = BackUsersForm::EDIT_SCENARIO;
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->update(false) && $model->updateMetaData()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionCreate($role = null)
    {
        $model = new BackUsersForm();
        if ($role == User::ROLE_PARTNER) {
            $model->scenario = BackUsersForm::SIGNUP_AFFILIATE_SCENARIO;
            $model->role = User::ROLE_PARTNER;
        } else {
            $model->scenario = BackUsersForm::SIGNUP_SCENARIO;
        }

        if ($model->load($post = Yii::$app->request->post()) && $model->validate()) {
            $model->password = Password::hash($model->password);
            $model->referral_code = (empty($model->referral_code)) ? Yii::$app->security->generateRandomString(rand(8, 12)) : $model->referral_code;
            if ($model->save(false) && $model->updateMetaData()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        if (($model = BackUsersForm::findOne($id)) === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionOrders($id)
    {
        if (!$user = User::findIdentity($id)) {
            throw new NotFoundHttpException;
        }
        $searchModel = new OrderSearch();
        $params = \Yii::$app->request->queryParams;
        $params['OrderSearch']['user_id'] = $id;
        $dataProvider = $searchModel->search($params);
        
        return $this->render('orders', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'user' => $user
        ]);
    }

    public function actionOffers($id)
    {
        if (!$user = User::findIdentity($id)) {
            throw new NotFoundHttpException;
        }
        $searchModel = new TransactionSearch();
        $params = \Yii::$app->request->queryParams;
        $dataProvider = $searchModel->searchCompletion($params, $user);

        return $this->render('offers', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'user' => $user
        ]);
    }

    public function actionReferrals($id)
    {
        if (!$user = User::findIdentity($id)) {
            throw new NotFoundHttpException;
        }
        $searchModel = new TransactionSearch();
        $params = \Yii::$app->request->queryParams;
        $dataProvider = $searchModel->searchReferrals($params, $user);

        return $this->render('referrals', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'user' => $user
        ]);
    }

    public function actionRedeem($id)
    {
        if (!$user = User::findIdentity($id)) {
            throw new NotFoundHttpException;
        }

        $model = new RedeemForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                // Init Transaction
                Yii::$app->transactionCreator->redeem(
                    Transaction::STATUS_COMPLETED,
                    $model->amount,
                    $user,
                    Yii::$app->ipNormalizer->getIP(),
                    'custom redemption'
                );

                $virtualCurrency = new VirtualCurrency($user);
                $virtualCurrency->checkRedemptionCurrencyLimits = false;
                $virtualCurrency->checkRedemptionIPLimits = false;
                $virtualCurrency->debiting($model->amount);

                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Funds have been withdrawn from the account. Balance: ' . $user->virtual_currency);
                return $this->redirect(['redeem', 'id' => $id]);
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
                $transaction->rollBack();
            }
        }

        return $this->render('redeem', [
            'model' => $model,
            'user' => $user
        ]);
    }
}

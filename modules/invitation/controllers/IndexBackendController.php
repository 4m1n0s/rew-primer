<?php

namespace app\modules\invitation\controllers;

use Yii;
use app\modules\invitation\models\Invitation;
use app\modules\invitation\models\search\Invitation as InvitationSearch;
use app\modules\core\components\controllers\BackController;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InvitationController implements the CRUD actions for Invitation model.
 */
class IndexBackendController extends BackController
{
    /**
     * Lists all Invitation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InvitationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Invitation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Invitation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invitation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Approve request
     *
     * @return bool
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionApprove() {
        if (!Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException();
        }
        $model = $this->findModel(\Yii::$app->request->post('id'));
        return $model->approve();
    }

    /**
     * Deny request
     *
     * @return bool
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionDeny() {
        if (!Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException();
        }

        $model = $this->findModel(\Yii::$app->request->post('id'));
        return $model->deny();
    }

    /**
     * Request for bulk approve
     *
     * @return bool
     * @throws ForbiddenHttpException
     */
    public function actionApproveAll()
    {
        if (!Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException();
        }

        $collection = Invitation::find()->where(['in', 'id', (array)\Yii::$app->request->post('ids')])->all();

        foreach ($collection as $invitation) {
            $invitation->approve();
        }

        return true;
    }

    /**
     *  Request for bulk deny
     *
     * @return bool
     * @throws ForbiddenHttpException
     */
    public function actionDenyAll()
    {
        if (!Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException();
        }

        $collection = Invitation::find()->where(['in', 'id', (array)\Yii::$app->request->post('ids')])->all();

        foreach ($collection as $invitation) {
            $invitation->deny();
        }

        return true;
    }
}

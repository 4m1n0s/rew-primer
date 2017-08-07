<?php

namespace app\modules\contact\controllers;

use app\modules\core\models\EmailTemplate;
use app\modules\contact\form\Reply;
use Yii;
use app\modules\contact\models\Contact;
use app\modules\contact\models\search\ContactSearch;
use app\modules\core\components\controllers\BackController;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IndexBackendController implements the CRUD actions for Contact model.
 */
class IndexBackendController extends BackController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }

    /**
     * Lists all Contact models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contact model.
     * @param integer $id
     * @return mixed
     */
    public function actionReply($id)
    {
        $model = $this->findModel($id);
        $model->setScenario(Contact::SCENARIO_STATUS);
        $reply = new Reply();

        if ($model->status == Contact::STATUS_NEW) {
            $model->setStatus(Contact::STATUS_READ);
        }

        if ($reply->load(Yii::$app->request->post()) && $reply->validate()) {
            $mailContainer = Yii::$app->mailContainer;
            $sent = $mailContainer->addToQueue(
                $model->email,
                EmailTemplate::TEMPLATE_CONTACT_US,
                ['contact_reply_message' => $reply->message]
            );

            if ($sent) {
                $model->setStatus(Contact::STATUS_ANSWERED);
                Yii::$app->session->setFlash('success', 'Email has been sent');
                return $this->refresh();
            }

            Yii::$app->session->setFlash('error', 'Could not sent email');
        }

        return $this->render('view', [
            'model' => $model,
            'reply' => $reply
        ]);
    }

    /**
     * Deletes an existing Contact model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Contact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contact::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Request for bulk approve
     *
     * @return bool
     * @throws ForbiddenHttpException
     */
    public function actionReadAll()
    {
        if (!Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException();
        }

        $collection = Contact::find()->where(['in', 'id', (array)\Yii::$app->request->post('ids')])->all();

        foreach ($collection as $item) {
            if ($item->status == Contact::STATUS_NEW) {
                $item->setScenario(Contact::SCENARIO_STATUS);
                $item->setStatus(Contact::STATUS_READ);
            }
        }

        return true;
    }

    /**
     *  Request for bulk deny
     *
     * @return bool
     * @throws ForbiddenHttpException
     */
    public function actionDeleteAll()
    {
        if (!Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException();
        }

        $collection = Contact::find()->where(['in', 'id', (array)\Yii::$app->request->post('ids')])->all();

        foreach ($collection as $item) {
            $item->delete();
        }

        return true;
    }
}

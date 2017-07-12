<?php

namespace app\modules\catalog\controllers;

use Yii;
use app\modules\catalog\models\Order;
use app\modules\catalog\models\search\OrderSearch;
use app\modules\core\components\controllers\BackController;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BackendOrderController implements the CRUD actions for Order model.
 */
class BackendOrderController extends BackController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge([
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ], parent::behaviors());
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        if (($model = Order::find()->alias('o')->where(['o.id' => $id])->joinWith(['products'])->one()) === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCancel() {
        if (!Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException();
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $id = Yii::$app->request->post('id');

        if (!$order = Order::findOne($id)) {
            return false;
        }

        return $order->setStatusCanceled();
    }

    public function actionRestore() {
        if (!Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException();
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $id = Yii::$app->request->post('id');

        if (!$order = Order::findOne($id)) {
            return false;
        }

        return $order->setStatusProcessing();
    }

    public function actionProcessingAll()
    {
        if (!Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException();
        }

        $orders = Order::find()->where(['in', 'id', (array)\Yii::$app->request->post('ids')])->all();

        foreach ($orders as $order) {
            $order->setStatusProcessing();
        }

        return true;
    }

    public function actionCanceledAll()
    {
        if (!Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException();
        }

        $orders = Order::find()->where(['in', 'id', (array)\Yii::$app->request->post('ids')])->all();

        foreach ($orders as $order) {
            $order->setStatusCanceled();
        }

        return true;
    }
}

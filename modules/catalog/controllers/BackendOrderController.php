<?php

namespace app\modules\catalog\controllers;

use app\modules\catalog\forms\Import;
use Yii;
use app\modules\catalog\models\Order;
use app\modules\catalog\models\search\OrderSearch;
use app\modules\core\components\controllers\BackController;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $model,
            ]);
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

    public function actionExportAll()
    {
        $ids = explode(',', Yii::$app->request->post('ids'));
        set_time_limit(0);
        ini_set('memory_limit','-1');
        if (null !== $collection = Order::find()
                ->alias('o')
                ->joinWith(['products p'])
                ->where(['o.status' => Order::STATUS_PROCESSING])
                ->andWhere(['in', 'o.id', $ids])
                ->all()
        ) {
            $columns = array_keys(Order::getTableSchema()->columns);
            if (($key = array_search('note', $columns)) !== false) {
                unset($columns[$key]);
            }
            Yii::$app->export->export($collection, [
                'Order ID' => 'id',
                'User ID' => 'user_id',
                'Cost' => 'cost',
                'Product Names' => 'products:name',
                'Product Sku' => 'products:sku',
                'Product IDs' => 'refProductOrders:product_id',
                'Product Quantities'=> 'refProductOrders:quantity',
                'Note' => 'note'
            ])->download('orders_' . date('Y-m-d'));
            Yii::$app->end(200);
        }
    }

    public function actionImport()
    {
        set_time_limit(0);
        ini_set('memory_limit','-1');
        $model = new Import();
        $model->file = UploadedFile::getInstance($model, 'file');
        $orderIDIndex = 0;
        $orderNoteIndex = 6;

        if (!$model->validate()) {
            $errors = $model->getErrors('file');
            Yii::$app->session->setFlash('error', implode('<br />', $errors));
            return $this->redirect('index');
        }

        $file = new \SplFileObject($model->file->tempName);
        $data = [];
        while (!$file->eof()) {
            $row = $file->fgetcsv();
            if (!empty($row[0])) {
                array_push($data, $row);
            }
        }
        unset($data[0]);
        if ($orderModels = Order::find()->where(['id' => ArrayHelper::map($data, 0, 0)])->status(Order::STATUS_PROCESSING)->indexBy('id')->all()) {
            $exist = [];
            try {
                $transaction = Yii::$app->db->beginTransaction();
                foreach ($data as $fileRow) {
                    if (!isset($fileRow[$orderIDIndex])) {
                        continue;
                    }
                    $orderID = $fileRow[$orderIDIndex];
                    if (!array_key_exists($orderID, $orderModels)) {
                        continue;
                    }
                    $orderModel = $orderModels[$orderID];
                    if (empty($orderModel->note) && !empty($fileRow[$orderNoteIndex])) {
                        $orderModel->note = $fileRow[$orderNoteIndex];
                        if (!$orderModel->setStatusCompleted()) {
                            throw new ErrorException();
                        }
                    } else {
                        $exist[] = $orderModel->id;
                    }
                }

                if ($exist) {
                    Yii::$app->session->setFlash('error', 'Next orders ['.  implode(',', $exist).'] have already contain the note or have an empty note in file.');
                }
                Yii::$app->session->setFlash('success', 'Data updated successfully.');
                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Import error.');
            }
        } else {
            Yii::$app->session->setFlash('error', 'Orders in Processing not found.');
        }

        return $this->redirect(['index']);
    }
}

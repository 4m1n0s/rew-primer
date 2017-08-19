<?php

namespace app\modules\catalog\controllers;

use app\modules\catalog\models\RefProductGroupCategory;
use Yii;
use app\modules\catalog\models\ProductGroup;
use app\modules\catalog\models\search\ProductGroupSearch;
use app\modules\core\components\controllers\BackController;
use yii\base\ErrorException;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * BackendProductGroupController implements the CRUD actions for ProductGroup model.
 */
class BackendProductGroupController extends BackController
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
     * Lists all ProductGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductGroup model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductGroup();
        $model->categoriesBuff = ArrayHelper::getColumn($model->categories, 'id');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->categoriesBuff = ArrayHelper::getValue(Yii::$app->request->post(), 'ProductGroup.categoriesBuff');
            $transaction = Yii::$app->db->beginTransaction();

            try {
                if (!$model->save(false)) {
                    throw new ErrorException('Could not save the product');
                }
                foreach ($model->refProductGroupCategories as $refProductGroupCategory) {
                    $refProductGroupCategory->delete();
                }
                if (!empty($model->categoriesBuff)) {
                    foreach ($model->categoriesBuff as $categoryID) {
                        $productGroupCategoryRefModel = new RefProductGroupCategory();
                        $productGroupCategoryRefModel->category_id = $categoryID;
                        $productGroupCategoryRefModel->group_id = $model->id;
                        if (!$productGroupCategoryRefModel->save()) {
                            throw new ErrorException('Could not save categories');
                        }
                    }
                }

                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Product has been created');
                return $this->redirect(['index']);
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Could not save product');
            }

            Yii::$app->session->setFlash('error', 'Could not save ProductGroup');
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->categoriesBuff = ArrayHelper::getColumn($model->categories, 'id');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->categoriesBuff = ArrayHelper::getValue(Yii::$app->request->post(), 'ProductGroup.categoriesBuff');
            $transaction = Yii::$app->db->beginTransaction();

            try {
                if (!$model->save(false)) {
                    throw new ErrorException('Could not save the product');
                }
                foreach ($model->refProductGroupCategories as $refProductGroupCategory) {
                    $refProductGroupCategory->delete();
                }
                if (!empty($model->categoriesBuff)) {
                    foreach ($model->categoriesBuff as $categoryID) {
                        $productGroupCategoryRefModel = new RefProductGroupCategory();
                        $productGroupCategoryRefModel->category_id = $categoryID;
                        $productGroupCategoryRefModel->group_id = $model->id;
                        if (!$productGroupCategoryRefModel->save()) {
                            throw new ErrorException('Could not save categories');
                        }
                    }
                }

                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Product has been created');
                return $this->redirect(['index']);
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Could not save product');
            }

            Yii::$app->session->setFlash('error', 'Could not update ProductGroup');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductGroup model.
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
     * Finds the ProductGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDeleteAll()
    {
        if (!Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException();
        }

        $models = ProductGroup::find()->where(['in', 'id', (array)\Yii::$app->request->post('ids')])->all();

        foreach ($models as $model) {
            $model->delete();
        }

        return true;
    }
}

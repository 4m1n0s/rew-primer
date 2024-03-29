<?php

namespace app\modules\catalog\controllers;

use app\modules\catalog\models\CategoryProduct;
use app\modules\catalog\models\RefProductCategory;
use app\modules\catalog\models\RefProductGroup;
use Yii;
use app\modules\catalog\models\Product;
use app\modules\catalog\models\search\ProductSearch;
use app\modules\core\components\controllers\BackController;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BackendProductController implements the CRUD actions for Product model.
 */
class BackendProductController extends BackController
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $model
            ]);
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $categoryList = CategoryProduct::getList();
        $model->categoriesBuff = ArrayHelper::getColumn($model->categories, 'id');
        $model->groupsBuff = ArrayHelper::getColumn($model->groups, 'id');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->categoriesBuff = ArrayHelper::getValue(Yii::$app->request->post(), 'Product.categoriesBuff');
            $transaction = Yii::$app->db->beginTransaction();

            try {
                if (!$model->save(false)) {
                    throw new ErrorException('Could not save the product');
                }
                foreach ($model->refProductCategories as $productCategory) {
                    $productCategory->delete();
                }
                if (!empty($model->categoriesBuff)) {
                    foreach ($model->categoriesBuff as $categoryID) {
                        $productCategoryRefModel = new RefProductCategory();
                        $productCategoryRefModel->category_id = $categoryID;
                        $productCategoryRefModel->product_id = $model->id;
                        if (!$productCategoryRefModel->save()) {
                            throw new ErrorException('Could not save categories');
                        }
                    }
                }
                foreach ($model->refProductGroups as $productGroup) {
                    $productGroup->delete();
                }
                if (!empty($model->groupsBuff)) {
                    foreach ($model->groupsBuff as $groupID) {
                        $productCategoryRefModel = new RefProductGroup();
                        $productCategoryRefModel->group_id = $groupID;
                        $productCategoryRefModel->product_id = $model->id;
                        if (!$productCategoryRefModel->save()) {
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
        }

        return $this->render('create', [
            'model' => $model,
            'categoryList' => $categoryList
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categoryList = CategoryProduct::getList();
        $model->categoriesBuff = ArrayHelper::getColumn($model->categories, 'id');
        $model->groupsBuff = ArrayHelper::getColumn($model->groups, 'id');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->categoriesBuff = ArrayHelper::getValue(Yii::$app->request->post(), 'Product.categoriesBuff');
            $model->groupsBuff = ArrayHelper::getValue(Yii::$app->request->post(), 'Product.groupsBuff');
            $transaction = Yii::$app->db->beginTransaction();

            try {
                if (!$model->save(false)) {
                    throw new ErrorException('Could not save the product');
                }
                foreach ($model->refProductCategories as $productCategory) {
                    $productCategory->delete();
                }
                if (!empty($model->categoriesBuff)) {
                    foreach ($model->categoriesBuff as $categoryID) {
                        $productCategoryRefModel = new RefProductCategory();
                        $productCategoryRefModel->category_id = $categoryID;
                        $productCategoryRefModel->product_id = $model->id;
                        if (!$productCategoryRefModel->save()) {
                            throw new ErrorException('Could not save categories');
                        }
                    }
                }
                foreach ($model->refProductGroups as $productGroup) {
                    $productGroup->delete();
                }
                if (!empty($model->groupsBuff)) {
                    foreach ($model->groupsBuff as $groupID) {
                        $productGroupRefModel = new RefProductGroup();
                        $productGroupRefModel->group_id = $groupID;
                        $productGroupRefModel->product_id = $model->id;
                        if (!$productGroupRefModel->save()) {
                            throw new ErrorException('Could not save categories');
                        }
                    }
                }
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Product has been updated');
                return $this->redirect(['index']);
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Could not save product');
            }
        }

        return $this->render('update', [
            'model' => $model,
            'categoryList' => $categoryList
        ]);
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
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

        $models = Product::find()->where(['in', 'id', (array)\Yii::$app->request->post('ids')])->all();

        foreach ($models as $model) {
            $model->delete();
        }

        return true;
    }
}

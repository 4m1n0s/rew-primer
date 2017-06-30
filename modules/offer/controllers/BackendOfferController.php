<?php

namespace app\modules\offer\controllers;

use app\modules\core\components\controllers\BackController;
use app\modules\offer\models\Category;
use app\modules\offer\models\CategoryOffer;
use Yii;
use app\modules\offer\models\Offer;
use app\modules\offer\models\search\OfferSearch;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * BackendOfferController implements the CRUD actions for Offer model.
 */
class BackendOfferController extends BackController
{
    /**
     * Lists all Offer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OfferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Offer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categoryList = Category::getList();
        $model->categoriesBuff = ArrayHelper::getColumn($model->categories, 'id');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->uploadImage();
            $model->categoriesBuff = ArrayHelper::getValue(Yii::$app->request->post(), 'Offer.categoriesBuff');
            $transaction = Yii::$app->db->beginTransaction();

            try {
                foreach ($model->categoryOffers as $categoryOffer) {
                    $categoryOffer->delete();
                }
                if (!$model->save(false)) {
                    throw new ErrorException();
                }
                if (!empty($model->categoriesBuff)) {
                    foreach ($model->categoriesBuff as $categoryID) {
                        $categoryOfferModel = new CategoryOffer();
                        $categoryOfferModel->category_id = $categoryID;
                        $categoryOfferModel->offer_id = $model->id;
                        if (!$categoryOfferModel->save()) {
                            throw new ErrorException('category');
                        }
                    }
                }
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Offer has been updated');
                return $this->redirect(['index']);
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Could not save offer');
            }
        }

        return $this->render('update', [
            'model' => $model,
            'categoryList' => $categoryList
        ]);
    }

    /**
     * Finds the Offer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Offer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Offer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

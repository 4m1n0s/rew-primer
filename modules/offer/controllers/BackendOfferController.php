<?php

namespace app\modules\offer\controllers;

use app\modules\core\components\controllers\BackController;
use app\modules\core\models\GeoCountry;
use app\modules\offer\models\Category;
use app\modules\offer\models\CategoryOffer;
use app\modules\offer\models\OfferDeviceOs;
use app\modules\offer\models\OfferDeviceType;
use app\modules\offer\models\RefOfferCountry;
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
        $model          = $this->findModel($id);
        $categoryList   = Category::getList();
        $countriesList  = GeoCountry::getList();
        $deviceOsList   = OfferDeviceOs::getOSList();
        $deviceTypeList = OfferDeviceType::getDeviceTypeList();

        $model->categoriesBuff = ArrayHelper::getColumn($model->categories, 'id');
        $model->newCountries = ArrayHelper::getColumn($model->geoCountries, 'id');
        $model->newDeviceTypes = ArrayHelper::getColumn($model->deviceTypes, 'type');
        $model->newDeviceOs = ArrayHelper::getColumn($model->deviceOs, 'os');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->uploadImage();
            $model->categoriesBuff = ArrayHelper::getValue(Yii::$app->request->post(), 'Offer.categoriesBuff');
            $model->newCountries = ArrayHelper::getValue(Yii::$app->request->post(), 'Offer.newCountries');
            $model->newDeviceTypes = ArrayHelper::getValue(Yii::$app->request->post(), 'Offer.newDeviceTypes');
            $model->newDeviceOs = ArrayHelper::getValue(Yii::$app->request->post(), 'Offer.newDeviceOs');

            $transaction = Yii::$app->db->beginTransaction();
            try {
                foreach ($model->categoryOffers as $categoryOffer) {
                    $categoryOffer->delete();
                }
                foreach ($model->offerCountries as $relCountries) {
                    $relCountries->delete();
                }
                foreach ($model->deviceTypes as $relType) {
                    $relType->delete();
                }
                foreach ($model->deviceOs as $relOs) {
                    $relOs->delete();
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
                if (!empty($model->newCountries)) {
                    foreach ($model->newCountries as $countryID) {
                        $OfferCountryModel = new RefOfferCountry();
                        $OfferCountryModel->country_id = $countryID;
                        $OfferCountryModel->offer_id = $model->id;
                        if (!$OfferCountryModel->save()) {
                            throw new ErrorException('newCountries');
                        }
                    }
                }
                if (!empty($model->newDeviceTypes)) {
                    foreach ($model->newDeviceTypes as $type) {
                        $OfferDeviceTypeModel = new OfferDeviceType();
                        $OfferDeviceTypeModel->type = $type;
                        $OfferDeviceTypeModel->offer_id = $model->id;
                        if (!$OfferDeviceTypeModel->save()) {
                            throw new ErrorException('newCountries');
                        }
                    }
                }
                if (!empty($model->newDeviceOs)) {
                    foreach ($model->newDeviceOs as $os) {
                        $OfferDeviceOsModel = new OfferDeviceOs();
                        $OfferDeviceOsModel->os = $os;
                        $OfferDeviceOsModel->offer_id = $model->id;
                        if (!$OfferDeviceOsModel->save()) {
                            throw new ErrorException('newCountries');
                        }
                    }
                }

                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Offer has been updated');
                return $this->redirect(['index']);
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Could not save offer'. $e->getMessage());
            }
        }

        return $this->render('update', [
            'model' => $model,
            'categoryList' => $categoryList,
            'countriesList' => $countriesList,
            'deviceTypeList' => $deviceTypeList,
            'deviceOsList' => $deviceOsList
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

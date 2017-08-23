<?php

namespace app\modules\catalog\controllers;

use app\modules\catalog\models\CategoryProduct;
use app\modules\catalog\models\CategoryProductGroup;
use app\modules\catalog\models\Product;
use app\modules\catalog\models\ProductGroup;
use app\modules\catalog\models\search\ProductGroupSearch;
use app\modules\catalog\models\search\ProductSearch;
use app\modules\core\components\controllers\FrontController;
use Yii;
use yii\web\NotFoundHttpException;

class CatalogController extends FrontController
{
    public function actionIndex()
    {
        $searchModel = new ProductGroupSearch();
        $productGroupDataProvider = $searchModel->searchCatalog(Yii::$app->request->queryParams);
        $categories = CategoryProductGroup::find()
            ->alias('c')
            ->select(['c.id', 'c.name'])
            ->andWhere(['active' => 1])
            ->groupBy('c.id')
            ->asArray()
            ->all();

        return $this->render('index', [
            'categories' => $categories,
            'productGroupDataProvider' => $productGroupDataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionGroup($id)
    {
        $productGroup = ProductGroup::find()
            ->alias('g')
            ->joinWith(['products p' => function($q) {
                return $q->andWhere(['p.status' => 1]);
            }])
            ->where(['g.id' => $id])
            ->one();

        if (!$productGroup) {
            throw new NotFoundHttpException;
        }

        return $this->render('group', [
            'productGroup' => $productGroup
        ]);
    }
}

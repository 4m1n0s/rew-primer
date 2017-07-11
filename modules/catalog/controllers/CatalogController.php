<?php

namespace app\modules\catalog\controllers;

use app\modules\catalog\models\CategoryProduct;
use app\modules\catalog\models\Product;
use app\modules\catalog\models\search\ProductSearch;
use app\modules\core\components\controllers\FrontController;
use Yii;
use yii\web\NotFoundHttpException;

class CatalogController extends FrontController
{
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $productDataProvider = $searchModel->searchCatalog(Yii::$app->request->queryParams);
        $productsCount = Product::find()->alias('p')->joinWith(['categories'])->inStock()->groupBy('p.id')->count();
        $categories = CategoryProduct::find()
            ->alias('c')
            ->select(['c.id', 'c.name', 'count(pc.product_id) as count'])
            ->joinWith(['refProductCategories pc'])
            ->active()
            ->groupBy('c.id')
            ->asArray()
            ->all();

        return $this->render('index', [
            'categories' => $categories,
            'productDataProvider' => $productDataProvider,
            'productsCount' => $productsCount
        ]);
    }
    
    public function actionSingle($id)
    {
        $product = Product::find()->alias('p')->where(['p.id' => $id])->joinWith(['categories'])->inStock()->one();

        if (!$product) {
            throw new NotFoundHttpException;
        }

        return $this->render('single', [
            'product' => $product
        ]);
    }
}

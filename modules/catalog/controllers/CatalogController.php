<?php

namespace app\modules\catalog\controllers;

use app\modules\catalog\models\CategoryProduct;
use app\modules\core\components\controllers\FrontController;

class CatalogController extends FrontController
{
    public function actionIndex()
    {
        $products = [];
        $categories = CategoryProduct::find()
            ->alias('c')
            ->select(['c.id', 'c.name', 'count(pc.product_id) as count'])
            ->joinWith(['refProductCategories pc'])
            ->active()
            ->groupBy('c.id')
            ->asArray()
            ->all();

        return $this->render('index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
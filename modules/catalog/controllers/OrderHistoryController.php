<?php

namespace app\modules\catalog\controllers;

use app\modules\catalog\models\search\OrderSearch;
use app\modules\profile\controllers\ProfileController;

class OrderHistoryController extends ProfileController
{
    public function actionList()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

<?php

namespace app\modules\catalog\controllers;

use app\modules\catalog\models\search\OrderSearch;
use app\modules\profile\controllers\ProfileController;

class OrderHistoryController extends ProfileController
{
    public function actionList()
    {
        $searchModel = new OrderSearch();
        $params = \Yii::$app->request->queryParams;
        $params['OrderSearch']['user_id'] = \Yii::$app->user->getId();
        $dataProvider = $searchModel->search($params);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

<?php

namespace app\modules\profile\controllers;

use app\modules\core\models\Transaction;
use app\modules\core\models\search\TransactionSearch;
use Yii;

class StatsController extends ProfileController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCompletionHistory()
    {
        $searchModel = new TransactionSearch();
        $dataProvider = $searchModel->searchCompletion(
            Yii::$app->request->queryParams,
            Yii::$app->getUser()->getIdentity()
        );

        return $this->render('completion', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
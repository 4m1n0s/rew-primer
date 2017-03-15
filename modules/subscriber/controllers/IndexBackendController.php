<?php

namespace app\modules\subscriber\controllers;

use Yii;

use app\modules\core\components\controllers\BackController;
use app\modules\subscriber\models\Subscribers;
use app\modules\subscriber\models\SubscribersSearch;

class IndexBackendController extends BackController {

    public function actionIndex() {
        $searchModel = new SubscribersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Export all subscribers
     */
    public function actionExport(){
        ini_set('memory_limit','-1');
        if (null !== $collection = Subscribers::find()->asArray()->all()) {
            Yii::$app->export->export($collection, ['email', 'create_date'])->download('Subscribers_'.date('Y-m-d H:i:s'));
            Yii::$app->end(200);
        }
    }

}

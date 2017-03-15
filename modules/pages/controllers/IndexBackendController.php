<?php

namespace app\modules\pages\controllers;

use app\modules\pages\models\Pages;
use Yii;
use app\modules\core\components\controllers\BackController;
use app\modules\pages\forms\PagesMetaForm;
use app\modules\pages\models\PagesMeta;

class IndexBackendController extends BackController
{
    public function actionIndex()
    {
        $dataProvider = Pages::GridPages();

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionUpdate($id){

        if (($Page = Pages::find()->where(['id' => $id])->with('pagesMeta')->one()) === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $pagesMetaForm = new PagesMetaForm();

        switch ($Page->name){
            case Pages::HOME_PAGE['name'] :
                $pagesMetaForm->scenario = Pages::HOME_PAGE['name'];
                $pagesMetaForm->headerImage = $Page->headerImage;
                $pagesMetaForm->text = $Page->text;
                break;
            case Pages::ABOUT_US_PAGE['name'] :
                $pagesMetaForm->scenario = Pages::ABOUT_US_PAGE['name'];
                $pagesMetaForm->headerImage = $Page->headerImage;
                break;
            case Pages::ADVERTISE_PAGE['name'] :
                $pagesMetaForm->scenario = Pages::ADVERTISE_PAGE['name'];
                break;
        }

        $post = Yii::$app->request->post();

        if($post !== null && $pagesMetaForm->validate() && $pagesMetaForm->load($post)){
            if($pagesMetaForm->updatePage($Page)) {
                $this->redirect(['/pages/index-backend/index']);
            }
        }

        return $this->render('update', [
            'pagesMetaForm' => $pagesMetaForm,
            'scenario' => $pagesMetaForm->scenarios()[$Page->name]
        ]);

    }

}

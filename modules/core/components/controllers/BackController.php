<?php

namespace app\modules\core\components\controllers;

use app\modules\core\filters\BackendLayoutFilter;
use app\modules\dashboard\helpers\GridViewTemplateHelper;
use yii\filters\AccessControl;
use Yii;

/**
 * Class BackController
 *
 * @author Stableflow
 */
class BackController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'layoutFilter' => [
                'class' => BackendLayoutFilter::className(),
                'actions' => [
                    'index' => '//backend/default-grid',
                    'create' => '//backend/default-form',
                    'update' => '//backend/default-form',
                ],
                'baseLayout' => '//backend/main'
            ]
        ];
    }
    
    public function init()
    {
        parent::init();

        Yii::$container->set('yii\grid\GridView', [
            'tableOptions' => [
                'class' => 'table table-striped table-bordered table-hover'
            ],
            'headerRowOptions' => [
                'class' => 'heading'
            ],
            'pager' => [
                'firstPageLabel' => Yii::t('app', 'First'),
                'lastPageLabel' => Yii::t('app', 'Last'),
            ],
            'layout' => GridViewTemplateHelper::baseLayout(),
            'filterSelector' => 'select[name="per-page"]',
        ]);
        Yii::$container->set('yii\grid\ActionColumn', [
            'header' => Yii::t('app', 'Actions'),
            'headerOptions' => ['style' => 'min-width:110px;width:110px'],
            'buttons' => GridViewTemplateHelper::baseActionButtons(),
            'template' => '{update} {delete}',
        ]);
        Yii::$container->set('yii\data\Pagination', [
            'pageSize' => Yii::$app->request->get('per-page', 20),
            'pageSizeLimit' => [1, 500]
        ]);
    }
}

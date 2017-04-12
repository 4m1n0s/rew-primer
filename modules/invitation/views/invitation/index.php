<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\invitation\models\search\Invitation */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Invitations';
$this->params['pageTitle'] = Yii::t('admin', 'Invitations');
$this->params['pageSmallTitle'] = Yii::t('admin', 'manage');
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'] = [
    'Invitations',
];
?>

<div class="row">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-table"></i>Invitations
                </div>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <?php
                $template = "
                        <div class=\"table-scrollable\">
                            {items} 
                        </div>
                        <div class=\"row\"> 
                            <div class=\"col-md-5 col-sm-12\">
                                <div class=\"dataTables_info\" id=\"sample_1_info\">{summary}</div>
                            </div>
                            <div class=\"col-md-7 col-sm-12\">
                                <div class=\"dataTables_paginate paging_bootstrap\">
                                    {pager}
                                </div>
                            </div>
                        </div>";
                ?>

                <?php Pjax::begin(['id' => 'invitation-grid', 'enablePushState' => true]); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'email:email',
                        'code',
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'filter' => \app\modules\invitation\models\Invitation::getStatusList(),
                            'value' => function($row) {
                                return $row->getStatus(true);
                            }
                        ],
                        'create_date',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => Yii::t('admin', 'Actions'),
                            'headerOptions' => [
                                'width' => '200',
                            ],
                            'buttons' => [
                                'referrals' => function($url, $model) {
                                    $url = Yii::$app->getUrlManager()->createUrl(['user/user-backend/referrals', 'id' => $model->id]);

                                    return Html::a('<i class="fa fa-sitemap"></i> ' . Yii::t('admin', 'Referrals'), $url, [
                                        'class' => 'btn btn-xs purple',
                                        'title' => Yii::t('admin', 'Referrals'),
                                        'data-pjax' => 0
                                    ]);
                                },
                                'edit' => function($url, $model) {
                                    $url = Yii::$app->getUrlManager()->createUrl(['user/index-backend/edit', 'id' => $model->id]);

                                    return Html::a('<i class="fa fa-edit"></i> ' . Yii::t('admin', 'Edit'), $url, [
                                        'class' => 'btn default btn-xs green',
                                        'title' => Yii::t('admin', 'Edit'),
                                        'data-pjax' => 0
                                    ]);
                                },
                                'approve' => function($url, $model) {
                                    $url = Url::to(['/invitation/invitation/approve']);
                                    return Html::a(
                                        '<i class="fa fa-check-square-o"></i> ' . Yii::t('admin', 'Approve'),
                                        Url::to(),
                                        [
                                            'title' => 'Approve',
                                            'class' => 'btn default btn-xs blue',
                                            'onclick'=> $model->status == \app\modules\invitation\models\Invitation::STATUS_APPROVED ? "return;" : "status('$url', '$model->id')",
                                            'data-pjax' => 1,
                                        ]
                                    );
                                },
                                'deny' => function($url, $model) {
                                    $url = Url::to(['/invitation/invitation/deny']);
                                    return Html::a(
                                        '<i class="fa fa-ban"></i> ' . Yii::t('admin', 'Deny'),
                                        Url::to(),
                                        [
                                            'title' => 'Deny',
                                            'class' => 'btn default btn-xs red',
                                            'onclick'=> $model->status == \app\modules\invitation\models\Invitation::STATUS_DENIED ? "return;" : "status('$url', '$model->id')",
                                            'data-pjax' => 1
                                        ]
                                    );
                                }
                            ],
                            'template' => '{approve} {deny}',
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>

<?php

$token = Yii::$app->request->getCsrfToken();

$script = <<< JS
    function status(url, id) {
        $.ajax({
            url: url,
            type: "POST",
            data: {
                id: id,
                _csrf: "$token"
            },
            success: function(data) {
                if (data == true) {
                    $.pjax.reload({container:'#invitation-grid'});                    
                }
            }
        });
        return false;
    }
JS;
$this->registerJs($script, yii\web\View::POS_END);


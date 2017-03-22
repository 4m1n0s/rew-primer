<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->registerJsFile('/back/assets/scripts/sf_custom/user-list-page.js', ['depends' => [app\assets\BackAsset::className()]]);
$this->registerJs("
            jQuery(document).ready(function() {  
                $('.date-picker').datepicker({
                        rtl: App.isRTL(),
                        autoclose: true
                });
                $(document).on('pjax:send', function() {
                    App.blockUI({target: $('.portlet').children('.portlet-body'), iconOnly: true});
                });
                $(document).on('pjax:complete', function() {
                    App.unblockUI($('.portlet').children('.portlet-body'));
                    $('.date-picker').datepicker({
                        rtl: App.isRTL(),
                        autoclose: true
                    });
                });
                
//                UserList.init();
             });", yii\web\View::POS_END, 'date-picker-init');

$this->title = Yii::t('user/admin', 'Users');
$this->params['pageTitle'] = Yii::t('user/admin', 'Users');
$this->params['pageSmallTitle'] = Yii::t('user/admin', 'manage');
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'] = [
    'Users',
];
?>

<div class="row">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-table"></i><?= Yii::t('user/admin', 'User Listing'); ?>
                </div>
                <div class="actions">
                    <?= Html::a('<i class="fa fa-plus"></i> <span class="hidden-480">'.Yii::t('user/admin', 'New User').'</span>', ['create'], ['class' => 'btn default yellow-stripe']); ?>
                    <?php //echo Html::a('<i class="fa  fa-cloud-download"></i> <span class="hidden-480">' . Yii::t('user/admin', 'Export All') . '</span>', ['export'], ['class' => 'btn default yellow-stripe', 'id' => 'jsf-import-button']); ?>
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
                    Pjax::begin(['id' => 'invitation-grid', 'enablePushState' => true]);
                    ?>

                    <?=
                    GridView::widget([
                        'tableOptions' => [
                            'class' => 'table table-striped table-bordered table-hover'
                        ],
                        'headerRowOptions' => [
                            'class' => 'heading'
                        ],
                        'pager' => [
                            'firstPageLabel' => Yii::t('user/admin', 'First'),
                            'lastPageLabel' => Yii::t('user/admin', 'Last'),
                        ],
                        'layout' => $template,
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            [
                                'attribute' => 'id',
                                'headerOptions' => [
                                    'width' => '100',
                                ],
                            ],
                            [
                                'attribute' => 'username',
                                'headerOptions' => [
                                    'width' => '200',
                                ],
                            ],
                            'email:email',
//                            [
//                                'attribute' => 'create_date',
//                                'headerOptions' => [
//                                    'width' => '150',
//                                ],
////                                'filter' => app\helpers\FilterHelper::dateRange($searchModel, 'dateFrom', 'dateTo'),
//                                'value' => function($model){
//                                    return Yii::$app->formatter->asDatetime($model->create_date);;
//                                }
//                            ],
                            [
                                'attribute' => 'status',
                                'filter' => $statusList,
                                'headerOptions' => ['width' => '150'],
                                'format' => 'raw',
                                'value' => function($model) {
                                    return $model->getStatus(true);
                                }
                            ],
                            [
                                'attribute' => 'role',
                                'filter' => $roleList,
                                'headerOptions' => ['width' => '150'],
                                'value' => function($model) {
                                    return $model->getRoles();
                                }
                            ],
                            [
                                'attribute' => 'referral_code',
                                'headerOptions' => [
                                    'width' => '200',
                                ],
                            ],
                            [
                                'attribute' => 'balance',
                                'value' => function($model){
                                    if(isset($model->metaData->balance)){
                                        return Yii::t('user/admin', '{balance}pt.', [
                                            'balance' => number_format($model->metaData->balance, 2)
                                        ]);
                                    }
                                    
                                    return Yii::t('user/admin', '{balance}pt.', [
                                        'balance' => number_format(0, 2)
                                    ]);
                                }
                            ],
                            [
                                'attribute' => 'note',
                                'headerOptions' => [
                                    'width' => '200',
                                ],
                                'format' => 'raw',
                                'value' => function($model){
                                    if(isset($model->metaData->note)){
                                        $note = (strlen($model->metaData->note) > 40 ) ? substr($model->metaData->note, 0, 40).'...' : $model->metaData->note;
                                        return "<span class=\"text-primary\" title=\"{$model->metaData->note}\">$note<span>";
                                    }
                                    
                                    return '<span title="'.Yii::t('user/admin', 'Not found note').'"> none <span>';
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => Yii::t('user/admin', 'Actions'),
                                'headerOptions' => [
                                    'width' => '150',
                                ],
                                'buttons' => [
                                    'referrals' => function($url, $model) {
                                        $url = Yii::$app->getUrlManager()->createUrl(['user/user-backend/referrals', 'id' => $model->id]);

                                        return Html::a('<i class="fa fa-sitemap"></i> ' . Yii::t('user/admin', 'Referrals'), $url, [
                                                'class' => 'btn btn-xs purple',
                                                'title' => Yii::t('user/admin', 'Referrals'),
                                                'data-pjax' => 0
                                        ]);
                                    },
                                    'edit' => function($url, $model) {
                                        $url = Yii::$app->getUrlManager()->createUrl(['user/index-backend/edit', 'id' => $model->id]);

                                        return Html::a('<i class="fa fa-edit"></i> ' . Yii::t('user/admin', 'Edit'), $url, [
                                                'class' => 'btn default btn-xs green',
                                                'title' => Yii::t('user/admin', 'Edit'),
                                                'data-pjax' => 0
                                        ]);
                                    },
                                    'toBlackList' => function($url, $model){

                                        $url = Url::to(['/user/index-backend/user-to-blacklist']);
                                        if($model->status != app\modules\user\models\User::STATUS_BLACKLIST){
                                            return Html::a(
                                                '<i class="fa fa-ban"></i> ' . Yii::t('user/admin', 'To Blacklist'),
                                                Url::to(),
                                                [
                                                    'class' => 'btn default btn-xs red',
                                                    'onclick'=> "blacklist('$url', '$model->id')",
                                                    'data-pjax' => 1
                                                ]
                                            );
                                        }else{
                                            return Html::a(
                                                '<i class="fa fa-ban"></i> ' . Yii::t('user/admin', 'Remove From Blacklist'),
                                                Url::to(),
                                                [
                                                    'class' => 'btn default btn-xs blue',
                                                    'onclick'=> "blacklist('$url', '$model->id')",
                                                    'data-pjax' => 1
                                                ]
                                            );
                                        }
                                    }
                                ],
                                'template' => '{toBlackList} {edit}',
                            ],
                        ],
                    ]);
                    ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="max-height: 600px; overflow: scroll;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">User IPs</h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<?php

$token = Yii::$app->request->getCsrfToken();

$script = <<< JS
    function blacklist(url, id) {
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
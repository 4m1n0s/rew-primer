<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use app\modules\core\helpers\ViewHelper;
use app\modules\core\helpers\FilterHelper;
use yii\widgets\Pjax;

/* @var $this \yii\web\View */

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
             });", yii\web\View::POS_END, 'date-picker-init');

$this->title = Yii::t('admin', 'Subscribers');
$this->params['pageTitle'] = $this->title;

?>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-grid font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase"><?= Yii::t('app', 'Subscribers Datatable')?></span>
                </div>
                <div class="actions">
                    <?= Html::a('<i class="fa fa-cloud-download"></i> '. Yii::t('admin', 'Export'), ['export'], ['class' => 'dt-button buttons-pdf buttons-html5 btn yellow btn-outline'])?>
                </div>
            </div>
            <?php Pjax::begin(['id' => 'grid-block', 'enablePushState' => false]);?>
                <div class="portlet-body">
                    <?=
                    GridView::widget([
                        'tableOptions' => [
                            'class' => 'table table-striped table-bordered table-hover table-checkable dataTable no-footer'
                        ],
                        'headerRowOptions' => [
                            'class' => 'heading'
                        ],
                        'pager' => [
                            'firstPageLabel' => Yii::t('app', 'First'),
                            'lastPageLabel' => Yii::t('app', 'Last'),
                        ],
                        'layout' => ViewHelper::gridViewLayout(),
                        'id' => 'videos-grid',
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            [
                                'attribute' => 'id',
                                'headerOptions' => [
                                    'width' => '80',
                                ],
                            ],
                            [
                                'attribute' => 'email',
                            ],
                            [
                                'attribute' => 'create_date',
                                'headerOptions' => [
                                    'width' => '200px',
                                ],
                                'filter' => FilterHelper::dateRange($searchModel, 'dateFrom', 'dateTo'),
                                'value' => function($model){
                                    return Yii::$app->formatter->asDatetime($model->create_date);;
                                }
                            ],
                        ],
                    ]);
                    ?>
                </div>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
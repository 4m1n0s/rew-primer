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
                $(document).on('pjax:complete', function() {
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

<?php $this->beginBlock('actions')?>
<?= Html::a('<i class="fa fa-plus"></i> <span class="hidden-480">'.Yii::t('user/admin', 'New User').'</span>', ['create'], ['class' => 'btn default yellow-stripe']); ?>
<?php $this->endBlock()?>

<?php Pjax::begin(['id' => 'user-grid', 'enablePushState' => false]); ?>
<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'label' => 'User #',
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
        [
            'label' => 'Balance',
            'attribute' =>  'virtual_currency',
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
            'attribute' => 'status',
            'filter' => $statusList,
            'headerOptions' => ['width' => '150'],
            'format' => 'raw',
            'value' => function($model) {
                return $model->getStatus(true);
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('user/admin', 'Actions'),
            'headerOptions' => ['style' => 'min-width:100px;width:auto'],
            'buttons' => \yii\helpers\ArrayHelper::merge(
               \app\modules\dashboard\helpers\GridViewTemplateHelper::baseActionButtons(), [
                'orders' => function($url, $model) {
                    return Html::a('<i class="fa fa-shopping-cart"></i>', $url,  [
                        'title' => 'Orders',
                        'class' => 'btn btn-sm btn-default btn-circle btn-editable',
                        'data-pjax' => 0,
                        'target' => '_blank',
                    ]);
                },
            ]),
            'template' => '{toBlackList} {orders} {view} {update} {delete}',
        ],
    ],
]);
?>
<?php Pjax::end(); ?>

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
            }
        });
        return false;
    }
JS;
$this->registerJs($script, yii\web\View::POS_END);
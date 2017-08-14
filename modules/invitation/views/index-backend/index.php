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
<?php $this->beginBlock('group-actions') ?>
<?php echo \app\modules\core\widgets\GroupActions::widget([
    'items' => [
        [
            'label' => 'Approve',
            'action' => Url::toRoute(['/invitation/index-backend/approve-all'])
        ],
        [
            'label' => 'Decline',
            'action' => Url::toRoute(['/invitation/index-backend/deny-all'])
        ],
    ],
    'grid' => '#invitation-grid',
    'pjaxContainer' => '#invitation-grid-pjax'
]) ?>
<?php $this->endBlock() ?>
<?php Pjax::begin(['id' => 'invitation-grid-pjax']); ?>
<?= GridView::widget([
    'id' => 'invitation-grid',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => 'yii\grid\CheckboxColumn',
            'cssClass' => 'invitation-selection',
        ],

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
        [
            'filter' => \app\modules\dashboard\helpers\GridViewTemplateHelper::dateRange($searchModel, 'cr_date_from', 'cr_date_to'),
            'headerOptions' => ['style' => 'width: 180px;min-width: 180px;'],
            'attribute' => 'create_date',
            'format' => 'datetime',
        ],
    ],
]); ?>
<?php Pjax::end(); ?>

<?php
//$this->registerJsFile('/backend/js/invitation_grid_module.js', ['depends' => \app\assets\BackendAsset::class]);
//$this->registerJs('invitation_grid_module.init()');
?>
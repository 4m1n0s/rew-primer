<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\contact\models\search\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contacts';
$this->params['pageTitle'] = Yii::t('admin', 'Contacts');
$this->params['pageSmallTitle'] = Yii::t('admin', 'manage');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginBlock('group-actions') ?>
<?php echo \app\modules\core\widgets\GroupActions::widget([
    'items' => [
        [
            'label' => 'Mark as Read',
            'action' => Url::toRoute(['/contact/index-backend/read-all']),
        ],
        [
            'label' => 'Remove',
            'action' => Url::toRoute(['/contact/index-backend/delete-all']),
        ],
    ],
    'grid' => '#contact-grid',
    'pjaxContainer' => '#contact-grid-pjax'
]) ?>
<?php $this->endBlock() ?>

<?php Pjax::begin(['id' => 'contact-grid-pjax']); ?>
<?= GridView::widget([
    'id' => 'contact-grid',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        ['class' => 'yii\grid\CheckboxColumn'],

        'name',
        'email:email',
        [
            'attribute' => 'subject',
            'value' => function($model) {
                return mb_strimwidth($model->subject, 0, 120, '...');
            }
        ],
        [
            'filter' => \app\modules\dashboard\helpers\GridViewTemplateHelper::dateRange($searchModel, 'cr_date_from', 'cr_date_to'),
            'headerOptions' => ['style' => 'width: 180px;min-width: 180px;'],
            'attribute' => 'create_date',
            'format' => 'datetime',
        ],
        [
            'attribute' => 'status',
            'format' => 'raw',
            'filter' => \app\modules\contact\models\Contact::getStatusList(),
            'value' => function($model) {
                return $model->getStatus(true);
            }
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'buttons' => \yii\helpers\ArrayHelper::merge(\app\modules\dashboard\helpers\GridViewTemplateHelper::baseActionButtons(), [
                'reply' => function($url, $model) {
                    return Html::a('<i class="fa fa-reply"></i>', $url, [
                        'class' => 'btn btn-sm btn-default btn-circle btn-editable',
                        'title' => Yii::t('app', 'Reply'),
                        'data-pjax' => 0
                    ]);
                },
            ]),
            'template' => '{reply} {delete}'
        ],
    ],
]); ?>
<?php Pjax::end(); ?>

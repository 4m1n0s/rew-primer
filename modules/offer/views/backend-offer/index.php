<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\offer\models\search\OfferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Offers';
$this->params['pageTitle'] = Yii::t('admin', 'Offers');
$this->params['pageSmallTitle'] = Yii::t('admin', 'manage');
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'] = [
    'Offers',
];
?>

<?php Pjax::begin(['id' => 'offers-grid-pjax', 'enablePushState' => true]); ?>
<?= GridView::widget([
    'id' => 'offer-grid',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'name',
        'label',
        [
            'attribute' => 'img',
            'format' => 'raw',
            'filter' => false,
            'value' => function($row) {
                return Yii::$app->formatter->asImage($row->img, ['width' => 140]);
            }
        ],
        [
            'attribute' => 'active',
            'format' => 'raw',
            'filter' => [1 => 'Yes', 0 => 'No'],
            'value' => function($row) {
                return Yii::$app->formatter->asBoolean($row->active);
            }
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'headerOptions' => ['style' => 'min-width:40px;width:40px'],
            'template' => '{update}'
        ],
    ],
]); ?>
<?php Pjax::end(); ?>
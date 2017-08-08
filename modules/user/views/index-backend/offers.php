<?php

/* @var \yii\web\View $this */
/* @var \app\modules\user\models\User $user */

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\dashboard\helpers\GridViewTemplateHelper;

$this->title = 'Completion History';

$this->params['pageTitle'] = Yii::t('user/admin', 'User\'s');
$this->params['pageSmallTitle'] = Yii::t('user/admin', 'completion');

$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginBlock('caption') ?>
<h3><?php echo Html::a($user->username  . ' (#' . $user->id . ')',
        ['/user/index-backend/view', 'id' => $user->id],
        ['class' => 'view-modal-btn'])
    ?>
</h3>
<?php $this->endBlock() ?>

<div class="order-history-list">
    <?php \yii\widgets\Pjax::begin(['id' => 'pjax-user-offer-grid']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'offer_wall',
                'label' => 'OfferWall',
                'value' => function($row) {
                    return $row->offer->label;
                }
            ],
            [
                'attribute' => 'name_campaign',
                'label' => 'Name',
                'value' => function($row) {
                    return $row->name_campaign;
                }
            ],
            [
                'headerOptions' => ['style' => 'width: 120px;min-width: 120px;'],
                'filter' => GridViewTemplateHelper::textRange($searchModel, 'amount_from', 'amount_to'),
                'attribute' => 'amount',
            ],
            [
                'filter' => GridViewTemplateHelper::dateRange($searchModel, 'date_from', 'date_to'),
                'headerOptions' => ['style' => 'width: 220px;min-width: 220px;'],
                'attribute' => 'created_at',
                'format' => 'datetime',
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end() ?>
</div>
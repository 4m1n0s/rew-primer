<?php

/* @var \yii\web\View $this */
/* @var \app\modules\user\models\User $user */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\modules\dashboard\helpers\GridViewTemplateHelper;

$this->title = 'Referrals';

$this->params['pageTitle'] = Yii::t('user/admin', 'User\'s');
$this->params['pageSmallTitle'] = Yii::t('user/admin', 'referrals');

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
                'format' => 'raw',
                'attribute' => 'referral_username',
                'value' => function($row) {
                    return Html::a(ArrayHelper::getValue($row, 'username'),
                        ['/user/index-backend/view', 'id' => ArrayHelper::getValue($row, 'id')],
                        ['class' => 'view-modal-btn']);
                }
            ],
            [
                'headerOptions' => ['style' => 'width: 120px;min-width: 120px;'],
                'filter' => GridViewTemplateHelper::textRange($searchModel, 'total_amount_from', 'total_amount_to'),
                'attribute' => 'total_amount',
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end() ?>
</div>
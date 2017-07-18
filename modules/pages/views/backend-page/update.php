<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pages\models\Page */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Page',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<?php $this->beginBlock('content') ?>
<div class="page-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
<?php $this->endBlock() ?>

<?php echo \app\modules\dashboard\helpers\TemplateHelper::createPage('content') ?>
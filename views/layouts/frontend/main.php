<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\FrontAsset;
use app\assets\AdsAsset;

FrontAsset::register($this);
AdsAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofolow">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?= Html::csrfMetaTags() ?>
</head>

<body class="wide">
<?php $this->beginBody(); ?>
    <?= $this->render('_elements/header'); ?>
    <?= $content ?>
    <?= $this->render('_elements/footer'); ?>
    <a class="gototop gototop-button" href="#"><i class="fa fa-chevron-up"></i></a>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage() ?>
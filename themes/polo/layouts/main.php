<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\FrontAsset;

FrontAsset::register($this);

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
    <div class="wrapper-ft-sticky">
         <div class="content-ft-sticky">
                <?= $this->render('_elements/header'); ?>
                <?= $content ?>
         </div> 
        <?= $this->render('_elements/footer'); ?>
        <a class="gototop gototop-button" href="#"><i class="fa fa-chevron-up"></i></a>
    </div>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage() ?>
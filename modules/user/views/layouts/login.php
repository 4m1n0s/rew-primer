<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\BackAsset;

/* @var $this \yii\web\View */
/* @var $content string */

BackAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="login">

        <?php $this->beginBody() ?>

        <div class="logo">
            <a href="index.html">
                <img src="/img/gifthulk_logo_dark.png" alt=""/>
            </a>
        </div>

        <div class="content">
            <?= $content ?>
        </div>

        <div class="copyright">
            <?= date('Y'); ?> &copy; Reward Rack
        </div>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

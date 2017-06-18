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
    <?= $this->render('_elements/header'); ?>
    <section class="content p-15">
        <div class="container">

            <div class="row">
                <div class="col-md-9">
                    <div class="text-left col-md-offset-1">
                        <h3><?= $this->title; ?></h3>
                    </div>
                </div>
            </div>

            <div class="row row-container">
                <div class="col-md-9">
                    <?= $content ?>
                </div>
                <div class="col-md-3">
                    <?= $this->render('_elements/sidebar'); ?>
                </div>
            </div>

        </div>
    </section>
    <?= $this->render('_elements/footer'); ?>
    <a class="gototop gototop-button" href="#"><i class="fa fa-chevron-up"></i></a>
    <?php $this->endBody(); ?>
    </body>
    </html>
<?php $this->endPage() ?>
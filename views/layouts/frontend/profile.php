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
    <?= $this->render('_elements/head'); ?>
    <body class="wide">
    <?php $this->beginBody(); ?>
    <?= $this->render('_elements/header'); ?>
    <section class="content p-15">
        <div class="container">

            <div class="row">
                <div class="col-md-9">
                    <div class="text-left">
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
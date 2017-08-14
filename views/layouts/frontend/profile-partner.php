<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\FrontAsset;

FrontAsset::register($this);
?>
<?php $this->beginContent('@app/views/layouts/frontend/main.php') ?>
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
<?php $this->endContent() ?>
<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\FrontAsset;

FrontAsset::register($this);
?>
<?php $this->beginContent('@app/views/layouts/frontend/main.php') ?>
    <section class="content p-15">
        <div class="container">
            <?php if (isset($this->blocks['title'])): ?>
            <div class="row">
                <div class="col-md-9">
                    <div class="text-left">
                        <h3><?php echo $this->blocks['title'] ?></h3>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="row row-container">
                <div class="col-md-12">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </section>
<?php $this->endContent() ?>
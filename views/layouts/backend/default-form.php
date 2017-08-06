<?php
/* @var $this \yii\web\View */
/* @var $content string */
?>

<?php $this->beginContent('@app/views/layouts/backend/main.php') ?>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <?php if (isset($this->blocks['title'])): ?>
                    <div class="portlet-title">
                        <div class="caption">
                            <?php echo $this->blocks['title'] ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="portlet-body form">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>
<?php $this->endContent() ?>
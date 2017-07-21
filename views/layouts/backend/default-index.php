<?php
/* @var $this \yii\web\View */
/* @var $content string */
?>

<?php $this->beginContent('@app/views/layouts/backend/main.php') ?>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet">
                <div class="portlet-title">
                    <div class="actions">
                        <?php if (isset($this->blocks['actions'])) {
                            echo $this->blocks['actions'];
                        } ?>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->endContent() ?>
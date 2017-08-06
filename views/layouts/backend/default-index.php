<?php
/* @var $this \yii\web\View */
/* @var $content string */
?>

<?php $this->beginContent('@app/views/layouts/backend/main.php') ?>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered portlet-datatable ">
                <?php if (isset($this->blocks['actions'])): ?>
                    <div class="portlet-title">
                        <div class="actions">
                            <?php echo $this->blocks['actions']?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="portlet-body">
                    <div class="table-container">
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->endContent() ?>
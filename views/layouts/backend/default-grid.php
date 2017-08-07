<?php
/* @var $this \yii\web\View */
/* @var $content string */
?>

<?php $this->beginContent('@app/views/layouts/backend/main.php') ?>
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($this->blocks['header'])) {
                echo $this->blocks['header'];
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered portlet-datatable ">
                <?php if (isset($this->blocks['actions'])): ?>
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-table font-green"></i>
                            <span class="caption-subject font-green sbold uppercase"><?php echo $this->title ?></span>
                        </div>
                        <div class="actions">
                            <?php echo $this->blocks['actions'] ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="portlet-body">
                    <div class="table-container">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <?= \app\modules\core\widgets\PageSizeWidget::widget([
                                    'options' => [
                                        'class' => 'form-control input-xs input-sm input-inline',
                                    ],
                                    'sizes' => [
                                        20 => 20,
                                        50 => 50,
                                        100 => 100,
                                        250 => 250,
                                        500 => 500,
                                    ],
                                ]); ?>
                            </div>
                            <?php if (isset($this->blocks['group-actions'])): ?>
                            <div class="col-md-8 col-sm-12">
                                <div class="table-group-actions pull-right">
                                    <?php echo $this->blocks['group-actions'] ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($this->blocks['footer'])) {
                echo $this->blocks['footer'];
            }
            ?>
        </div>
    </div>
<?php $this->endContent() ?>
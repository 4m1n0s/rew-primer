<?php
/* @var string $actionsBlockName */
/* @var string $contentBlockName */
?>

<div class="row">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="actions">
                    <?php if (isset($this->blocks[$actionsBlockName])) {
                        echo $this->blocks[$actionsBlockName];
                    } ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-container">
                    <?php if (isset($this->blocks[$contentBlockName])) {
                        echo $this->blocks[$contentBlockName];
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>
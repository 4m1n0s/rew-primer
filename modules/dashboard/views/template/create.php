<?php
/* @var string $titleBlockName */
/* @var string $contentBlockName */
?>

<div class="portlet">
    <?php if (isset($this->blocks[$titleBlockName])): ?>
        <div class="portlet-title">
            <div class="caption">
                <?php echo $this->blocks[$titleBlockName] ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="portlet-body form">
        <?php if (isset($this->blocks[$contentBlockName])) {
            echo $this->blocks[$contentBlockName];
        } ?>
    </div>
</div>
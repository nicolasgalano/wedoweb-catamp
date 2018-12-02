<?php
$prefix = ($rowFreeContentClone)? 'clone_' : '';
$rowFreeContent = get_field($prefix.'row-free-content');
$rowFreeBackgroundType = get_field($prefix.'row-free-background-type');
$rowClass = ($rowFreeBackgroundType == 'white')? 'row-bepart' : 'row-questions';
?>
<div class="section-row <?php echo $rowClass; ?>"
     <?php if($rowFreeBackgroundType != 'white') {?>data-midnight="white"<?php } ?>
     <?php if($rowFreeContentSetId) {?>id="asociate"<?php } ?>
    >
    <div class="container">
        <?php echo $rowFreeContent; ?>
    </div>
</div>
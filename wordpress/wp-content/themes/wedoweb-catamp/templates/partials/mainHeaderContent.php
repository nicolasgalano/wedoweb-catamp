<?php
$prefix = (isset($mainHeaderContentClone))? $mainHeaderContentClone : '';
$header_logo = get_field($prefix.'header_logo');
$header_content = get_field($prefix.'header_content');


?>
<div class="section-row row-main" data-midnight="blue">
    <div class="container">
        <?php
        if($header_logo) {
            ?>
            <img src="<?php echo $header_logo['url']; ?>"
                 alt="<?php echo $header_logo['alt']; ?>"
                 style="max-width:647px;">
        <?php
        }
        echo $header_content;
        ?>
    </div>
</div>

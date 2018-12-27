<?php
/* Template Name: Página Licencia */
?>
<?php
global $post;

$parentId = wp_get_post_parent_id($post->ID);
$headerType = '';
if($parentId) {
    $parentPage = get_post($parentId);
    $headerType = $parentPage->post_name;
}
if($headerType == 'lnhcursos') {
    $headerType = 'lnh';
}

get_header($headerType);

$inner_header_background = get_field('licencia_inner_header_background');
$inner_header_logo = get_field('licencia_inner_header_logo');
$inner_header_title = get_field('licencia_inner_header_title');
?>
<div class="section-row row-inner row-common"
    <?php if($inner_header_background) {?> style="background-image: url('<?php echo $inner_header_background['url']; ?>');" <?php } ?>
     data-midnight="white">
    <div class="container wow fadeInUp">
        <?php if($inner_header_logo) {?>
            <img src="<?php echo $inner_header_logo['url']; ?>">
        <?php } ?>
        <?php if($inner_header_title) {?>
            <h2><?php echo $inner_header_title; ?></h2>
        <?php } ?>
    </div>
</div>

<?php
$licencia_content = get_field('licencia_content');
?>
<div class="section-row row-inner inner-common">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php
                echo $licencia_content;
                ?>
            </div>
            <?php
                if(have_rows('licencia_list')) {
                    while (have_rows('licencia_list')) {
                        the_row();
                        $licencia_list_link = get_sub_field('licencia_list_link');
                        $licencia_list_image = get_sub_field('licencia_list_image');
                        $licencia_list_text = get_sub_field('licencia_list_text');
                        ?>
                        <div class="licencia-item col-sm-12 col-md-4">
                            <a href="<?php echo $licencia_list_link; ?>">
                                <img src="<?php echo $licencia_list_image['url']; ?>" alt="<?php echo $licencia_list_image['alt']; ?>">
                                <p><?php echo $licencia_list_text; ?></p>
                            </a>
                        </div>
            <?php
                    }

                }
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>

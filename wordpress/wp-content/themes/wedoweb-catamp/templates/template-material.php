<?php
/* Template Name: Página Material */
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

$inner_header_background = get_field('material_inner_header_background');
$inner_header_logo = get_field('material_inner_header_logo');
$inner_header_title = get_field('material_inner_header_title');
?>
<div class="section-row row-inner row-common"
    <?php if($inner_header_background) {?> style="background-image: url('<?php echo $inner_header_background['url']; ?>');" <?php } ?>
     data-midnight="white">
    <div class="container">
        <?php if($inner_header_logo) {?>
            <img src="<?php echo $inner_header_logo['url']; ?>">
        <?php } ?>
        <?php if($inner_header_title) {?>
            <h2><?php echo $inner_header_title; ?></h2>
        <?php } ?>
    </div>
</div>
<?php
$material_content = get_field('material_content');
?>
<div class="section-row row-inner inner-common">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php
                    echo $material_content;

                    if(have_rows('material_list')) {
                        while (have_rows('material_list')) {
                            the_row();
                            $material_list_title = get_sub_field('material_list_title');
                            $material_list_description = get_sub_field('material_list_description');
                            $material_list_file = get_sub_field('material_list_file');
                            ?>
                            <div class="descargas">
                                <a href="<?php echo $material_list_file['url']; ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/dummie/logos/lg_nube.png">
                                    <span><?php echo $material_list_title; ?></span>
                                    <?php echo $material_list_description; ?>
                                </a>
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>
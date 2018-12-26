<?php
/* Template Name: Página Acerca De */
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

$inner_header_background = get_field('header_background');
?>
<div class="section-row row-inner row-what_is"
    <?php if($inner_header_background) {?> style="background-image: url('<?php echo $inner_header_background['url']; ?>')" <?php } ?>
     data-midnight="white">
    <div class="container"></div>
</div>
<?php
$about_content = get_field('about_content');
?>
<div class="section-row row-inner inner-what_is">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php
                    echo $about_content;
                ?>

                <?php
                    if(have_rows('about_links_list')) {
                        ?>
                        <div class="row">
                            <?php
                            while (have_rows('about_links_list')) {
                                the_row();

                                $about_list_link = get_sub_field('about_list_link');
                                $about_list_image = get_sub_field('about_list_image');
                                ?>
                                    <div class="col-sm-12 col-md-4">
                                        <a href="<?php echo $about_list_link; ?>" target="_blank">
                                            <figure>
                                                <img src="<?php echo $about_list_image['url']; ?>"
                                                     alt="<?php echo $about_list_image['alt']; ?>">
                                            </figure>
                                        </a>
                                    </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer($headerType);
?>
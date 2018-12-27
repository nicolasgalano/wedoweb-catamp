<?php
/* Template Name: Página Asociarse */
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

$inner_header_background = get_field('join_inner_header_background');
$inner_header_logo = get_field('join_inner_header_logo');
$inner_header_title = get_field('join_inner_header_title');
?>
<div class="section-row row-inner row-join_us"
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
$join_content = get_field('join_content');
?>
<div class="section-row row-inner inner-join_us">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php
                echo $join_content;
                ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>

<?php
/* Template Name: Página Agenda */
?>
<?php
global $post;

$parentId = wp_get_post_parent_id($post->ID);
$headerType = '';
if($parentId) {
    $parentPage = get_post($parentId);
    $headerType = $parentPage->post_name;
}
if($headerType == 'linti') {
    $headerType = 'lnh';
}

get_header($headerType);

$inner_header_background = get_field('agend_inner_header_background');
$inner_header_logo = get_field('agend_inner_header_logo');
$inner_header_title = get_field('agend_inner_header_title');
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
$agend_title = get_field('agend_title');
$agend_iframe_link = get_field('agend_iframe_link');
$agend_content = get_field('agend_content');
?>
<div class="section-row row-inner inner-common">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3><?php echo $agend_title; ?></h3>
                <div class="agenda">
                    <iframe src="<?php echo $agend_iframe_link; ?>" width="100%" height="100%"></iframe>
                </div>
                <div class="agenda-mobile">
                    <?php
                        echo $agend_content;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>

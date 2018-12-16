<?php
/* Template Name: Página Interna */
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

$inner_header_background = get_field('inner_header_background');
$inner_header_logo = get_field('inner_header_logo');
$inner_header_title = get_field('inner_header_title');
?>
<div class="section-row row-inner row-common"
     <?php if($inner_header_background) {?> style="background: url('<?php echo $inner_header_background['url']; ?>') center center no-repeat;" <?php } ?>
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
<div class="section-row row-inner inner-common">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php
                    echo get_field('inner_content');
                ?>
            </div>
        </div>
    </div>
</div>
<?php
$inner_freeRow_content = get_field('inner_freeRow_content');
$inner_freeRow_background_color = get_field('inner_freeRow_background_color');
$inner_freeRow_background_image = get_field('inner_freeRow_background_image');

if($inner_freeRow_content) {
    $backgroundStyle = '';
    if($inner_freeRow_background_color) {
        $backgroundStyle = "style='background: {$inner_freeRow_background_color};'";
    }
    if($inner_freeRow_background_image) {
        $backgroundStyle = "style='background: url({$inner_freeRow_background_image['url']}) center center no-repeat;background-size: cover;'";
    }
    ?>
    <div class="section-row row-bepart" data-midnight="white"
         <?php echo $backgroundStyle; ?>
        >
        <div class="container">
            <div class="col-xs-12">
                <?php echo $inner_freeRow_content; ?>
            </div>
        </div>
    </div>
    <?php
}
?>

<?php
get_footer();
?>
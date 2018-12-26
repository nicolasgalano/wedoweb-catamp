<?php
/* Template Name: Página Política de Calidad */
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

$inner_header_background = get_field('quality_inner_header_background');
$inner_header_logo = get_field('quality_inner_header_logo');
$inner_header_title = get_field('quality_inner_header_title');
?>
<div class="section-row row-inner row-calidad"
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
$quality_contenido = get_field('quality_contenido');
$quality_sign = get_field('quality_sign');
?>
<div class="section-row row-inner inner-common">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php
                echo $quality_contenido;

                if($quality_sign) {
                    ?>
                    <figure class="firma">
                        <img src="<?php echo $quality_sign['url']; ?>"
                             alt="<?php echo $quality_sign['alt']; ?>">
                    </figure>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>
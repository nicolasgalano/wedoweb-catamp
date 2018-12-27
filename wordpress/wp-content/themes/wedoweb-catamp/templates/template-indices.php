<?php
/*
Template Name: Página Indices
*/
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
<div class="section-row row-inner inner-common">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <?php
                    echo get_field('inner_content');
                ?>

                <a class="btn " href="ultimoindice" target="_blank">Índice Diciembre 2018</a>

                <p>&nbsp;</p>

                <h4>DESCARGAR ÍNDICES PASADOS</h4>

                <ul class="indices">
                <?php $loop = new WP_Query( array( 'post_type' => 'indice' ) ); ?>

                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

                    <li><a href="<?php echo get_permalink(); ?>" target="_blank" rel="noopener"><?php echo get_the_title(); ?></a></li>

                <?php endwhile; ?>
                </ul>

            </div>
        </div>
    </div>
</div>

<?php
get_footer($headerType);
?>

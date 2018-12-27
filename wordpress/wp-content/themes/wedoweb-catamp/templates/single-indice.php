<?php
global $post;

$headerType = '';

get_header($headerType);
?>

<?php
$page = get_page_by_path( 'indice-del-transporte' );
$inner_header_background = get_field('inner_header_background', $page->ID);
$inner_header_logo = get_field('inner_header_logo', $page->ID);
$inner_header_title = get_field('inner_header_title', $page->ID);
if($page){
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
}
?>

<div class="section-row row-inner inner-common">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <h3>Índices del Transporte <?php echo get_the_title(); ?></h3>

                <ul class="indices">
                <?php
                if( have_rows('indices_por_mes') ) {
                    while ( have_rows('indices_por_mes') ) {
                        the_row();
                        $mes = get_sub_field('mes');
                        $archivo = get_sub_field('archivo');
                        ?>
                        <li><a href="<?php echo $archivo; ?>" target="_blank" rel="noopener"><?php echo $mes; ?></a></li>
                        <?php
                    }
                }
                ?>
                </ul>

            </div>
        </div>
    </div>
</div>

<?php
get_footer($headerType);
?>

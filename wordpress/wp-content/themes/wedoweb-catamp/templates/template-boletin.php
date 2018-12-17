<?php
/* Template Name: Página Boletín */
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

$inner_header_background = get_field('boletin_inner_header_background');
$inner_header_logo = get_field('boletin_inner_header_logo');
$inner_header_title = get_field('boletin_inner_header_title');
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

<?php
$boletin_contenido = get_field('boletin_contenido');
?>
<div class="section-row row-inner inner-common">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php
                echo $boletin_contenido;
                ?>
                <div class="boletin">
                    <form class="search">
                        <input class="form-control" type="search" name="q" placeholder="Buscar tema de boletín Técnico..." required><span class="i fas fa-search"></span>
                    </form>
                    <?php
                    if(have_rows('boletin_list')) {
                        while (have_rows('boletin_list')) {
                            the_row();
                            $boletin_list_boletin = get_sub_field('boletin_list_boletin');

                            echo $boletin_list_boletin;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>

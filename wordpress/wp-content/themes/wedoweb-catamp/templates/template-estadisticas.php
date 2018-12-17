<?php
/* Template Name: Página Estadísticas */
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

$inner_header_background = get_field('statistics_inner_header_background');
$inner_header_logo = get_field('statistics_inner_header_logo');
$inner_header_title = get_field('statistics_inner_header_title');
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
$statistics_content = get_field('statistics_content');
$statistics_content_final = get_field('statistics_content_final');
?>
<div class="section-row row-inner inner-estadistica">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <?php
                echo $statistics_content;

                if(have_rows('statistics_list')) {
                    while(have_rows('statistics_list')) {
                        the_row();
                        $statistics_list_title = get_sub_field('statistics_list_title');
                        $statistics_list_subtitle = get_sub_field('statistics_list_subtitle');
                        $statistics_list_image = get_sub_field('statistics_list_image');
                        ?>
                        <?php
                        if($statistics_list_title) {
                            ?>
                            <h5><?php echo $statistics_list_title; ?></h5>
                            <?php
                        }
                        ?>
                        <?php
                        if($statistics_list_subtitle) {
                            ?>
                            <h6><?php echo $statistics_list_subtitle; ?></h6>
                            <?php
                        }
                        ?>
                        <?php
                        if($statistics_list_image) {
                            ?>
                            <figure>
                                <img src="<?php echo $statistics_list_image['url']; ?>" alt="<?php echo $statistics_list_image['alt']; ?>">
                            </figure>
                            <a class="img-link" href="<?php echo $statistics_list_image['url']; ?>" target="_blank">Abrir imagen en otra pestaña.</a>
                            <?php
                        }
                        ?>
                <?php
                    }
                }

                echo $statistics_content_final;
                ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>

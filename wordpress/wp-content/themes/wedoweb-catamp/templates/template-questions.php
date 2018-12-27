<?php
/* Template Name: Página Preguntas */
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

$inner_header_background = get_field('questions_inner_header_background');
$inner_header_logo = get_field('questions_inner_header_logo');
$inner_header_title = get_field('questions_inner_header_title');
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
$questions_content = get_field('questions_content');
//$questions_list = get_field('questions_list');
//var_dump($questions_list);
?>
<div class="section-row row-inner inner-common">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php
                    echo $questions_content;

                    if(have_rows('questions_list')) {
                        ?>
                        <div class="preguntas">
                        <?php
                        while (have_rows('questions_list')) {
                            the_row();
                            $questions_list_question = get_sub_field('questions_list_question');
                            $questions_list_answer = get_sub_field('questions_list_answer');
                            ?>
                            <div class="pregunta-item">
                                <div class="pregunta">
                                    <p><?php echo $questions_list_question; ?></p><span></span>
                                </div>
                                <div class="respuesta">
                                    <?php echo $questions_list_answer; ?>
                                </div>
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
get_footer();
?>

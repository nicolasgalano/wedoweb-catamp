<?php
/* Template Name: Home Catamp */
get_header();
?>
<div class="section-row row-main" data-midnight="blue">
    <div class="container"><img src="<?php echo get_template_directory_uri(); ?>/images/home/im_main_logo.png" style="max-width:647px;">
        <p>Cámara Argentina del Transporte<br>Automotor de Mercancias y Residuos Peligrosos</p>
    </div>
</div>

<?php
    $videoLabel = get_field('about-video-label')
?>
<div class="section-row row-about" id="about">
    <div class="container">
        <div class="row">
            <div class="col-xs-18 col-sm-9 col-md-6">
                <h2><?php echo get_field('about-title'); ?></h2>
                <?php echo get_field('about-content'); ?>
            </div>
            <div class="col-xs-18 col-sm-9 col-md-6">
                <div class="multimedia open-popup-youtube" data-youtube="<?php echo get_field('about-video-link'); ?>"><?php if($videoLabel) {?><span><?php echo $videoLabel; ?></span><?php } ?></div>
            </div>
        </div>
    </div>
</div>

<div class="section-row row-services" id="servicios" data-midnight="white">
    <div class="container">
        <div class="row">
            <?php
                $servicesSectionTitle = get_field('services-home-section-title');
                    ?>
            <div class="col-xs-12">
                <h2><?php echo $servicesSectionTitle; ?></h2>
            </div>
            <?php
            if( have_rows('services-home-items') ) {
                while ( have_rows('services-home-items') ) {
                    the_row();
                    $image = get_sub_field('services-home-logo');
                    $title = get_sub_field('services-home-title');
                    $content = get_sub_field('services-home-content');
                    $link = get_sub_field('services-home-link');
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-4"><a href="<?php echo $link; ?>">
                            <figure class="clearfix"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']?>">
                                <span><b><?php echo $title; ?></b></span>
                            </figure>
                            <?php echo $content; ?>
                        </a></div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php

    set_query_var( 'rowFreeContentSetId', true );
    get_template_part('templates/partials/rowFreeContent');

$args = array(
    'post_type' => 'noticia',
    'posts_per_page'   => 3,
    'meta_key' => 'news-group',
    'meta_value' => 'catamp'
);
$loop = new WP_Query( $args );
if($loop->have_posts()) {
    ?>
    <!--News-->
    <div class="section-row row-news" id="noticias" data-midnight="gray">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2>Noticias</h2>
                </div>
                <?php
                    while($loop->have_posts()) {
//                        var_dump($loop);
                        $loop->the_post();
                        $image = false;
                        if(have_rows('top_header')) {
                            while (have_rows('top_header')) {
                                the_row();
                                $image = get_sub_field('top_header_image');
                                if($image) {break;}
                            }
                        }
                        $tagsList = get_the_tags();
                        $tag = false;
                        if(count($tagsList) > 0) {
                            $tag = $tagsList[0]->name;
                        }
                        ?>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <a class="article" href="<?php echo get_the_permalink(); ?>">
                                <?php
                                if($image) {
                                    ?>
                                    <figure>
                                        <img src="<?php echo $image['sizes']['news-size']?>" alt="<?php echo $image['alt']; ?>"/>
                                    </figure>
                                <?php
                                }
                                ?>
                                <div class="cont">
                                    <?php
                                        if($tag) {
                                    ?>
                                    <span><?php echo $tag ?></span>
                                    <?php
                                        }
                                    ?>
                                    <h3><?php echo get_the_title()?></h3>
                                    <p><?php echo get_the_excerpt()?></p>
                                </div>
                            </a>
                        </div>
                <?php
                    }

                    if($loop->post_count >= 3) {
                        ?>
                        <a class="btn" href="<?php echo esc_url(home_url('/'))?>noticias" target="_blank">Ver más</a>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
<?php
    wp_reset_query();
}

set_query_var( 'rowFreeContentSetId', false );
set_query_var( 'rowFreeContentClone', true );
get_template_part('templates/partials/rowFreeContent');
?>

<?php get_footer(); ?>


<?php
/* Template Name: Home Cipet */
get_header('cipet');
?>
<?php
set_query_var('mainHeaderContentClone', 'cipet_');
get_template_part('templates/partials/mainHeaderContent');
?>

<?php
    $about_video_label = get_field('cipet_about-video-label');
    $about_title = get_field('cipet_about-title');
    $about_video_link = get_field('cipet_about-video-link');
    $about_content = get_field('cipet_about-content');
    set_query_var( 'about_video_label', $about_video_label );
    set_query_var( 'about_title', $about_title );
    set_query_var( 'about_video_link', $about_video_link );
    set_query_var( 'about_content', $about_content );
    get_template_part('templates/partials/aboutContent')
?>

<?php
$pagelist_background = get_field('cipet_pagelist_background');
?>
<div class="section-row row-services"
     style="background: url('<?php echo $pagelist_background['url'] ?>') center center no-repeat;background-size: cover;"
     id="servicios" data-midnight="white">
    <div class="container">
        <div class="row">
            <?php
                $pagelist_title = get_field('cipet_pagelist_title');
                    ?>
            <div class="col-xs-12">
                <h2><?php echo $pagelist_title; ?></h2>
            </div>
            <?php
            if( have_rows('cipet_pagelist_items') ) {
                while ( have_rows('cipet_pagelist_items') ) {
                    the_row();
                    $image = get_sub_field('pagelist_item_logo');
                    $title = get_sub_field('pagelist_item_title');
                    $content = get_sub_field('pagelist_item_content');
                    $pagelist_item_link_type = get_sub_field('pagelist_item_link_type');
                    $pagelist_item_link = get_sub_field('pagelist_item_link');
                    $pagelist_item_page = get_sub_field('pagelist_item_page');
                    $link = '';

                    if($pagelist_item_link_type ==  'interna') {
                        $link = $pagelist_item_page;
                    }
                    else {
                        $link = $pagelist_item_link;
                    }
                    if(!$link) {
                        $link = 'javascript:void(0);';
                    }
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 wow fadeInUp"><a href="<?php echo $link; ?>">
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
    set_query_var( 'rowFreeContentClone', 'cipet_' );
    get_template_part('templates/partials/rowFreeContent');

$args = array(
    'post_type' => 'noticia',
    'posts_per_page'   => 3,
    'meta_query' => array(
        array(
            'key' => 'news-group',
            'value' => 'cipet',
            'compare' => 'LIKE'
        )
    )
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
                        $loop->the_post();
                        $image = false;
                        $subtitle = get_field('news_subtitle');
                        if(have_rows('top_header')) {
                            while (have_rows('top_header')) {
                                the_row();
                                $image = get_sub_field('top_header_image');
                                if($image) {break;}
                            }
                        }
                        /*$tagsList = get_the_tags();
                        $tag = false;
                        if(count($tagsList) > 0) {
                            $tag = $tagsList[0]->name;
                        }*/
                        ?>
                        <div class="col-xs-12 col-sm-12 col-md-4 wow fadeInUp">
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
                                        if($subtitle) {
                                    ?>
                                    <span><?php echo $subtitle; ?></span>
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
                        <a class="btn wow fadeInUp" href="<?php echo esc_url(home_url('/cipet/noticias'))?>" target="_blank">Ver más</a>
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
set_query_var( 'rowFreeContentClone', 'cipet2_' );
get_template_part('templates/partials/rowFreeContent');

$sinagir_button_link = get_field('sinagir_button_link');
?>
<!--sinagir-->
<div class="section-row row-sinagir" id="descarga">
    <div class="container">
        <div class="row">
            <h2><?php echo get_field('sinagir_title'); ?></h2><img src="<?php echo get_field('sinagir_background')['url']; ?>">
        </div><a class="btn wow fadeInUp" href="<?php echo ($sinagir_button_link)? $sinagir_button_link['url'] : ''; ?>" target="_blank"><?php echo get_field('sinagir_button_label'); ?></a>
    </div>
</div>
<?php
$associateslist_title = get_field('cipet_associateslist_title');
if(have_rows('cipet_associatelist_list')) {
    $rows = array();
    while(have_rows('cipet_associatelist_list')) {
        the_row();
        array_push($rows, get_sub_field('associateslist_name'));
    }

    set_query_var( 'associateslist_title', $associateslist_title );
    set_query_var( 'associatelist_list', $rows );
    set_query_var( 'associatelist_setId', 'asociados' );

    get_template_part('templates/partials/associateListContent');
}
?>
<div class="section-row row-contacto" id="contacto" data-midnight="white">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <h2><?php echo get_field('cipet_contact_title'); ?></h2>
                <ul class="contacto">
                    <li><?php echo get_field('cipet_contact_address'); ?></li>
                    <li><?php echo get_field('cipet_contact_region'); ?></li>
                    <li><?php echo get_field('cipet_contact_phone'); ?></li>
                    <li class="big"><?php echo get_field('cipet_contact_register'); ?></li>
                    <li class="mail">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/home/im_contacto_mail.png" alt="email">
                        <a href="mailto:<?php echo get_field('cipet_contact_email'); ?>">
                            <?php echo get_field('cipet_contact_email'); ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <a class="iram" href="<?php echo get_field('cipet_contact_quality_link'); ?>">
                    <span><?php echo get_field('cipet_contact_quality_label'); ?></span>
                    <img class="iram"
                         src="<?php echo get_field('cipet_contact_quality_image')['url']; ?>"
                         alt="<?php echo get_field('cipet_contact_quality_image')['alt']; ?>">
                </a>
            </div>
            <div class="col-xs-hidden col-sm-hidden col-md-2">
                <?php display_contact_navigation('cipet-menu')?>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <a href="<?php echo get_field('cipet_contact_nac_link'); ?>" target="_blank">
                    <img class="registro"
                         src="<?php echo get_field('cipet_contact_nac_image')['url'] ?>"
                         alt="<?php echo get_field('cipet_contact_nac_image')['alt'] ?>">
                </a>
                <p><?php echo get_field('cipet_contact_nac_text'); ?></p>
                <a href="<?php echo get_field('cipet_contact_external_link') ?>" target="_blank"><img class="sec"
                         src="<?php echo get_field('cipet_contact_external_image')['url'] ?>"
                         alt="<?php echo get_field('cipet_contact_external_image')['alt'] ?>"></a><a href="<?php echo get_field('catamp_contact_external_link_2') ?>" target="_blank"><img class="min"
                         src="<?php echo get_field('cipet_contact_external_image_2')['url'] ?>"
                         alt="<?php echo get_field('cipet_contact_external_image_2')['alt'] ?>"></a>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>

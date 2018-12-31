<?php
/* Template Name: Home LNH */
get_header('lnh');
?>
<?php
set_query_var('mainHeaderContentClone', 'lnh_');
get_template_part('templates/partials/mainHeaderContent');
?>

<?php
$about_video_label = get_field('lnh_about-video-label');
$about_title = get_field('lnh_about-title');
$about_video_link = get_field('lnh_about-video-link');
$about_content = get_field('lnh_about-content');
set_query_var( 'about_video_label', $about_video_label );
set_query_var( 'about_title', $about_title );
set_query_var( 'about_video_link', $about_video_link );
set_query_var( 'about_content', $about_content );
get_template_part('templates/partials/aboutContent')
?>

<?php
$pagelist_background = get_field('lnh_pagelist_background');
?>
<div class="section-row row-services"
     style="background: url('<?php echo $pagelist_background['url'] ?>') center center no-repeat;background-size: cover;"
     id="servicios" data-midnight="white">
    <div class="container">
        <div class="row">
            <?php
                $pagelist_title = get_field('lnh_pagelist_title');
                    ?>
            <div class="col-xs-12">
                <h2><?php echo $pagelist_title; ?></h2>
            </div>
            <?php
            if( have_rows('lnh_pagelist_items') ) {
                while ( have_rows('lnh_pagelist_items') ) {
                    the_row();
                    $image = get_sub_field('pagelist_item_logo');
                    $title = get_sub_field('pagelist_item_title');
                    $content = get_sub_field('pagelist_item_content');
                    $pagelist_item_link_type = get_sub_field('pagelist_item_link_type');
                    $pagelist_item_link = get_sub_field('pagelist_item_link');
                    $pagelist_item_page = get_sub_field('pagelist_item_page');
                    $link = '';

                    if($pagelist_item_link_type == 'interna') {
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
$pagelist_background = get_field('lnh2_pagelist_background');
?>
<div class="section-row row-services"
     style="background: url('<?php echo $pagelist_background['url'] ?>') center center no-repeat;background-size: cover;"
     id="mercancias" data-midnight="red">
    <div class="container">
        <div class="row">
            <?php
            $pagelist_title = get_field('lnh2_pagelist_title');
            ?>
            <div class="col-xs-12">
                <h2><?php echo $pagelist_title; ?></h2>
            </div>
            <?php
            if( have_rows('lnh2_pagelist_items') ) {
                while ( have_rows('lnh2_pagelist_items') ) {
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
set_query_var( 'rowFreeContentClone', 'lnh_' );
get_template_part('templates/partials/rowFreeContent');

$args = array(
    'post_type' => 'noticia',
    'posts_per_page'   => 3,
    'meta_query' => array(
        array(
            'key' => 'news-group',
            'value' => 'lnh',
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
                    <h2>Cartelera</h2>
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
                        <a class="btn wow fadeInUp" href="<?php echo esc_url(home_url('/lnhcursos/noticias'))?>" target="_blank">Ver más</a>
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
set_query_var( 'rowFreeContentClone', 'lnh2_' );
get_template_part('templates/partials/rowFreeContent');


$associateslist_title = get_field('associateslist_title');
if(have_rows('associatelist_list')) {
    $rows = array();
    while(have_rows('associatelist_list')) {
        the_row();
        array_push($rows, get_sub_field('associateslist_name'));
    }

    $catamp_associateslist_title = get_field('catamp_associateslist_title');
    if(have_rows('catamp_associatelist_list')) {
        $adherente_rows = array();
        while(have_rows('catamp_associatelist_list')) {
            the_row();
            array_push($adherente_rows, get_sub_field('associateslist_name'));
        }

        set_query_var( 'associateslist2_title', $catamp_associateslist_title );
        set_query_var( 'associatelist2_list', $adherente_rows );
    }

    set_query_var( 'associateslist_title', $associateslist_title );
    set_query_var( 'associatelist_list', $rows );
    set_query_var( 'associatelist_setId', 'asociados' );

    get_template_part('templates/partials/associateListContent');
}

$academy_title = get_field('academy_title');
$academy_background = get_field('academy_background');
?>
<div class="section-row row-comision" id="comision" style="background-image:url(<?php echo $academy_background['url']; ?>);">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-7">
                <h2><?php echo $academy_title; ?></h2>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php
                        while (have_rows('academy_list')) {
                            the_row();
                            ?>
                            <div class="swiper-slide">
                                <div class="unidad">
                                    <div class="titulo"><span>Unidad Académica</span>
                                        <h4><?php echo get_sub_field('academy_item_title'); ?></h4>
                                    </div>
                                    <div class="texto">
                                        <?php echo get_sub_field('academy_item_content'); ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- Add Pagination-->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <figure class="cuaderno"><img src="<?php echo get_template_directory_uri(); ?>/images/home/im_cuaderno.png" alt="noticia3"></figure>
        </div>
    </div>
</div>
<div class="section-row row-contacto" id="contacto" data-midnight="white">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <h2><?php echo get_field('lnh_contact_title'); ?></h2>
                <ul class="contacto">
                    <li class="hidden"><?php echo get_field('lnh_contact_address'); ?></li>
                    <li class="hidden"><?php echo get_field('lnh_contact_region'); ?></li>
                    <li class="hidden"><?php echo get_field('lnh_contact_phone'); ?></li>
                    <li class="big hidden"><?php echo get_field('lnh_contact_register'); ?></li>
                    <li class="mail">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/home/im_contacto_mail.png" alt="email">
                        <a href="mailto:<?php echo get_field('lnh_contact_email'); ?>">
                            <?php echo get_field('lnh_contact_email'); ?>
                        </a>
                    </li>
                </ul>
                <div class="whatsapp"><a class="btn" href="https://api.whatsapp.com/send?phone=<?php echo str_replace(' ', '',get_field('lnh_contact_whatsapp_button')); ?>" target="_blank"> <i class="fab fa-whatsapp"></i>+<?php echo get_field('lnh_contact_whatsapp_button') ?>  </a><span><?php echo get_field('lnh_contact_time') ?></span></div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 hidden">
                <a class="iram" href="<?php echo get_field('lnh_contact_quality_link'); ?>">
                    <span><?php echo get_field('lnh_contact_quality_label'); ?></span>
                    <img class="iram"
                         src="<?php echo get_field('lnh_contact_quality_image')['url']; ?>"
                         alt="<?php echo get_field('lnh_contact_quality_image')['alt']; ?>">
                </a>
            </div>
            <div class="col-xs-hidden col-sm-hidden col-md-4">
                <?php display_contact_navigation('lnhcursos-menu')?>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <a href="<?php echo get_field('lnh_contact_nac_link'); ?>" target="_blank">
                    <img class="registro"
                         src="<?php echo get_field('lnh_contact_nac_image')['url'] ?>"
                         alt="<?php echo get_field('lnh_contact_nac_image')['alt'] ?>">
                </a>
                <a href="<?php echo get_field('lnh_contact_external_link') ?>" target="_blank"><img class="faadeac"
                         src="<?php echo get_field('lnh_contact_external_image')['url'] ?>"
                         alt="<?php echo get_field('lnh_contact_external_image')['alt'] ?>"></a>
                <a href="<?php echo get_field('lnh_contact_external_link_2') ?>" target="_blank"><img class="fpt"
                         src="<?php echo get_field('lnh_contact_external_image_2')['url'] ?>"
                         alt="<?php echo get_field('lnh_contact_external_image_2')['alt'] ?>"></a>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>

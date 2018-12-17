<?php
/* Template Name: Home Catamp */
get_header();
?>
<?php
get_template_part('templates/partials/mainHeaderContent')
?>

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
<div class="popup popup-youtube">
    <div class="inner">
        <div class="close">X</div>
        <iframe width="100%" height="100%" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>
<?php
$pagelist_background = get_field('pagelist_background');
?>
<div class="section-row row-services"
     style="background: url('<?php echo $pagelist_background['url'] ?>') center center no-repeat;background-size: cover;"
     id="servicios" data-midnight="white">
    <div class="container">
        <div class="row">
            <?php
                $pagelist_title = get_field('pagelist_title');
                    ?>
            <div class="col-xs-12">
                <h2><?php echo $pagelist_title; ?></h2>
            </div>
            <?php
            if( have_rows('pagelist_items') ) {
                while ( have_rows('pagelist_items') ) {
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
    'meta_query' => array(
        array(
            'key' => 'news-group',
            'value' => 'catamp',
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
set_query_var( 'rowFreeContentClone', 'clone_' );
get_template_part('templates/partials/rowFreeContent');

if(have_rows('directorylist')) {
    ?>
    <div class="section-row row-comision" id="comision" data-midnight="gray">
        <?php
            $directorylist = array();
            while(have_rows('directorylist')) {
                the_row();
                $members = array();
                while (have_rows('directorylist_members')) {
                    the_row();
                    $member = array(
                            "directorylist_member_name" => get_sub_field('directorylist_member_name'),
                            "directorylist_member_position" => get_sub_field('directorylist_member_position'),
                            "directorylist_member_slider" => get_sub_field('directorylist_member_slider'),
                            "directorylist_member_photo" => get_sub_field('directorylist_member_photo'),
                            "directorylist_member_description" => get_sub_field('directorylist_member_description'),
                    );
                    array_push($members, $member);
                }

                $sectors = array(
                        "title" => get_sub_field('directorylist_title'),
                        "members" => $members
                );

                array_push($directorylist, $sectors);
            }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-lg-7">
                    <h2><?php echo $directorylist[0]['title']; ?></h2>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php
                            for ($i = 0; $i < count($directorylist); $i++) {
                                foreach ($directorylist[$i]['members'] as $members) {
                                    if($members['directorylist_member_slider']) {
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="chabon">
                                            <div class="top clearfix">
                                                <div class="photo" style="background-image:url(<?php echo $members['directorylist_member_photo']['url'];?>);"></div>
                                                <div class="texto">
                                                    <h5><?php echo $members['directorylist_member_name'];?></h5>
                                                    <h6><?php echo $members['directorylist_member_position'];?></h6>
                                                </div>
                                            </div>
                                            <div class="bottom">
                                                <p><?php echo $members['directorylist_member_description'];?></p>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                        <!-- Add Pagination-->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12 col-lg-5">
                    <div class="comision-box">
                        <?php
                        for ($i = 0; $i < count($directorylist); $i++) {
                            ?>
                            <h3><?php echo $directorylist[$i]['title']; ?></h3>
                            <ul class="comision clearfix">
                                <?php
                                foreach($directorylist[$i]['members'] as $member) {
                                    ?>
                                    <li>
                                        <p>
                                            <span><?php echo $member['directorylist_member_name'];?></span>
                                            <label><?php echo $member['directorylist_member_position'];?></label>
                                        </p>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}

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
?>
<div class="section-row row-contacto" id="contacto" data-midnight="white">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <h2><?php echo get_field('catamp_contact_title'); ?></h2>
                <ul class="contacto">
                    <li><?php echo get_field('catamp_contact_address'); ?></li>
                    <li><?php echo get_field('catamp_contact_region'); ?></li>
                    <li><?php echo get_field('catamp_contact_phone'); ?></li>
                    <li class="big"><?php echo get_field('catamp_contact_register'); ?></li>
                    <li class="mail">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/home/im_contacto_mail.png" alt="email">
                        <a href="mailto:<?php echo get_field('catamp_contact_email'); ?>">
                            <?php echo get_field('catamp_contact_email'); ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <a class="iram" href="<?php echo get_field('catamp_contact_quality_link'); ?>">
                    <span><?php echo get_field('catamp_contact_quality_label'); ?></span>
                    <img class="iram"
                         src="<?php echo get_field('catamp_contact_quality_image')['url']; ?>"
                         alt="<?php echo get_field('catamp_contact_quality_image')['alt']; ?>">
                </a>
            </div>
            <div class="col-xs-hidden col-sm-hidden col-md-2">
                <?php display_contact_navigation('catamp-menu')?>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <a href="<?php echo get_field('catamp_contact_nac_link'); ?>" target="_blank">
                    <img class="registro"
                         src="<?php echo get_field('catamp_contact_nac_image')['url'] ?>"
                         alt="<?php echo get_field('catamp_contact_nac_image')['alt'] ?>">
                </a>
                <a href="<?php echo get_field('catamp_contact_external_link') ?>" target="_blank"><img class="faadeac"
                         src="<?php echo get_field('catamp_contact_external_image')['url'] ?>"
                         alt="<?php echo get_field('catamp_contact_external_image')['alt'] ?>"></a><a href="<?php echo get_field('catamp_contact_external_link_2') ?>" target="_blank"><img class="fpt"
                         src="<?php echo get_field('catamp_contact_external_image_2')['url'] ?>"
                         alt="<?php echo get_field('catamp_contact_external_image_2')['alt'] ?>"></a>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>


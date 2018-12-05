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
?>

<?php get_footer(); ?>


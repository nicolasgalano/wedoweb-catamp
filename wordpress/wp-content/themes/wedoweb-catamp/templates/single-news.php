<?php

$images = array();
if(have_rows('top_header')) {
    while (have_rows('top_header')) {
        the_row();
        $images[] = get_sub_field('top_header_image');
    }
}
?>

<?php
if(count($images) == 1) {
?>
<div class="section-row row-noticias" data-midnight="white">
    <!-- Swiper-->
    <?php
    foreach ($images as $img) {
    ?>
    <div class="one-slide" style="background-image:url(<?php echo $img['url']?>);">
    </div>
    <?php
    }
    ?>
</div>
<?php
}else if(count($images)){
?>
<div class="section-row row-noticias" data-midnight="white">
    <!-- Swiper-->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php
            foreach ($images as $img) {
            ?>
            <div class="swiper-slide" style="background-image:url(<?php echo $img['url']?>);">
                <div class="sw-inner"></div>
            </div>
            <?php
            }
            ?>
        </div>
        <!-- Add Pagination-->
        <div class="swiper-pagination"></div>
    </div>
</div>
<?php
}
?>


<div class="section-row row-inner inner-noticias">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8">
                <?php echo the_content();?>
            </div>
            <div class="col-sm-12 col-md-4">
                <?php
                $tagsList = get_the_tags();
                if($tagsList){
                ?>
                <div class="tags">

                    <h4>Etiquetas relaciondas:</h4>

                    <ul class="clearfix">
                    <?php
                    foreach ($tagsList as $tag) {
                    ?>
                        <li><a href="<?php echo esc_url(home_url('/noticias/tag/'.$tag->slug)) ?>"><?php echo $tag->name ?></a></li>
                    <?php
                    }
                    ?>
                    </ul>

                </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</div>

<?php
global $wpdb;
$newGroup = ($headerType == '')? 'catamp' : $headerType;
$newGroup = ($headerType == 'lnh')? 'lnhcursos' : $headerType;

$prevAdjacentPost = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts p 
              INNER JOIN {$wpdb->prefix}postmeta pm
              ON pm.post_id = p.ID
              WHERE 
              pm.meta_key = 'news-group' AND pm.meta_value LIKE '%{$newGroup}%' AND
              p.ID < {$post->ID} AND 
              p.post_status = 'publish'
              ORDER BY p.post_date DESC limit 1", OBJECT );

$nextAdjacentPost = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts p 
              INNER JOIN {$wpdb->prefix}postmeta pm
              ON pm.post_id = p.ID
              WHERE 
              pm.meta_key = 'news-group' AND pm.meta_value LIKE '%{$newGroup}%' AND
              p.ID > {$post->ID} AND 
              p.post_status = 'publish'
              ORDER BY p.post_date DESC limit 1", OBJECT );

$nextPostId = (count($nextAdjacentPost))? $nextAdjacentPost[0]->ID : false;
$prevPostId = (count($prevAdjacentPost))? $prevAdjacentPost[0]->ID : false;

if($nextPostId || $prevPostId) {
?>
    <div class="posts-links">
        <?php
        if($prevPostId) {
            $permalink = get_the_permalink($prevPostId);
            $title = get_the_title($prevPostId);
            $image = false;
            if(have_rows('top_header', $prevPostId)) {
                while (have_rows('top_header', $prevPostId)) {
                    the_row();
                    $image = get_sub_field('top_header_image');
                    if($image) {break;}
                }
            }
            ?>
            <a class="prev-post" href="<?php echo $permalink; ?>"
               style="background-image:url(<?php echo $image['sizes']['large']?>);">
                <div class="inner-link"><span>Anterior noticia</span>
                    <h5><?php echo $title; ?></h5>
                </div>
            </a>
            <?php
        }
        ?>

        <?php
        if($nextPostId) {
            $permalink = get_the_permalink($nextPostId);
            $title = get_the_title($nextPostId);
            $image = false;
            if(have_rows('top_header', $nextPostId)) {
                while (have_rows('top_header', $nextPostId)) {
                    the_row();
                    $image = get_sub_field('top_header_image');
                    if($image) {break;}
                }
            }
            ?>
            <a class="next-post" href="<?php echo $permalink; ?>"
               style="background-image:url(<?php echo $image['sizes']['large']?>);">
                <div class="inner-link"><span>Próxima noticia</span>
                    <h5><?php echo $title; ?></h5>
                </div>
            </a>
            <?php
        }
        ?>

    </div>
<?php
}
?>

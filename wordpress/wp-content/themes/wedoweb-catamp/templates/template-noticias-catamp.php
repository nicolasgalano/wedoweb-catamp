<?php
/* Template Name: Noticias Catamp */
get_header();
$tag = get_query_var('tags');

if(!$tag) {
    ?>
    <div class="section-row row-news" id="noticias">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2>Noticias</h2>
                </div>
                <?php
                $args = array(
                    'post_type' => 'noticia',
                    'posts_per_page'   => -1,
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
                                    if($subtitle) {
                                        ?>
                                        <span><?php echo $subtitle ?></span>
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
                }
                ?>
            </div>
        </div>
    </div>
<?php
}
else {

?>
<div class="section-row row-news" id="noticias">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2>Noticias</h2>
            </div>
            <?php
            $args = array(
                'post_type' => 'noticia',
                'posts_per_page'   => -1,
                'tag' => $tag,
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
                <div class="col-xs-12">
                    <h4>CATAMP</h4>
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
                                if($subtitle) {
                                    ?>
                                    <span><?php echo $subtitle ?></span>
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
            }
            wp_reset_query();

            ?>

            <?php
            $args = array(
                'post_type' => 'noticia',
                'posts_per_page'   => -1,
                'tag' => $tag,
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
                <div class="col-xs-12">
                    <h4>CIPET</h4>
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
                                if($subtitle) {
                                    ?>
                                    <span><?php echo $subtitle ?></span>
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
            }
            wp_reset_query();
            ?>

            <?php
            $args = array(
                'post_type' => 'noticia',
                'posts_per_page'   => -1,
                'tag' => $tag,
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
                <div class="col-xs-12">
                    <h4>LNH Cursos</h4>
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
                                if($subtitle) {
                                    ?>
                                    <span><?php echo $subtitle ?></span>
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
            }
            wp_reset_query();
            ?>
        </div>
    </div>
</div>
<?php
}
?>

<?php get_footer(); ?>

<?php
/* Template Name: Noticias Catamp */
get_header();
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
                }
                    ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>
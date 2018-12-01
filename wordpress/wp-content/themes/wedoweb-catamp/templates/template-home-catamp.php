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
<?php get_footer(); ?>


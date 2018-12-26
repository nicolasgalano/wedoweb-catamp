<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>

	</head>
	<body <?php body_class(); ?>>
    <nav>
        <h1><a href="<?php echo esc_url(home_url('/')); ?>"></a></h1><a class="btn-menu open-menu" href="javascript:;"></a>
        <ul class="redes">
            <?php
            if(get_option('facebook_catamp')) {
                ?>
                <li class="facebook"><a href="<?php echo get_option('facebook_catamp'); ?>" target="_blank"><i
                                class="fab fa-facebook-f"></i></a></li>
                <?php
            }
            if(get_option('instagram_catamp')) {
                ?>
                <li class="instagram"><a href="<?php echo get_option('instagram_catamp'); ?>" target="_blank"><i
                                class="fab fa-instagram"></i></a></li>
                <?php
            }
            if(get_option('twitter_catamp')){
                ?>
                <li class="twitter"><a href="<?php echo get_option('twitter_catamp'); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
            <?php
            }
            ?>
        </ul>
    </nav>
    <div class="menu clearfix"><a class="btn-menu close-menu" href="javascript:;"></a>
        <!--<ul>
            <li><a href="index.html#about">¿QUE ES CATAMP?</a></li>
            <li><a href="index.html#servicios">SERVICIOS</a></li>
            <li><a href="index.html#asociate">ASOCIATE</a></li>
            <li><a href="index.html#noticias">NOTICIAS</a></li>
            <li><a href="index.html#comision">COMISIÓN DIRECTIVA</a></li>
            <li><a href="index.html#asociados">ASOCIADOS</a></li>
            <li><a href="index.html#contacto">CONTACTO</a></li>
        </ul>-->
        <?php display_navigation('catamp-menu')?>

    </div>
			<!-- /header -->

<footer>
    <div class="container-fluid">
        <a class="logo" href="<?php echo esc_url(home_url('')); ?>/">
            <img src="<?php echo get_template_directory_uri(); ?>/images/home/im_footer_logo.png">
        </a>
        <p class="copyright"><?php echo get_option('copyright_catamp'); ?></p>
        <ul class="redes">
            <?php
            if(get_option('facebook_catamp')) {
            ?>
                <li class="facebook"><a href="<?php echo get_option('facebook_catamp'); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
            <?php
            }
            if(get_option('instagram_catamp')) {
            ?>
                <li class="instagram"><a href="<?php echo get_option('instagram_catamp'); ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
            <?php
            }
            if(get_option('twitter_catamp')){
            ?>
                <li class="twitter"><a href="<?php echo get_option('twitter_catamp'); ?>" target="_blank"><i class="fab fa-twitter">    </i></a></li>
            <?php
            }
            ?>
        </ul>
    </div>
</footer>
<?php wp_footer(); ?>
	</body>
</html>

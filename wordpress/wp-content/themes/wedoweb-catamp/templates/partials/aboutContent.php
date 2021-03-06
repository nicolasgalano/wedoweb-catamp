<div class="section-row row-about" id="about" data-midnight="defaultt">
    <div class="container">
        <div class="row">
            <?php
                if($about_video_link) {
                    ?>
                    <div class="col-xs-12 col-sm-9 col-md-6 wow fadeInLeft">
                        <h2><?php echo $about_title; ?></h2>
                        <?php echo $about_content; ?>
                    </div>
                    <div class="col-xs-12 col-sm-9 col-md-6 wow fadeInRight">
                        <div class="multimedia open-popup-youtube" data-youtube="<?php echo $about_video_link; ?>"><?php if($about_video_label) {?><span><?php echo $about_video_label; ?></span><?php } ?></div>
                    </div>
            <?php
                } else {
                    ?>
                    <div class="col-xs-12 wow fadeInLeft">
                        <h2><?php echo $about_title; ?></h2>
                        <?php echo $about_content; ?>
                    </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>
<div class="popup popup-youtube">
    <div class="inner">
        <div class="close">X</div>
        <iframe width="100%" height="100%" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>

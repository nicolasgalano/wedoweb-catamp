(function($) {

    $(document).ready(function(){

        // Change this to the correct selector.
        $('nav').midnight();

        //NAV BEHAVIOUR
        $('.open-menu').click(function(e){

            $( "div.menu" ).animate({
                opacity: 1,
                right: "+=300",
                height: "toggle"
            }, 500, function() {
                // Animation complete.
            });
        });
        $('.close-menu').click(function(e){
            $( "div.menu" ).animate({
                opacity: 0,
                right: "-=300",
                height: "toggle"
            }, 500, function() {
                // Animation complete.
            });
        });
        $('.menu li a').click(function(e){
            $( "div.menu" ).animate({
                opacity: 0,
                right: "-=300",
                height: "toggle"
            }, 500, function() {
                // Animation complete.
            });
        });



        //SMOOTH SCROLL
        var $stupid = $('<div></div>')
          .height(1)
          .hide()
          .appendTo('body');
        var mobileHack = function() {
          $stupid.show();
          setTimeout(function() {
            $stupid.hide();
          }, 10);
        };
        $('a').smoothScroll({
          afterScroll: mobileHack
        });


        //SWIPER
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });

    });

})(jQuery);

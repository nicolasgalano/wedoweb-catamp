(function($) {

    $(document).ready(function(){

        // Change this to the correct selector.
        $('nav.container-fluid').midnight();

        //NAV BEHAVIOUR
        $('.open-menu').click(function(e){

            $( "div.menu" ).animate({
                opacity: 1,
                right: "+=300",
                height: "toggle"
            }, 1000, function() {
                // Animation complete.
            });
        });
        $('.close-menu').click(function(e){
            $( "div.menu" ).animate({
                opacity: 0,
                right: "-=300",
                height: "toggle"
            }, 1000, function() {
                // Animation complete.
            });
        });
        $('.menu li a').click(function(e){
            $( "div.menu" ).animate({
                opacity: 0,
                right: "-=300",
                height: "toggle"
            }, 1000, function() {
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


    });

})(jQuery);

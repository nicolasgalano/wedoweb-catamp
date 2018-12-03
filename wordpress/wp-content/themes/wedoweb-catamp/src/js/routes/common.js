// import navbarMenu from '../navbar-menu';
// import svganimations from '../svganimations';

export default {
    init() {
        // JavaScript to be fired on all pages
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

        //SWIPER
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });

    },
    finalize() {
        // JavaScript to be fired on all pages, after page specific JS is fired
    },
};
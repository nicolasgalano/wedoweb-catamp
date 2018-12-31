// import navbarMenu from '../navbar-menu';
// import svganimations from '../svganimations';

export default {
    init() {
        // JavaScript to be fired on all pages
        // Change this to the correct selector.
        $('nav').midnight();

        $('.open-popup-youtube').click(function(){
            $('.popup-youtube iframe').attr('src',$(this).data('youtube')+'?autoplay=1');
            $('.popup-youtube').addClass('opened');
        });
        //Popups
        $('.popup .close').click(function(e){
            $(this).parent().parent().removeClass('opened');
            $('.popup-youtube iframe').attr('src','');
        });

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
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
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

        //PREGUNTAS
        $('.pregunta-item .pregunta').click(function(){
            $(this).parent().toggleClass('opened');
        });

        //WOW
        var wow = new WOW(
            {
                animateClass: 'animated',
                offset: 0,
                callback: function(box) {
                    console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
                }
            }
        );
        wow.init();

    },
    finalize() {
        // JavaScript to be fired on all pages, after page specific JS is fired
    },
};

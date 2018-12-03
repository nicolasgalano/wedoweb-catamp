export default {
    init() {
//Popups
        $('.open-popup-youtube').click(function(){
            $('.popup-youtube iframe').attr('src',$(this).data('youtube')+'?autoplay=1');
            $('.popup-youtube').addClass('opened');
        });
        //Popups
        $('.popup .close').click(function(e){
            $(this).parent().parent().removeClass('opened');
            $('.popup-youtube iframe').attr('src','');
        })






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
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });

        $('.pregunta-item .pregunta').click(function(){
            console.log('asdasd');
            $(this).parent().toggleClass('opened');
        });
    },
    finalize() {
        // JavaScript to be fired on all pages, after page specific JS is fired
    },
};
export default {
    init() {

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

        //PREGUNTAS
        $('.pregunta-item .pregunta').click(function(){
            $(this).parent().toggleClass('opened');
        });

    },
    finalize() {
        // JavaScript to be fired on all pages, after page specific JS is fired
    },
};

// import navbarMenu from '../navbar-menu';
// import svganimations from '../svganimations';

export default {
    init() {
        // JavaScript to be fired on all pages

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
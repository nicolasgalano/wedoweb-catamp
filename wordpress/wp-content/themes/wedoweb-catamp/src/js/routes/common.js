import navbarMenu from '../navbar-menu';
import svganimations from '../svganimations';

export default {
    init() {
        // JavaScript to be fired on all pages
        svganimations();
        navbarMenu();
    },
    finalize() {
        // JavaScript to be fired on all pages, after page specific JS is fired
    },
};
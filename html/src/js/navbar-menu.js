/**
 * Created by Juan on 6/7/2017.
 */

(function($) {

    new WOW().init();

    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };
    var $body = $('body');
    var $document = $(document);
    var $navBar = $('#top-nav');
    var changeNavbar = debounce(function() {

        if( !$navBar.hasClass('navbar-bg') && $document.scrollTop() >= 10 ) {
            $navBar.addClass('navbar-bg');
        }
        else if($document.scrollTop() < 10) {
            $navBar.removeClass('navbar-bg');
        }
        
    }, 250);
    window.addEventListener('scroll', changeNavbar);
    changeNavbar();

    $('#navbarMenu').on('show.bs.collapse', function (e) {
        e.preventDefault();
        /*
        var $element = $(e.target);
        var $trigger = $('.navbar-toggle');

        $trigger
            .removeClass('collapsed')
            .attr('aria-expanded', true);
        $element
            .removeClass('collapse')
            .addClass('sliding')
            .attr('aria-expanded', true);

        $el = $element.find('.navbar-nav li:last');
        $el.one('webkitAnimationEnd mozAnimationEnd oAnimationEnd oanimationend animationend', function(){
            $element
                .removeClass('sliding')
                .addClass('collapse in');
            $el.off('webkitAnimationEnd mozAnimationEnd oAnimationEnd oanimationend animationend');
        });
        */
    });

    $('#navbarMenu').on('hide.bs.collapse', function (e) {
        e.preventDefault();
        /*
        var $element = $(e.target);
        var $trigger = $('.navbar-toggle');

        $trigger
            .addClass('collapsed')
            .attr('aria-expanded', false);

        $element
            .removeClass('collapse in')
            .addClass('sliding-out')
            .attr('aria-expanded', false);

        $el = $element.find('.navbar-nav li:first');
        $el.one('webkitAnimationEnd mozAnimationEnd oAnimationEnd oanimationend animationend', function(){
            $element
                .removeClass('sliding-out')
                .addClass('collapse');

            $el.off('webkitAnimationEnd mozAnimationEnd oAnimationEnd oanimationend animationend');
        });
        */
    });
})(jQuery);

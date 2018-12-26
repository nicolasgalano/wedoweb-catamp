(function($) {
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

    var boletin = $('.boletin');
    if(boletin.length > 0) {
        var boletinSearch = boletin.find('input[name="boletinSearch"]');
        var allBoletin = JSON.parse(boletin.find('#allBoletin').val());
        var form = boletin.find('form');
        var termContainer = boletin.find('.term');
        var emptyContainer = boletin.find('.empty-container');

        form.on('submit', ev => {
           ev.preventDefault();
        });

        var boletinCount = allBoletin.length;

        var myEfficientFn = debounce(function() {
            var searchVal = boletinSearch.val();

            termContainer.html(searchVal);
            searchVal = (searchVal)? searchVal.toLowerCase() : '';

            if(searchVal) {
                allBoletin.forEach(obj => {
                    if(obj.title.toLowerCase().includes(searchVal) || obj.content.toLowerCase().includes(searchVal)) {
                        $('#boletin_'+obj.id).show();
                    }
                    else {
                        $('#boletin_'+obj.id).hide();
                    }
                })
            }
            else {
                boletin.find('article').show();
            }

            var totalHidden = boletin.find('article:hidden').length;
            if(totalHidden == boletinCount) {
                emptyContainer.removeClass('hide');
            }
            else {
                emptyContainer.addClass('hide');
            }
        }, 500);
        boletinSearch.on('keyup', myEfficientFn)
    }
}(jQuery));

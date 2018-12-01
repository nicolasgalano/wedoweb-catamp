/**
 * Created by Juan on 5/13/2018.
 */
export default {
    init() {
        console.log('init');
        $('.collaborator-item .read-more').click(function (e) {

            if(! $(this).parent().hasClass('active')){
                $('.collaborator-item').removeClass('active');
                $('.collaborator-item .read-more').text('Read More >');
                $(this).parent().addClass('active');
                $(this).text('Show Less >');
            }else{
                $('.collaborator-item').removeClass('active');
                $('.collaborator-item .read-more').text('Read More >');
            }

        });
    },
    finalize() {

    }
}
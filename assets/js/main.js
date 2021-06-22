$(document).ready(function () {
    $('.sidebar-collapse').click(function () {
        if($(this).find('.sidebar-sublist').hasClass('active')) {
            $(this).find('.sidebar-sublist').removeClass('active');
            $(this).find('.fa-angle-left').removeClass('active')
        } else {
            $(this).find('.sidebar-sublist').addClass('active');
            $(this).find('.fa-angle-left').addClass('active')
        }
    });
    
    $('.mobile-list-btn').click(function () {
        if($('.sidebar').css('display') == 'none') {
            $('.sidebar').css('display', 'block');
        } else {
            $('.sidebar').css('display', 'none');
        }
    });
});
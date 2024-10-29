// custom.js
//sidebar
$(document).ready(function(){
    $('.sub-btn').click(function(){
        $(this).next('.sub-menu').slideToggle();
        $(this).find('.dropdown').toggleClass('up-arrow');
        $(this).parent().siblings().find('.sub-menu').slideUp();
    });
    
});
//sidebar

//Add akunpengajar
$(document).ready(function() {
    $('#namaP').change(function() {
        var noPengajar = $(this).find(':selected').data('nopengajar');
        $('#username').val(noPengajar);
    });
});
//Add akunpengajar
// add aku murid

// add aku murid
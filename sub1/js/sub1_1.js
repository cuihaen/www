$('#content .openPop').click(function(e){
    e.preventDefault();
    
    $('#content .modal_box').fadeIn('fast');
    $('#content .sub_popup').fadeIn('slow');
    
});

$('.sub_close_btn,#content .modal_box').click(function(e){
    e.preventDefault();
    $('#content .modal_box').hide();
    $('#content .sub_popup').hide();
});
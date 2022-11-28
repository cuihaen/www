$('#content .subPop_menu .openPop').click(function(e){
    e.preventDefault();

    var ind = $(this).index('#content .subPop_menu .openPop');  // 0 1 2 3
    
    $('#content .modal_box').fadeIn('fast');
    if(ind==0){
        $('#content .popup0').fadeIn('slow');
    }else if(ind==1){
        $('#content .popup1').fadeIn('slow');
    }
});

$('.sub_close_btn,#content .modal_box').click(function(e){
    e.preventDefault();
    $('#content .modal_box').hide();
    $('#content .sub_popup').hide();
});
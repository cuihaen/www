var ind = 0;
$('#content .subPop_menu .openPop').click(function(e){
    e.preventDefault();

    ind= $(this).index('#content .subPop_menu .openPop');  // 0 1 2 3 4
    
    $('.sub_pop_btn').fadeIn('slow');
    $('#content .sub_modal_box').fadeIn('fast');
    if(ind==0 ||ind==1||ind==2||ind==3||ind==4){
        $('#content .popup_'+ind).fadeIn('slow');
    }
});

$('.sub_pop_btn .pre').click(function(e){
    e.preventDefault();
    if(ind>-4){
        $('.subPop .sub_popup:eq('+ind+')').hide();
        $('.subPop .sub_popup:eq('+(ind-1)+')').fadeIn('slow');
        ind--;
    }else if(ind==-4){
        $('.subPop .sub_popup:eq('+ind+')').hide();
        $('.subPop .sub_popup:eq(0)').fadeIn('slow');
        ind=0;
    }
});

$('.sub_pop_btn .next').click(function(e){
    e.preventDefault();
    if(ind<=3){
        $('.subPop .sub_popup:eq('+ind+')').hide();
        $('.subPop .sub_popup:eq('+(ind+1)+')').fadeIn('slow');
        ind++;
    }else if(ind==4){
        $('.subPop .sub_popup:eq(4)').hide();
        $('.subPop .sub_popup:eq(0)').fadeIn('slow');
        ind=0;
    }
});

$('.sub_close_btn,.subPop .sub_modal_box').click(function(e){
    e.preventDefault();
    $('.subPop .sub_modal_box').fadeOut('fast');
    $('.subPop .sub_popup').fadeOut('fast');
    $('.sub_pop_btn').fadeOut('fast');
});


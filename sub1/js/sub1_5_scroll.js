
$('.contentArea h3:eq(0)').addClass('spy');  //첫번째 서브메뉴 활성화

var smh= 667;  //메인 비주얼의 높이
var h1= smh+$('.contentArea .con1').height();
var h2= smh+$('.contentArea .con1').height()+$('.contentArea .con2').height();


$(window).on('scroll',function(){
    var scroll = $(window).scrollTop();

    if(scroll>smh+267){ 
        $('.contentArea .stickyMenuBox').css('display','block');
        $('.contentArea h3').addClass('tabOn');
        $('header').hide();
    }else{
        $('.contentArea .stickyMenuBox').css('display','none');
        $('.contentArea h3').removeClass('tabOn');
        $('header').show();
    }

    $('#content').find('h3').removeClass('spy'); //모든 서브메뉴 비활성화



    if(scroll<=smh+100){
        $('#content h3').find('a').css('color','#333').css('border-color','#ccc');
        $('#content h3').find('a').hover(function(){
            $(this).css('color','#fff').css('border-color','rgba(12,60,78,.8)');
        },function(){
            $(this).css('color','#333').css('border-color','#ccc');
        });
    }else if(scroll>=smh+100 && scroll<h1){
        $('#content h3').find('a').css('border-color','rgba(255,255,255,0)');
        $('#content .con1').find('h3').addClass('spy');
        $('#content h3').find('a').css('color','#fff').css('border-color','rgba(0,0,0,0)');
        $('#content h3').find('a').hover(function(){
            $(this).css('color','#1b8ab3').css('border-color','rgba(12,60,78,.2)');
        },function(){
            $(this).css('color','#fff').css('border-color','rgba(0,0,0,0)');
            $('.spy').find('a').css('color','#1b8ab3');
        });
        $('#content .link1').css('color','#1b8ab3');
        
    }else if(scroll>=h1 && scroll<h2){
        $('#content').find('h3').removeClass('spy');
        $('#content .con2').find('h3').addClass('spy');
        $('#content h3').find('a').css('color','#fff').css('border-color','rgba(0,0,0,0)');
        $('#content h3').find('a').hover(function(){
            $(this).css('color','#1b8ab3').css('border-color','rgba(12,60,78,.2)');
        },function(){
            $(this).css('color','#fff').css('border-color','rgba(0,0,0,0)');
            $('.spy').find('a').css('color','#1b8ab3');
        });
        $('#content .link2').css('color','#1b8ab3');
    }else if(scroll>=h2){
        $('#content').find('h3').removeClass('spy');
        $('#content .con3').find('h3').addClass('spy');
        $('#content h3').find('a').css('color','#fff').css('border-color','rgba(0,0,0,0)');
        $('#content h3').find('a').hover(function(){
            $(this).css('color','#1b8ab3').css('border-color','rgba(12,60,78,.2)');
        },function(){
            $(this).css('color','#fff').css('border-color','rgba(0,0,0,0)');
            $('.spy').find('a').css('color','#1b8ab3');
        });
        $('#content .link3').css('color','#1b8ab3');
    }
});



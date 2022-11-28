
$(document).ready(function() {

   var smh=$('.main').height(); //비주얼 이미지의 높이를 리턴한다   965px
   var on_off=false;  //false(안오버)  true(오버)
   
       $('#headerArea').mouseenter(function(){
          // var scroll = $(window).scrollTop();
           $(this).css('background','rgba(255,255,255,1)');
           $('.dropdownmenu li.menu h3 a').css('color','#333');
           $('.topMenu li a').css('color','#333');       
           on_off=true;
       });
    
      $('#headerArea').mouseleave(function(){
           var scroll = $(window).scrollTop();  //스크롤의 거리
           
           if(scroll<smh-180){//스크롤 smh-180까지 내리면
               $(this).css('background','none').css('border-bottom','none');
               $('.dropdownmenu li.menu h3 a').css('color','#fff');
               $('.topMenu li a').css('color','#fff');  
               $('.topMenu li:nth-child(1)::after').css('background','#fff'); 
           }else{
               $(this).css('background','none)'); 
               $('.dropdownmenu li.menu h3 a').css('color','#333');
               $('.topMenu ul li a').css('color','#333');
               $('.topMenu li a').css('color','#333');  
               $('.topMenu li:nth-child(1)::after').css('background','#333');    
           }
          on_off=false;    
      });
      
      $(window).on('scroll',function(){//스크롤의 거리가 발생하면
           var scroll = $(window).scrollTop();  //스크롤의 거리를 리턴하는 함수
           //console.log(scroll);

           if(scroll>smh-180){//스크롤300까지 내리면
               $('#headerArea').css('background','rgba(255,255,255,1)').css('box-shadow','3px 3px 15px 1px rgba(0,0,0,.08)');
               $('#headerArea').addClass('on');
               $('.dropdownmenu li.menu h3 a').css('color','#333');
               $('.topMenu li a').css('color','#333');
               $('.topMenu li:nth-child(1)::after').css('background','#333');

           }else{//스크롤 내리기 전 디폴트(마우스올리지않음)
              if(on_off==false){
                   $('#headerArea').css('background','none').css('box-shadow','none');
                   $('#headerArea').removeClass('on');
                   $('#headerArea .headerInnder h1 a').css('background','url(../svg/samyang_CI.svg) 0 50% no-repeat');
                   $('.dropdownmenu li.menu h3 a').css('color','#fff');
                   $('.topMenu li a').css('color','#fff');  
                   $('.topMenu li:nth-child(1)::after').css('background','#fff');  
              }
           }; 
           
        });

  
    //2depth 열기/닫기
    $('ul.dropdownmenu').hover(
       function() { 
          $('ul.dropdownmenu li.menu ul').fadeIn('normal',function(){$(this).stop();}); //모든 서브를 다 열어라
          $('#headerArea').animate({height:400},'fast').clearQueue();
       },function() {
          $('ul.dropdownmenu li.menu ul').hide(); //모든 서브를 다 닫아라
          $('#headerArea').animate({height:142},'fast').clearQueue();
     });
    
     //1depth 효과
     $('ul.dropdownmenu li.menu').hover(
       function() { 
           $('.depth1',this).css('color','#1b8ab3');
       },function() {
          $('.depth1',this).css('color','#333');
     });
     

     //tab 처리
     $('ul.dropdownmenu li.menu .depth1').on('focus', function () {        
        $('ul.dropdownmenu li.menu ul').fadeIn('normal');
        $('#headerArea').animate({height:400},'fast').clearQueue();
     });

    $('ul.dropdownmenu li.m6 li:last').find('a').on('blur', function () {        
        $('ul.dropdownmenu li.menu ul').fadeOut('fast');
        $('#headerArea').animate({height:142},'normal').clearQueue();
    });
});



/* top무브 버튼 */
$('.topMove').hide();
           
$(window).on('scroll',function(){ //스크롤 값의 변화가 생기면
     var scroll = $(window).scrollTop(); //스크롤의 거리
    
    
     $('.text').text(Math.floor(scroll));

     if(scroll>500){ //500이상의 거리가 발생되면
         $('.topMove').fadeIn('slow');  //top보여라~~~~
     }else{
         $('.topMove').fadeOut('fast');//top안보여라~~~~
     }
});

 $('.topMove').click(function(e){
    e.preventDefault();
     //상단으로 스르륵 이동합니다.
    $("html,body").stop().animate({"scrollTop":0},1500); 
    //스크롤을 부드럽게 이동하도록 하는 코드!
 }); 


/* search popup*/  
 $('.topMenu .search').click(function(e){
    e.preventDefault();
  
  $('.pop .popup_box').fadeIn('fast');
  $('.pop .popup').fadeIn('slow');

});

$('.close_btn,.pop .popup_box').click(function(e){
    e.preventDefault();
    $('.pop .popup_box').hide();
    $('.pop .popup').hide();
});
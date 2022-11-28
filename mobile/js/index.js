$(document).ready(function() {
  
  var smh=$('.main').height(); //비주얼 이미지의 높이를 리턴한다   965px
  // 헤더 스크롤 반응
  // gnb 스크롤 이벤트 체크
  $(window).on('scroll',function(){//스크롤의 거리가 발생하면
      var scroll = $(window).scrollTop();  //스크롤의 거리를 리턴하는 함수
      //console.log(scroll);
      
      if(scroll>100){//스크롤100까지 내리면
        $('#headerArea').css('background','rgba(255,255,255,1)').css('box-shadow','3px 3px 15px 1px rgba(0,0,0,.08)');
          $('#headerArea').addClass('on');
          
      } else {//스크롤 내리기 전 디폴트(마우스올리지않음)
        $('#headerArea').css('background','none').css('box-shadow','none');
          $('#headerArea').removeClass('on');
      };
  });

   var op = false;  //네비가 열려있으면(true) , 닫혀있으면(false)
 
   $(".menu_ham").click(function(e) {
       e.preventDefault();
       var documentHeight =  $(document).height();
       $("#gnb").css('height',documentHeight); 

       if(op==false){ // 네비가 닫혀있으면 열어라
           $("#gnb").stop().animate({right:0,opacity:1}, 'fast');
           $('#headerArea').addClass('mn_open');
           $('body').css({overflow:"hidden"});
           //$('.nav_bg').fadeIn();
           op=true;
       } else { // 네비가 열려있으면 닫아라
           $("#gnb").stop().animate({right:'-100%',opacity:0}, 'fast');
           $('#headerArea').removeClass('mn_open');
           $('body').css({overflow:"auto"});
           //$('.nav_bg').fadeOut();
           op=false;
       }
   });
    
   
   
    //2depth 메뉴 교대로 열기 처리 
    var onoff=[false,false,false,false];
    var arrcount=onoff.length;
    
    //console.log(arrcount);
    
    $('#gnb .depth1 h3 a').click(function(){
        var ind=$(this).parents('.depth1').index();
        
        // console.log(ind);
        
       if(onoff[ind]==false){
        //$('#gnb .depth1 ul').hide();
        $(this).parents('.depth1').find('ul').slideDown('slow');
        $(this).parents('.depth1').siblings('li').find('ul').slideUp('fast');
         for(var i=0; i<arrcount; i++) onoff[i]=false; 
         onoff[ind]=true;
           
         $('.depth1 span').html('<span><i class="fa-solid fa-angle-down"></i></span>');   
         $(this).find('span').html('<span><i class="fa-solid fa-angle-up"></i></span>');   
            
       }else{
         $(this).parents('.depth1').find('ul').slideUp('fast'); 
         onoff[ind]=false;   
           
         $(this).find('span').html('<span><i class="fa-solid fa-angle-down"></i></span>');     
       }
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


});



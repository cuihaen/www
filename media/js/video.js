$(document).ready(function() {
  var screenSize, screenHeight;
  var current=false;

  function screen_size(){
      screenSize = $(window).width(); //스크린의 너비
      screenHeight = $(window).height();  //스크린의 높이

      $("#content").css('margin-top',screenHeight);
      
      if( screenSize > 640 && current==false){
          $("#videoBG").show();
          $("#videoBG").attr('src','./images/harry_potter2.mp4');
          $("#imgBG").hide();
          // $("#chractersCard>div").removeClass('min_swiper').addClass('swiper1');

          current=true;
        }
      if(screenSize <= 640){
          $("#videoBG").hide();
          $("#videoBG").attr('src','');
          $("#imgBG").show();
          //$("#chractersCard>div").removeClass('swiper1').addClass('min_swiper');

          current=false;
      }
  }

  screen_size();  //최초 실행시 호출
  
 $(window).resize(function(){    //웹브라우저 크기 조절시 반응하는 이벤트 메소드()
      screen_size();
  }); 
  
  $('.down').click(function(){
      screenHeight = $(window).height();
      $('html,body').animate({'scrollTop':screenHeight}, 1000);
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
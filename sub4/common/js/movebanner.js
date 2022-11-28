var position=0;  //최초위치
var movesize=$('.teamBox .member li').width(); 
var timeonoff;
   
$('.teamBox ul').after($('.teamBox ul').clone());
  
function moveG() {
    position-=movesize;  // 150씩 감소
    $('.teamBox').stop().animate({left:position}, 'slow',
        function(){							
            if(position==-2000){
                $('.teamBox').css('left',0);
                position=0;
            }
        });
    }

    timeonoff= setInterval(moveG, 1500);
  
$('.teamBox').hover(function(){
    clearInterval(timeonoff);
},function(){
    timeonoff= setInterval(moveG, 1500);	
});

        //슬라이드 겔러리를 한번 복제
 
$('.btn .btnRight,.btn .btnLeft').click(function(e){
    e.preventDefault();
    clearInterval(timeonoff);
    
    if($(this).is('.btnRight')){  //이전버튼 클릭
    if(position<=-2000){
        $('.teamBox').css('left',0);
        position=0;
    }
        position-=movesize;
            $('.teamBox').animate({left:position}, 'fast',
            function(){							
                if(position<=-2000){
                    $('.teamBox').css('left',0);
                    position=0;
                }   //해당 함수가 function(){}바깥에 위치하면 거의 동시에 계산되므로 오류 발생.
            }).clearQueue();
    }else if($(this).is('.btnLeft')){  //다음버튼 클릭
        if(position>=0){
            $('.teamBox').css('left',-2000);
            position=-2000;
        }

        position+=movesize; // 150씩 증가
        $('.teamBox').animate({left:position}, 'fast',
            function(){							
                if(position>=0){
                    $('.teamBox').css('left',-2000);
                    position=-2000;
                }
            }).clearQueue();
    }
});
    var timeonoff;   
    var imageCount=$('.gallery li').size();  
    var cnt=1;   //이미지 순서 1 2 3 4 5 1 2 3 4 5....
    var onoff=true; 
    var startX, endX;
    var imgSize;   //이미지 너비
    var imgIndex=0;  //이미지 순서
     
    imgSize=$(window).width();  // 페이지 로드시 윈도우의 너비값을 li의 너비값으로 반환한다
    
    $('.btn1').css('background','#1b8ab3'); 
    $('.btn1').css('width','20'); 
    
    $('.gallery .link1').fadeIn('slow'); 

    //텍스트에 애니메이션 추가!
    $('.gallery .link1 span').delay(500).animate({top:400,opacity:1},800);
 
    function moveg(){
      if(cnt==imageCount+1)cnt=1;
      if(cnt==imageCount)cnt=0;  //카운트 초기화

      cnt++;  //카운트 1씩 증가.. 5가되면 다시 초기화
    
      $('.gallery ul').animate({left:-imgSize*imgIndex},'slow');
      
      $('.mbutton').css('background','#fff'); //버튼불다꺼!!
      $('.mbutton').css('width','10'); // 버튼 원래의 너비
      $('.btn'+cnt).css('background','#1b8ab3');//자신만 불켜
      $('.btn'+cnt).css('width','20');

      //텍스트에 애니메이션 추가!
      $('.gallery li span').css('top','210').css('opacity','0');
      $('.gallery .link'+cnt).find('span').delay(500).animate({top:400,opacity:1},800);

       if(cnt==imageCount)cnt=0;  //카운트의 초기화 0
     }
     
    timeonoff= setInterval( moveg , 4000);

   $('.mbutton').click(function(event){  
	     var $target=$(event.target);
       clearInterval(timeonoff); 
	 
	    $('.gallery li').hide(); 
		  if($target.is('.btn1')){  
				 cnt=1;  
		  }else if($target.is('.btn2')){ 
				 cnt=2; 
		  }else if($target.is('.btn3')){ 
				 cnt=3; 
		  }else if($target.is('.btn4')){
				 cnt=4; 
		  } 

		  $('.gallery .link'+cnt).fadeIn('slow');  
      
      $('.gallery .link1 span').delay(500).animate({top:400,opacity:1},800);
		  
      $('.mbutton').css('background','#fff'); 
      $('.mbutton').css('width','10');
      $('.btn'+cnt).css('background','#1b8ab3');
      $('.btn'+cnt).css('width','20');

    
     $('.gallery li span').css('top','210').css('opacity','0');
     $('.gallery .link'+cnt).find('span').delay(500).animate({top:400,opacity:1},800);
      
      if(cnt==imageCount)cnt=0;  
     
      timeonoff= setInterval( moveg , 4000); 
     
      if(onoff==false){ 
            onoff=true; 
            $('.ps').html('<span class="hidden">play</span><i class="fa-solid fa-play"></i>');
      }
      
    });

   //stop/play 버튼 클릭시 타이머 동작/중지
    $('.ps').click(function(){ 
      if(onoff==true){ 
          clearInterval(timeonoff);   
          $(this).html('<span class="hidden">stop</span><i class="fa-solid fa-pause"></i>'); //js파일에서는 경로의 기준이 html파일이 기준!!
          onoff=false;   
      }else{ 
        timeonoff= setInterval( moveg , 4000); 
        $(this).html('<span class="hidden">play</span><i class="fa-solid fa-play"></i>');
        onoff=true; 
      }
    });	




    
      var position=0;  //최초위치
      var movesize=36+$('#content .news .newsCon li').width(); 
     
      $('#content .news .newsCon ul').after($('#content .news .newsCon ul').clone());

   
    $('.news .btn .prev,.news .btn .next').click(function(e){
      e.preventDefault();
       
      if($(this).is('.prev')){  //이전버튼 클릭
        if(position<=-2848){
          $('.newsCon').css('left',0);
          position=0;
        }
        position-=movesize;
        $('.newsCon').stop().animate({left:position}, 'fast',
          function(){							
            if(position<=-2848){
              $('.newsCon').css('left',0);
              position=0;
            }
          }).clearQueue();
      }else if($(this).is('.next')){  //다음버튼 클릭
      if(position>=0){
      $('.newsCon').css('left',-2848);
      position=-2848;
      }
      position+=movesize;
      $('.newsCon').stop().animate({left:position}, 'fast',
        function(){							
          if(position>=0){
              $('.newsCon').css('left',-2848);
              position=-2848;
          }
        }).clearQueue();
      }
    });
  //   $('.gallery li').width(imgSize);
       
    
   
  //  $('.gallery').on('touchstart mousedown',function(e){
  //     e.preventDefault();      
  //     startX=e.pageX || e.originalEvent.touches[0].pageX;
  //  });
       
  //  $('.gallery').on('touchend mouseup',function(e){
  //     e.preventDefault();
  //     endX=e.pageX || e.originalEvent.changedTouches[0].pageX;
        
  //   if(startX<endX) {  
  //       imgIndex--;
  //       if(imgIndex<0){
  //         imgIndex=0;
  //         $('.gallery ul').animate({left:-imgSize*imgIndex},'slow');
  //       }else{      
  //         imgIndex++;
  //         if(imgIndex>=imgCount)imgIndex=imgCount-1;
  //         $('h1').text(imgIndex);
  //         $('.gallery ul').animate({left:-imgSize*imgIndex},'slow');
  //       };
  //     };  
  //   });
       
  //  $(window).resize(function(){    //웹브라우저 크기 조절시 반응하는 이벤트 메소드()
  //        imgSize = $(window).width();   //너비를 li의 크기로 반환한다
  //         $('.gallery li').width(imgSize); 
  //         $('.gallery ul').css('left',-imgSize*imgIndex); //left값을 li의 너비 값에 대응하게 처리
  //  });  
     




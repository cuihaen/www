$(document).ready(function() {

    var timeonoff;   
    var imageCount=$('.gallery li').size();  
    var cnt=1;   //이미지 순서 1 2 3 4 5 1 2 3 4 5....
    var onoff=true; 
    
    $('.btn1').css('background','#1b8ab3'); 
    $('.btn1').css('width','20'); 
    
    $('.gallery .link1').fadeIn('slow'); 

    //텍스트에 애니메이션 추가!
    $('.gallery .link1 span').delay(500).animate({top:400,opacity:1},800);
 
    function moveg(){
      if(cnt==imageCount+1)cnt=1;
      if(cnt==imageCount)cnt=0;  //카운트 초기화

      cnt++;  //카운트 1씩 증가.. 5가되면 다시 초기화
    
     $('.gallery li').hide();
     $('.gallery .link'+cnt).fadeIn('slow'); 
      
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

    //왼쪽/오른쪽 버튼 처리
    $('.main .btn').click(function(){

      clearInterval(timeonoff); 

      if($(this).is('.btnRight')){ 
          if(cnt==imageCount)cnt=0; 
          cnt++; 
      }else if($(this).is('.btnLeft')){  
          if(cnt==1)cnt=imageCount+1;  
          if(cnt==0)cnt=imageCount;
          cnt--;
      }

    $('.gallery li').hide(); 
    $('.gallery .link'+cnt).fadeIn('slow');
    
    //텍스트에 애니메이션 추가!
    $('.gallery .link1 span').delay(500).animate({top:400,opacity:1},800);
                        
    $('.mbutton').css('background','#fff'); //버튼 모두불꺼
    $('.mbutton').css('width','10');
    $('.btn'+cnt).css('background','#1b8ab3');//자신 버튼만 불켜 
    $('.btn'+cnt).css('width','20');

    //텍스트에 애니메이션 추가!
    $('.gallery li span').css('top','210').css('opacity','0');
    $('.gallery .link'+cnt).find('span').delay(500).animate({top:400,opacity:1},800);

    timeonoff= setInterval( moveg , 4000); 

    if(onoff==false){
      onoff=true;
      $('.ps').html('<span class="hidden">play</span><i class="fa-solid fa-play"></i>');
    }
  });


});

   /* 지속가능경영 tab */
    var cnt = 3; //탭메뉴 개수 ***
    var ind = $('.esg dl').index();
    $('.esg dl').hide(); //모든 탭내용을 안보이게...
    $('.esg dl:eq(0)').show(); // 첫번째 탭 내용만 열어라
 
    $('.esg .btn .rightBtn,.esg .btn .leftBtn').click(function(e){
      e.preventDefault();
      if($(this).is('.rightBtn')){  
        $('.esg dl').hide();
        $('.esg dl:eq(0)').show(); 

        if(ind>=2){
          ind=0;
        }else{
          ind++;
        }

        if(ind==0){
          $('.esg .first').attr('src','images/esg0'+(ind+3)+'.jpg');
          $('.esg .second').attr('src','images/esg0'+(ind+2)+'.jpg');
          $('.esg .third').attr('src','images/esg0'+(ind+1)+'.jpg');
          $('.esg .imgBox').hide().fadeIn();
    
          }else if(ind==1){
          $('.esg .first').attr('src','images/esg0'+(ind)+'.jpg');
          $('.esg .second').attr('src','images/esg0'+(ind+2)+'.jpg');
          $('.esg .third').attr('src','images/esg0'+(ind+1)+'.jpg');
          $('.esg .imgBox').hide().fadeIn();
    
          }else if(ind==2){
          $('.esg .first').attr('src','images/esg0'+(ind)+'.jpg');
          $('.esg .second').attr('src','images/esg0'+(ind-1)+'.jpg');
          $('.esg .third').attr('src','images/esg0'+(ind+1)+'.jpg');
          $('.esg .imgBox').hide().fadeIn();
          }
          $('.esg dl,.esg .imgBox').hide(); 
          $('.esg dl:eq('+ind+'),.esg .imgBox').show();
          
      }else if($(this).is('.leftBtn')){  
        $('.esg dl').hide();
        $('.esg dl:eq(0)').show(); 
        if(ind<=0){
          ind=2;
          }else{
            ind--;
          }

        if(ind==0){
          $('.esg .first').attr('src','images/esg0'+(ind+3)+'.jpg');
          $('.esg .second').attr('src','images/esg0'+(ind+2)+'.jpg');
          $('.esg .third').attr('src','images/esg0'+(ind+1)+'.jpg');
          $('.esg .imgBox').hide().fadeIn();
    
          }else if(ind==1){
          $('.esg .first').attr('src','images/esg0'+(ind)+'.jpg');
          $('.esg .second').attr('src','images/esg0'+(ind+2)+'.jpg');
          $('.esg .third').attr('src','images/esg0'+(ind+1)+'.jpg');
          $('.esg .imgBox').hide().fadeIn();
    
          }else if(ind==2){
          $('.esg .first').attr('src','images/esg0'+(ind)+'.jpg');
          $('.esg .second').attr('src','images/esg0'+(ind-1)+'.jpg');
          $('.esg .third').attr('src','images/esg0'+(ind+1)+'.jpg');
          $('.esg .imgBox').hide().fadeIn();
          }
          $('.esg dl,.esg .imgBox').hide(); 
          $('.esg dl:eq('+ind+'),.esg .imgBox').show();
      };
    });

    //  뉴스 움직임
    
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





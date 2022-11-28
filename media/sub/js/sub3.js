$(document).ready(function() {
  var screenSize, screenHeight;
  var current=false;

  function screen_size(){
      screenSize = $(window).width(); //스크린의 너비
      screenHeight = $(window).height();  //스크린의 높이

      $("#content").css('margin-top',screenHeight);
      
      if( screenSize > 640 && current==false){
          $("#imgBIG").show();
          $("#imgBIG").attr('src','./images/content3/main2.jpg');
          $("#imgBG").hide();
          // $("#chractersCard>div").removeClass('min_swiper').addClass('swiper1');

          current=true;
        }
      if(screenSize <= 640){
          $("#imgBIG").hide();
          $("#imgBIG").attr('src','');
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

$.ajax({
    url: './js/sub3.json',
    dataType : 'json',
    success : function(data){
        var movieTrailer = data.trailer;
        var ind = 0;  
            
        function popchange(i){

            var txt = `<div class="youtube_box">
                        <div>
                        <iframe src="${movieTrailer[i].url}" title="Harry Potter Trailer" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                    <dl><dt>${movieTrailer[i].title}</dt>
                    <dd> ${ movieTrailer[i].text} <a href="${movieTrailer[i].link}" target="blank" title="open i nnew window">YouTube<i class="fa-brands fa-youtube"></i></a></dd></dl>`
            $('.subPop .sub_popup .txt').html(txt);
        };

        // popOpen
        $('.subPop .subPop_menu .openPop').click(function(e){
            e.preventDefault();
            
            ind = $(this).index('.subPop .subPop_menu .openPop');  // 0 1 2 3

            $('.subPop .sub_modal_box').fadeIn('fast');
            $('.subPop .sub_popup').fadeIn('slow');
            $('.subPop .sub_popup').css('display','flex');
      
            popchange(ind);
      
        });
       // popClose
        $('.sub_close_btn,.subPop .sub_modal_box').click(function(e){
            e.preventDefault();
            $('.subPop .sub_modal_box').fadeOut('fast');
            $('.subPop .sub_popup').hide('fast',function(){
                $('.sub_popup .txt').html('');
            });
        });
      
    }
});


// movieOST
var movieOst;
$.ajax({
    url:'./js/sub3.json',
    dataType: 'json',
    success: function(data){
        movieOst = data.music;

        $('.ost .tabs li:eq(0) .tab').css('border-color','rgba(243,189,25,1)');// 클릭한 해당 탭메뉴만 활성화
        $('.ost .tabs li:eq(0) span').addClass('active');

        $('.tabs .tab').click(function(e){
            e.preventDefault();
            var ind = $(this).index('.tabs ul li a'); // 클릭시 해당 index를 뽑아준다

            $('.ost .tabs .lpPlayer .contlist .lp').css('background','url(./images/content3/music/music'+(ind+1)+'.jpg) 0 0 no-repeat').css('background-size','cover');
            $('.ost .tabs .lpPlayer .contlist .audioBox dt').html(movieOst[ind].title);
            $('.ost .tabs .lpPlayer .contlist .audioBox dd').html(movieOst[ind].text);
            $('#music').attr('src',movieOst[ind].mp3);

            $('.onoff').parents('.contlist').removeClass('play');
            $('.onoff').find('span').html('play');

            $('.ost .tabs li .tab').css('border','1px solid rgba(243,189,25,0)'); //모든 탭메뉴를 비활성화
            $('.ost .tabs li span').removeClass('active');
            $('.ost .tabs li:eq('+ind+') .tab').css('border-color','rgba(243,189,25,1)');// 클릭한 해당 탭메뉴만 활성화
            $('.ost .tabs li:eq('+ind+') span').addClass('active');

        });
    }
    
});

//music play/pause
let mode = 0;
    var music;
	
    function play(){
			music.play();
	}
	function pause(){
		music.pause();
	}
    
    // 0 일때 음악정지
    $('.onoff').toggle(function(e){
		music = document.getElementById('music')
        e.preventDefault();
            $('.onoff').parents('.contlist').addClass('play');
			$('.onoff').find('span').html('stop');
            play();
            mode = 1;	
		},function(e){
			$('.onoff').parents('.contlist').removeClass('play');
			$('.onoff').find('span').html('play');
			pause();
			$(this).parent('#music').find('.audioBox').attr("src",""); 
			mode = 0;
		}
	);
var timeonoff;
var cnt=0;
var imgCount=$('.gallery li').size();
var onoff=true;
var startX, endX;
var imgSize=$(window).width();
var position=0;
var mainWidth=$('.gallery ul').width();


$('.btn1').css('background','#1b8ab3'); 
$('.btn1').css('width','20'); 

$('.gallery ul li img').css('width',imgSize);
$('.gallery ul li span').delay(500).animate({top:'45%',opacity:1},800);

function moveg(){
    if(cnt==imgCount-1)cnt=-1;
    if(cnt==imgCount)cnt=0;  //카운트 초기화

    cnt++;  //카운트 1씩 증가.. 5가되면 다시 초기화
    var movesize=-imgSize*cnt;
    $('.mbutton').css('background','#fff'); //버튼불다꺼!!
    $('.mbutton').css('width','10'); // 버튼 원래의 너비
    $('.btn'+Number(cnt+1)).css('background','#1b8ab3');//자신만 불켜
    $('.btn'+Number(cnt+1)).css('width','20');

    $('.gallery ul').stop().animate({left:movesize},'slow');

     //if(cnt==imgCount)cnt=0;  //카운트의 초기화 0
   }
   
  timeonoff= setInterval( moveg , 4000);

//stop/play 버튼 클릭시 타이머 동작/중지
$('.ps').click(function(){
    if(onoff == true){ // 타이머가 동작 중이면
        clearInterval(timeonoff); // 타이머 종료
        $(this).html('<span class="hidden">stop</span><i class="fa-solid fa-play"></i>');
        onoff = false;
    } else { // 타이머가 중지 상태면
        timeonoff = setInterval( moveg , timer); // 타이머 부활
        $(this).html('<span class="hidden">play</span><i class="fa-solid fa-pause"></i>');
        onoff = true;
    }
});


$('gallery').on('touchstart mousedown',function(e){
    startX=e.pageX || e.originalEvent.touches[0].pageX;
})

$('.gallery').on('touchend mouseup',function(e){
    e.preventDefault();   
    clearInterval(timeonoff);
    onoff=false; 
    endX=e.pageX || e.originalEvent.changedTouches[0].pageX;

    if(startX<endX){
        if(cnt==imgCount-1)cnt=-1;
        if(cnt==imgCount)cnt=0;
        cnt--;
        $('.gallery ul').stop().animate({left:movesize},'slow');
        $('.gallery ul li span').delay(500).animate({top:'45%',opacity:1},800);
        onoff=ture; 
    }else{
        if(cnt==imgCount-1)cnt=-1;
        if(cnt==imgCount)cnt=0;
        cnt++;
        $('.gallery ul').stop().animate({left:movesize},'slow');
        $('.gallery ul li span').delay(500).animate({top:'45%',opacity:1},800);
        onoff=ture; 
    }
});   
// JavaScript Document
 var cnt=$('.tab_menu li').size();  //탭메뉴 개수 ***
 $(".tabs .contlist").hide(); //모든 탭내용을 안보이게...
$('.tabs .contlist:eq(0)').fadeIn(); // 첫번째 탭 내용만 열어라
$('.tabs .title01').css('background','#1b8ab3');
$('.tabs .title01 a').css('color','#fff');//첫번째 탭메뉴 활성화
    
    //자바스크립트의 상대 경로의 기준은 => 스크립트 파일을 불러들인 html파일이 저장된 경로 기준***

$('.tabs .tab').click(function(e){
    e.preventDefault();   // <a> href="#" 값을 강제로 막는다  
    
    var ind = $(this).index('.tabs .tab');  // 클릭시 해당 index를 뽑아준다
    //console.log(ind);

    $(".tabs .contlist").hide(); //모든 탭내용을 안보이게...
    $(".tabs .contlist:eq("+ind+")").fadeIn(); //클릭한 해당 탭내용만 보여라
    $('.tabs h4').css('background','#fff');
    $('.tabs h4 a').css('color','#1b8ab3');//모든 탭메뉴를 비활성화
    $('.tabs h4:eq('+ind+')').css('background','#1b8ab3');
    $('.tabs h4:eq('+ind+') a').css('color','#fff');
    
    if(ind==1){
        $('.tabs').css('background','url(./images/content2/background02.jpg) 0 0 no-repeat');
    }else{
        $('.tabs').css('background','url(./images/content2/background01.jpg) 0 0 no-repeat');
    }

})
   


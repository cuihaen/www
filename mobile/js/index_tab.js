//tab
var cnt=$('.business.tabs .tab_menu li').size();  //탭메뉴 개수 ***
$(".business.tabs .contlist").hide(); //모든 탭내용을 안보이게...
$('.business.tabs .contlist:eq(0)').show(); // 첫번째 탭 내용만 열어라
$('.business.tabs .tab_menu li:eq(0)').css('box-shadow','3px 3px 10px 3px rgba(0,0,0,.15)'); //첫번째 탭메뉴 활성화
       //자바스크립트의 상대 경로의 기준은 => 스크립트 파일을 불러들인 html파일이 저장된 경로 기준***

$('.business.tabs .tab').click(function(e){
   e.preventDefault();   // <a> href="#" 값을 강제로 막는다  
   
   var ind = $(this).index('.business.tabs .tab');  // 클릭시 해당 index를 뽑아준다
   console.log(ind);

   $(".business.tabs .contlist").hide(); //모든 탭내용을 안보이게...
   $(".business.tabs .contlist:eq("+ind+")").show(); //클릭한 해당 탭내용만 보여라
   $('.business.tabs .tab_menu li a').css('color','#0c3c4e');
   $('.business.tabs .tab_menu li').css('box-shadow','none'); //모든 탭메뉴를 비활성화
   $('.business.tabs .tab_menu li:eq('+ind+')').css('box-shadow','3px 3px 10px 3px rgba(0,0,0,.15)'); // 클릭한 해당 탭메뉴만 활성화
}); 
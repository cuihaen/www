$(window).on('scroll',function(){
    var page_scroll = $(window).scrollTop();
    var move = [];
    var half= window.innerHeight;
    var move_cnt = Number($('#content').find('.move').length) - 1; // 0부터 index값 뽑기
    for (var i=0; i<=move_cnt; i++){
        move[i] = $('.move:eq('+i+')').offset().top;

        if(page_scroll > move[i]-(half/2+100)){
            $('.move:eq('+i+')').addClass('active');
        } else if(page_scroll < move[i]-half){
            $('.move:eq('+i+')').removeClass('active');
        };
    };
});

$('.topMove').hide();
$(window).on('scroll', function () { //스크롤 값의 변화가 생기면
    var scroll = $(window).scrollTop(); //스크롤의 거리

    if (scroll > 750) { //750이상의 거리가 발생되면
        $('.topMove').fadeIn('slow'); //top노출
    } else {
        $('.topMove').fadeOut('fast'); //top미노출
    }
});
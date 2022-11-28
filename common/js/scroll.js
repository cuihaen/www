$(window).on('scroll',function(){
    var page_scroll = $(window).scrollTop();
    var move = [];
    var half= window.innerHeight;
    var move_cnt = Number($('#content').find('.move').length) - 1; // 0부터 index값 뽑기
    for (var i=0; i<=move_cnt; i++){
        move[i] = $('.move:eq('+i+')').offset().top;

        if(page_scroll > move[i]-(half/2+250)){
            $('.move:eq('+i+')').addClass('active');
        } else if(page_scroll < move[i]-half){
            $('.move:eq('+i+')').removeClass('active');
        };
    };
});

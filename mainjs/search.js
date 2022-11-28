$('.topMenu .search').click(function(e){
    e.preventDefault();
  
  $('.pop .popup_box').fadeIn('fast');
  $('.pop .popup').fadeIn('slow');

});

$('.close_btn,.pop .popup_box').click(function(e){
    e.preventDefault();
    $('.pop .popup_box').hide();
    $('.pop .popup').hide();
});

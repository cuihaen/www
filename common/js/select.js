
	$('.family .arrow').toggle(function(){
		$('.family .aList').fadeIn('slow');
		$(this).css('background','#1b8ab3').css('color','#fff');
		$(this).find('span').html('family site  <i class="fa-solid fa-caret-down"></i>');
	},function(){
        $('.family .aList').fadeOut('fast');
		$(this).css('background','none').css('color','#1b8ab3');
		$(this).find('span').html('family site  <i class="fa-solid fa-caret-up"></i>');	
	});

	// $('.family .aList','.family .arrow').mouseleave(function(){
	// 	$('.family .arrow span').html('family site  <i class="fa-solid fa-caret-up"></i>');	
	// 	$(this).fadeOut('fast');
				  
	// });

	//tab키 처리
	  $('.family .arrow').on('focus', function () {        
              $('.family .aList').fadeIn('slow');
			  $(this).css('background','#1b8ab3').css('color','#fff');
			  $(this).find('span').html('family site  <i class="fa-solid fa-caret-down"></i>');
       });
       $('.family .aList li:last a').on('blur', function () {        
              $('.family .aList').fadeOut('fast');
			  $('.family .arrow').css('background','none').css('color','#1b8ab3');
			  $(this).find('span').html('family site  <i class="fa-solid fa-caret-up"></i>');	
       });
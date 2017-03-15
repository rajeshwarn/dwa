
	// On Admin Window Scrolled	
	$(window).scroll(function(){
		if( $(window).scrollTop() > $(" .movie-link-wrap ").position().top )
			{
				$(" .movie-link-wrap ").css({"position":"fixed","top":"0","width":"80%","z-index":"9"});
			}
		
		if( $(window).scrollTop() <= $(" #edit-movie-form ").position().top )
			{
				$(" .movie-link-wrap ").removeAttr("style");
			}
	});
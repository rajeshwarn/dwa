	var flagBoxMenuWrap = 0, flagItemMovieListMenuWrap = 0, flagVideoStateStatus = 0, flagVideoFullScreen = 0;
	var player, y_link;
	var vid = document.getElementById("video-container");	

	// Analytic
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-85195374-1', 'auto');
	  ga('send', 'pageview');

	// FB Plugin	
	(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

	// Owl Set
	$(document).ready(function(){
		$(" #best-movie-slider, #coming-soon-slider ").owlCarousel({
			singleItem : true,
			pagination : true			
		});

		var loading_option = {
			finishedMsg: "<div class='end-msg'>You've reach the end</div>",
			msgText: "<div class='center'>Loading movie ..."
		};

		$(" .list-movie-wrap ").infinitescroll({
			loading: loading_option,
			navSelector: "ul.pagination",
			nextSelector: "ul.pagination a:first",
			itemSelector: ".list-movie-wrap .item"
		}, function(){
			$(this).find('.item-18').each(function(index, value) {
	            if ($(this).hasClass('finished')) {
	            	//nothing
	            } else {
	                $(this).after("<a href='http://indoads.xyz/visit.php?id=12692&ref_id=701' target='_blank'><img src='http://dewabioskop21.com/includes/banner-content.gif' id='banner-content'></a>");
	                $(this).addClass('finished');
	            }
	        });

			open_trailer();
		});

		floatingBannerRightLeft();
		popOveringSocmed();
	});

	$(" #video-container ").dblclick(function(){

		if( flagVideoFullScreen == 0  )
			{
				if( vid.webkitRequestFullScreen )
				{
					vid.webkitRequestFullScreen();
				}
			else if( vid.mozRequestFullScreen )
				{
					vid.mozRequestFullScreen();
				}
			else if( vid.requestFullScreen )
				{
					vid.requestFullScreen();
				}

				flagVideoFullScreen = 1;
			}
		else if( flagVideoFullScreen == 1 )
			{
				if( vid.webkitExitFullScreen )
					{
						vid.webkitExitFullScreen();
					}
				else if( vid.mozExitFullScreen )
					{
						vid.mozExitFullScreen();
					}
				else if( vid.exitFullScreen )
					{
						vid.exitFullScreen();
					}

				flagVideoFullScreen = 0;
			}

		
	});
	
	// Video Clicked
	$(" #video-container ").click(function(){

		if( flagVideoStateStatus == 0 )
			{
				vid.play();
				flagVideoStateStatus = 1;
			}
		else if( flagVideoStateStatus == 1 )
			{
				vid.pause();
				flagVideoStateStatus = 0;
			}
	});

	// Button Play Movie
	$(" .btn-play-movie ").click(function(){

		if( vid.readyState == 4 )
			{
				vid.play();
				vid.controls=true;
				flagVideoStateStatus = 1;

				$(this).fadeOut();
				$(this).parent().find('.poster-video').fadeOut();
				$(this).parent().find('.video-watermark').css('display','block');
			}
		else
			{
				alert("Please Wait, Preparing Movie");
			}
	});

	// Admin Top Right Menu
	$(" #admin-top-right-menu li > a ").click(function(){

		if( flagBoxMenuWrap == 0 )
			{
				$(this).parent().find(".box-menu-wrap").css('display','block');
				flagBoxMenuWrap = 1;
			}
		else
			{
				$(this).parent().find(".box-menu-wrap").css('display','none');
				flagBoxMenuWrap = 0;
			}
	});

	// Open Movie List Menu Wrap for Watch or Trailer
	/* $(" #main-section .movie-col .featured-movie-wrap .item .movie-thumb .bottom .btn-menu, #main-section .movie-col .list-movie-wrap .item .movie-thumb .bottom .btn-menu, #main-section .movie-detail-wrap .item .movie-thumb .bottom .btn-menu ").click(function(){

		if( flagItemMovieListMenuWrap == 0 )
			{
				$(this).parent().parent().find(" .menu-list-wrap ").css('display',"block");
				flagItemMovieListMenuWrap = 1;
			}
		else
			{
				$(this).parent().parent().find(" .menu-list-wrap ").fadeOut();
				flagItemMovieListMenuWrap = 0;
			}

	}); */

	// Close Movie List Menu Wrap For Watch Or Trailer
	$(" #main-section .movie-col .featured-movie-wrap .item .movie-thumb, #main-section .movie-col .list-movie-wrap .item .movie-thumb, #main-section .movie-detail-wrap .item .movie-thumb ").mouseleave(function(){
		$(this).find(" .menu-list-wrap ").fadeOut();
		flagItemMovieListMenuWrap = 0;
	});

	function onYouTubeIframeAPIReady() {
		player = new YT.Player('video-player', {
			width: '100%',
			height: '100%',
			videoId: '',
			playerVars: { 'iv_load_policy' : 3, 'rel' : 0, 'showinfo' : 0, 'disablekb' : 0 }			
		});
	}

	function open_trailer() {
		$(" .btn-trailer ").click(function(){
			var alldata = ($(this).data());
			var y_link = alldata['link'];
			var y_link_split = y_link.split("/");
			var id_vid = y_link_split[y_link_split.length-1];

			player.loadVideoById(id_vid);

			$(" #overlay-video-player ").css('display','block');
			$(" #video-player ").prop('allowfullScreen', true);
		});
	}

	function close_trailer() {
		$(" #wrap-video-player .btn-close ").click(function(){
			$(" #overlay-video-player ").css('display','none');
			player.stopVideo();
		});

		$(" #overlay-video-player ").click(function(e){
			if (e.target != this  ) { return ;}
			$(" #overlay-video-player ").css('display','none');
			player.stopVideo();
		});
	}

	function floatingBannerRightLeft() {
		var bannerTop = $("#banner-left").offset().top,
		sidebarTop = $("#main-section .sidebar-col").offset().top;

		$(window).scroll(function(e){
			e.stopImmediatePropagation();
			e.stopPropagation();
			var wScroll = $(this).scrollTop();

			if( wScroll >= bannerTop ) {
				$("#banner-left, #banner-right").animate({
					"top" : ( ( wScroll - bannerTop ) + 10)
				}, {
					duration : 200,
					queue : false
				});
			} else if( wScroll < bannerTop ) {
				$("#banner-left, #banner-right").animate({
					"top" : 0
				}, {
					duration : 200,
					queue : false
				});
			}

			// if( wScroll >= sidebarTop ) {
			// 	$("#main-section .sidebar-col").animate({
			// 		"top" : ( wScroll - sidebarTop )
			// 	}, {
			// 		duration : 200,
			// 		queue : false
			// 	});
			// } else if( wScroll < sidebarTop ) {
			// 	$("#main-section .sidebar-col").animate({
			// 		"top" : 0
			// 	}, {
			// 		duration : 200,
			// 		queue : false
			// 	});
			// }
		});
	}

	function popOveringSocmed() {
		$('[data-toggle="popover"]').popover();
	}

	open_trailer();
	close_trailer();
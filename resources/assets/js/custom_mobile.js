    var flagBoxMenuWrap = 0, flagItemMovieListMenuWrap = 0, flagVideoStateStatus = 0, flagVideoFullScreen = 0, flagHeaderFixed = 0;
    var player, y_link;
    var vid = document.getElementById("video-container");   

    // Cancel Right Click
    $(document).contextmenu(function(){
        return false;
    });

    // Hover Bottom Menu
    $(" #bottom-menu nav ul li a ").on("touchstart", function(){
        $(this).css("background","#00BC96");
    });

    // Hover Movie Item
    $(" #main-content .box .movie-wrap .item .movie-thumb ").hover(function(){
        $(this).find(".menu-list-wrap").css("display","block");
    });

    // Unhover Movie Item
    $(" #main-content .box .movie-wrap .item .movie-thumb ").mouseleave(function(){
        $(this).find(".menu-list-wrap").css("display","none");
    });

    // Window On Scroll
    $(window).scroll(function(){
        if( $(window).scrollTop() > $(" header ").height() )
            {
                $(" header ").css({"position":"fixed","width":"100%","z-index":"1"});
                flagHeaderFixed = 1;
            }
        else
            {
                if( flagHeaderFixed == 1 )
                    {
                        // $(" header ").css({"position":"relative"});
                        $(" header ").removeAttr("style");
                        flagHeaderFixed = 0;
                    }

            }
    });

    // Make Carousel
    $(document).ready(function(){

        $(" #featured-movie-wrap, #related-movie-wrap ").owlCarousel({
             items: 3,
            itemsDesktop: [1400, 3],
            itemsDesktopSmall: [1100, 3],
            itemsTablet: [700, 3],
            itemsMobile: [500, 2]
        });

        var loading_option = {
            finishedMsg: "<div class='end-msg'>You've reach the end</div>",
            msgText: "<div class='center'>Loading movie ..."
        };

        $(" #list-movie-wrap ").infinitescroll({
            loading: loading_option,
            navSelector: "ul.pagination",
            nextSelector: "ul.pagination a:first",
            itemSelector: "#list-movie-wrap .item"
        }, function(){
            $(" #main-content .box .movie-wrap .item .movie-thumb ").hover(function(){
                $(this).find(".menu-list-wrap").css("display","block");
            });

            $(" #main-content .box .movie-wrap .item .movie-thumb ").mouseleave(function(){
                $(this).find(".menu-list-wrap").css("display","none");
            });
        });

        $(" #loading-wrap ").delay(1000).fadeOut();
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
            }
        else
            {
                alert("Please Wait, Preparing Movie");
            }
    });

    // Make Tabs
    $(" #main-nav .middle ").tabs();

    // Button Close Nav Mobile
    $(" #main-nav .btn-close, #main-nav .outer-right ").click(function(){
        $(" #main-nav ").animate({
            left : '-100%'
        });

        $(" body ").css("overflow-y","scroll");
    });

    // Button Open Nav Mobile
    $(" .btn-nav ").click(function(){
        $(" #main-nav ").animate({
            left : '0px'
        });

        $(" body ").css("overflow","hidden");
    });

    // Button Close Search
    $(" #search-wrap .btn-close ").click(function(){
        $(" #search-wrap ").animate({
            left : '-100%'
        });

        $(" body ").css("overflow-y","scroll");
    });

    // Button Open Search 
    $(" header .btn-search ").click(function(){
        $(" #search-wrap ").animate({
            left : '0'
        });

        $(" body ").css("overflow","hidden");
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

            $(" body ").css("overflow-y","hidden");

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

            $(" body ").css("overflow-y","visible");
        });

        $(" #overlay-video-player ").click(function(e){
            if (e.target != this  ) { return ;}
            $(" #overlay-video-player ").css('display','none');
            player.stopVideo();

            $(" body ").css("overflow-y","visible");
        });
    }

    open_trailer();
    close_trailer();

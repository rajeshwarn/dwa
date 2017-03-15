		<div id="overlay-video-player">                
	        <div id="wrap-video-player">
	            <img src="{{ URL::asset('resources/assets/img/close-btn.png') }}" class="btn-close">
	            <div id="video-player"></div>
	        </div>
	    </div>

	    <div style="visibility:hidden;">
		<!-- Histats.com  (div with counter) --><div id="histats_counter"></div>
		<!-- Histats.com  START  (aync)-->
		<script type="text/javascript">var _Hasync= _Hasync|| [];
		_Hasync.push(['Histats.start', '1,3712696,4,511,95,18,00000000']);
		_Hasync.push(['Histats.fasi', '1']);
		_Hasync.push(['Histats.track_hits', '']);
		(function() {
		var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
		hs.src = ('//s10.histats.com/js15_as.js');
		(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
		})();</script>
		<noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?3712696&101" alt="" border="0"></a></noscript>
		<!-- Histats.com  END  -->
		</div>
					
		<div id="bottom-menu">
			<nav>
				<ul>
					<li><a href="{{ URL::to('/') }}"><i class="fa fa-home" aria-hidden="true"></i> HOME</a></li>
					<li><a href="{{ URL::to('/allmovie') }}"><i class="fa fa-film" aria-hidden="true"></i> ALL MOVIE</a></li>
					<li><a href="{{ URL::to('/filter') }}"><i class="fa fa-filter" aria-hidden="true"></i> FILTER</a></li>
					<li><a href="{{ URL::to('/request') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> REQUEST</a></li>
				</ul>
			</nav>
		</div>

		<!-- JQUERY -->
		<script type="text/javascript" src="http://code.jquery.com/jquery-3.1.0.min.js"></script>
		<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
		
		<script type="text/javascript" src="https://www.youtube.com/iframe_api"></script>

		<script type="text/javascript" src="{{ URL::asset('resources/assets/js/jquery.infinitescroll.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('resources/assets/js/owl.carousel.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('resources/assets/js/custom_mobile.js?ver=1.0.8') }}"></script>

	</body>
</html>
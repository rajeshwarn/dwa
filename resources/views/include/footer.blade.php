	
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12 bottom">
					<p class="copyright">COPYRIGHT &copy; 2016 Dewabioskop21.com</p>

					<div style="visibility:hidden;display: inline-block;">
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

					<nav class="right-social">
						<ul>
							@foreach( $social as $link )
								@if( $link-> value != '' )
									@if( $link->item == 'facebook' )
										<li><a href="{{ $link->value }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									@elseif ( $link->item == 'twitter' )
										<li><a href="{{ $link->value }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									@endif
								@endif
							@endforeach
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</footer>

	<div id="overlay-video-player">                
        <div id="wrap-video-player">
            <img src="{{ URL::asset('resources/assets/img/close-btn.png') }}" width="112px" height="113px" class="btn-close">
            <div id="video-player"></div>
        </div>
    </div>

	<!-- JQUERY -->
	<script type="text/javascript" src="http://code.jquery.com/jquery-3.1.0.min.js"></script>
	<!-- <script src="//code.jquery.com/jquery-1.12.4.min.js"></script> -->

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script src="//releases.flowplayer.org/6.0.5/flowplayer.min.js"></script>

	<!-- API -->	
	<script type="text/javascript" src="https://www.youtube.com/iframe_api"></script>
	<script src="https://apis.google.com/js/platform.js" async defer></script>

	<script type="text/javascript" src="{{ URL::asset('resources/assets/js/jquery.infinitescroll.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('resources/assets/js/owl.carousel.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('resources/assets/js/custom.min.js?ver=1.4.7') }}"></script>
	<script type="application/ld+json">{"@context":"http://schema.org","@graph":[{"@type":"Organization","name":"DewaBioskop21","url":"http://dewabioskop21.com","logo":"http://dewabioskop21.com/resources/assets/img/logo.png","sameAs":["https://www.facebook.com/dewabioskop21"]},{"@type":"WebSite","url":"http://dewabioskop21.com","name":"DewaBioskop21","alternateName":"Streaming Download Film Subtitle Indonesia","potentialAction":{"@type":"SearchAction","target":"http://dewabioskop21.com/search?search={search_term_string}","query-input":"required name=search_term_string"}}]}</script>


	</body>
</html>
@extends('index_mobile')

	@section('content')

		<section>
			<div class="container">
				<div id="main-content">
					<div class="single-movie-wrap box">

							<h2 class="title">{{ $singlemovie->title }}</h2>
							
							@if( isset($msg) )
								{!! $msg !!}
							@endif

							<div id="video"></div>

							<?php 
								$link_page = $link_page . '?title=mov/mov.mp4';
								$data = "{label : '360p',file : '$link_page' }";								
							?>

								<div class="movie-detail-wrap">
								<div class="sinopse-box box">
									<h2 class="title">Sinopse</h2>
									<div class="movie-thumb" style="background-image: url('{{ 'http://s1.dewabioskop21.com/' . $singlemovie->featured_image }}')"></div>

									<div class="right">
										<p class="movie-desc">{{ $singlemovie->description }}</p>
										<br>
										<p class="movie-director">Director : {{ $singlemovie->director }}</p>
										<p class="movie-actor">Stars : {{ str_replace(',', ', ', $singlemovie->actor) }}</p>
										<p class="movie-release-date">Release Date : {{ $singlemovie->release_date }}</p>
										
										<div class="movie-more-detail">
											<div class="item-wrap rating-item">
												<img src="{{ URL::asset('resources/assets/img/imdb-icon.png') }}" class="imdb-icon">
												<p class="movie-rating">
													@if( $singlemovie -> rating >= 8.0 )
														<span class="rate good-rate">{{ $singlemovie->rating }} </span> / 10
													@else
														<span class="rate">{{ $singlemovie->rating }}</span> / 10
													@endif
												</p>
											</div>

											<div class="item-wrap year-item">
												<p class="movie-year">{{ $singlemovie -> year }}</p>
											</div>

											<div class="item-wrap view-item">
												<img src="{{ URL::asset('resources/assets/img/view-icon.png') }}" class="view-icon">
												<p class="movie-view">{{ $singlemovie -> view }}</p>
											</div>
										</div>
										<ul class="movie-category">
											<?php
												$cat_arr = explode(',', $singlemovie->category);
											?>

											@foreach( $cat_arr as $cat )
												<li><a href="{{ URL::to('/genre') . '/' . $cat }}">{{ $cat }}</a></li>
											@endforeach
										</ul>

										<div class="share-wrap">
											<h3 class="sub-title">Share this movie:</h3>
											<ul class="share-list">
												<li><a href="http://www.facebook.com/sharer/sharer.php?u={{ URL::to('/movie/' . $singlemovie->slug_id) }}" target="_blank" onclick="window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=600');return false;" class="btn-share-fb"><span class="fb-ico"><i class="fa fa-facebook" aria-hidden="true"></i></span> Share</a></li>
												<li><a href="https://twitter.com/intent/tweet?url={{ URL::to('/movie/' . $singlemovie->slug_id) }}" target="_blank" onclick="window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=600');return false;" class="btn-share-twitter"><i class="fa fa-twitter twitter-ico" aria-hidden="true"></i> Share</a></li>
												<li><a href="https://plus.google.com/share?url={{ URL::to('/movie/' . $singlemovie->slug_id) }}" onclick="window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=600');return false;" class="btn-share-gplus"><i class="fa fa-google-plus gplus-ico" aria-hidden="true"></i> Share</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
					</div>

					<div class="related-movie-wrap box">
						<h2 class="title">Related Movie</h2>
						<div id="related-movie-wrap" class="movie-wrap">
							@if( count($relatedmovie) != 0 )
								@foreach( $relatedmovie as $movie )
									<div class="item">
										<div class="movie-thumb" style="background-image: url('{{ 'http://s1.dewabioskop21.com/' . $movie->featured_image }}')">
											<div class="movie-title-wrap">
												<h2 class="movie-title">{{ $movie->title }}</h2>
											</div>

											<?php 
												if( trim($movie->trailer_link) != '' )
													{
														if( strpos($movie->trailer_link, 'embed') !== false )
															{
																$y_link = $movie->trailer_link;
																$y_link_arr = explode('/', $y_link);
																if( count($y_link_arr) < 4 )
																	{
																		$y_link_final = '';
																	}
																else
																	{
																		if( isset($y_link_arr[4]) )
																			{
																				$y_link_final = $y_link_arr[4];
																			}
																		else
																			{
																				$y_link_final = '';
																			}
																	}
															}
														else if( strpos($movie->trailer_link, 'watch') !== false )
															{
																$y_link = $movie->trailer_link;
																$y_link_arr = explode('=', $y_link);

																if( isset($y_link_arr[1]) )
																	{
																		$y_link_final = $y_link_arr[1];
																	}
																else
																	{
																		$y_link_final = '';
																	}
															}
														else
															{
																$y_link_final = '';
															}
													}				
												else
													{
														$y_link_final = '';
													}						
											?>

											<div class="menu-list-wrap">
												<ul>
													<li><a href="{{ '' . $movie->slug_id }}"><i class="fa fa-play" aria-hidden="true"></i> <span>Watch Now</span></a></li>
													<li><a data-link="{{ $y_link_final or '' }}" class="btn-trailer"><i class="fa fa-film" aria-hidden="true"></i> <span>Trailer</span></a></li>
												</ul>
											</div>

											<div class="bottom">
													<div class="duration-wrap">
														<img src="{{ URL::asset('resources/assets/img/duration-icon.png') }}">
														<span class="movie-duration">{{ $movie->duration }}</span>
													</div>
											</div>
										</div>

											<div class="movie-details">
												<span class="movie-year">{{ $movie->year }}</span>
												<span class="movie-rating"><img src="{{ URL::asset('resources/assets/img/imdb-icon.png') }}" class="imdb-icon"> {{ $movie->rating }} / 10</span>
											</div>
									</div>
								@endforeach
							@else
								<p class='note'>No Result</p>
							@endif
						</div>
					</div>
				</div>
			</div>
		</section>

		<script src='https://cdn.jsdelivr.net/jwplayer/7.1.4/jwplayer.js'></script>

		<script type='text/javascript'>
			jwplayer.key='fCj9VdkAZpIEzB6qrxAqVySBWYdrZVVduZX56g==';
			jwplayer('video').setup({ 
				sources: [{label: "<?php echo $link_label; ?>", file: "<?php echo $link_page; ?>"}],
				image: "<?php echo 'http://dewabioskop21.com/resources/assets/img/poster-movie.png'; ?>",
				width: '100%', 
				autostart: 'true',
			});
		</script>

	@stop
@extends('index_mobile')

	@section('content')

		<section>
			<div class="container">
				<div id="main-content">
					<div class="list-movie-wrap box">
							
							@if(isset($msg))
								{!! $msg !!}
							@endif

							@if( isset($moviedata) )

								@if( count($moviedata) != 0 )

									@if( isset($section_title) )	
										<h2 class="title">{{ $section_title }}</h2>
									@else
										<h2 class="title">List Movie</h2>
									@endif

									<div id="list-movie-wrap" class="movie-wrap">

										@foreach( $moviedata as $movie )
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
															<li><a href="{{ URL::to('/film/' . $movie->slug_id) }}"><i class="fa fa-play" aria-hidden="true"></i> <span>Watch Now</span></a></li>
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

										{!! $moviedata -> render() !!}
									</div>
								@else
									<p class="note">No Result</p>
								@endif
							@endif
					</div>
				</div>
			</div>
		</section>

	@stop
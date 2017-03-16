@extends('index')

	@section('content')
		<section id="main-section">
			<div class="container">
				<div class="row">
					<div class="col-md-12 movie-col">
						<div class="featured-movie-wrap">
							<a href='http://indoads.xyz/visit.php?id=12691&ref_id=701' target="_blank"><div class="banner-left" id="banner-left"></div></a>
							<a href='http://indoads.xyz/visit.php?id=12691&ref_id=701' target="_blank"><div class="banner-right" id="banner-right"></div></a>

							<div class="title-wrap">
								<h1 class="title">Featured Movie</h1>
								<a href="{{ URL::to('/featured') }}" class="btn-see-all">See All</a>
							</div>

							@if( count($moviedatafeatured) != 0 )
								@foreach( $moviedatafeatured as $movie )
									<div class="item" itemscope itemtype="http://schema.org/Movie">
										<div class="movie-thumb" style="background-image: url('{{ 'http://s1.dewabioskop21.com' . '/' . $movie->featured_image }}')" ><meta itemprop="image" content="{{ 'http://s1.dewabioskop21.com' . '/' . $movie->featured_image }}" />
											<div class="movie-title-wrap">
												<h2 class="movie-title" itemprop="name">{{ $movie->title }}</h2>
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
													<li><meta itemprop="director" content="{{ $movie->director }}" /> <a href="film/{{ $movie->slug_id }}"><i class="fa fa-play" aria-hidden="true" itemprop="url"></i><meta itemprop="url" content="http://dewabioskop21.com/film/{{ $movie->slug_id }}" /> <span>Watch</span></a></li>
													<li><a data-link="{{ $y_link_final or '' }}" class="btn-trailer" rel="nofollow" itemprop="trailer"><i class="fa fa-film" aria-hidden="true"></i> <span>Trailer</span></a></li>
												</ul>
											</div>

											<div class="bottom">
												<div class="duration-wrap">
													<img src="{{ URL::asset('resources/assets/img/duration-icon.png') }}" width="16px" height="16px">
													<span class="movie-duration" itemprop="duration">{{ $movie->duration }}</span>
												</div>

												<span class="btn-menu"><img src="{{ URL::asset('resources/assets/img/item-menu-icon.png') }}" width="22px" height="12px"></span>
											</div>
										</div>

										<div class="movie-details">
											<span class="movie-year">{{ $movie->year }}</span>
											<span class="movie-rating"><img src="{{ URL::asset('resources/assets/img/imdb-icon.png') }}" class="imdb-icon" width="31px" height="15px"> {{ $movie->rating }} / 10</span>
										</div>
										
									</div>
								@endforeach
							@else
								<p class='note'>No Result</p>
							@endif
						</div>
					</div>

					<div class="col-md-12 movie-col">
						<div class="featured-movie-wrap latest-movie-wrap">
							<div class="title-wrap">
								<h1 class="title">Latest Uploads Movie</h1>
								<a href="{{ URL::to('/latest-upload') }}" class="btn-see-all">See All </a>
							</div>

							@if( count($newuploadmovie) != 0 )
								@foreach( $newuploadmovie as $movie )
									<div class="item" itemscope itemtype="http://schema.org/Movie">
										<div class="movie-thumb" style="background-image: url('{{ 'http://s1.dewabioskop21.com' . '/' . $movie->featured_image }}')" ><meta itemprop="image" content="{{ 'http://s1.dewabioskop21.com' . '/' . $movie->featured_image }}" /><meta itemprop="director" content="{{ $movie->director }}" />
											<div class="movie-title-wrap">
												<h2 class="movie-title" itemprop="name">{{ $movie->title }}</h2>
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
													<li><a href="film/{{ $movie->slug_id }}" itemprop="url"><i class="fa fa-play" aria-hidden="true"></i> <span>Watch</span></a></li>
													<li><a data-link="{{ $y_link_final or '' }}" class="btn-trailer" rel="nofollow" itemprop="trailer"><i class="fa fa-film" aria-hidden="true"></i> <span>Trailer</span></a></li>
												</ul>
											</div>

											<div class="bottom">
												<div class="duration-wrap">
													<img src="{{ URL::asset('resources/assets/img/duration-icon.png') }}" width="16px" height="16px">
													<span class="movie-duration" itemprop="duration">{{ $movie->duration }}</span>
												</div>

												<span class="btn-menu"><img src="{{ URL::asset('resources/assets/img/item-menu-icon.png') }}" width="22px" height="12px"></span>
											</div>
										</div>

										<div class="movie-details">
											<span class="movie-year">{{ $movie->year }}</span>
											<span class="movie-rating" ><img src="{{ URL::asset('resources/assets/img/imdb-icon.png') }}" class="imdb-icon" width="31px" height="15px"> {{ $movie->rating }} / 10</span>
										</div>
										
									</div>
								@endforeach
							@else
								<p class='note'>No Result</p>
							@endif
						</div>
					</div>

					<div class="col-md-12 col-lg-9 movie-col">
						<div class="list-movie-wrap">
							<h1 class="title">Movie List ({{ $moviedata->total() }})</h1>

							@if( count($moviedata) != 0 )
								<?php $index = 1; ?>
								@foreach( $moviedata as $movie )
									<div class="item <?php echo ($index % 18 == 0) ? 'item-18' : ''; ?>" itemscope itemtype="http://schema.org/Movie">
										<div class="movie-thumb" style="background-image: url('{{ 'http://s1.dewabioskop21.com' . '/' . $movie->featured_image }}')" ><meta itemprop="image" content="{{ 'http://s1.dewabioskop21.com' . '/' . $movie->featured_image }}" /><meta itemprop="director" content="{{ $movie->director }}" >
											<div class="movie-title-wrap">
												<h2 class="movie-title" itemprop="name">{{ $movie->title }}</h2>
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
													<li><a href="film/{{ $movie->slug_id }}" itemprop="url"><i class="fa fa-play" aria-hidden="true"></i> <span>Watch</span></a></li>
													<li><a data-link="{{ $y_link_final or ''  }}" class="btn-trailer" rel="nofollow" itemprop="trailer"><i class="fa fa-film" aria-hidden="true"></i> <span>Trailer</span></a></li>
												</ul>
											</div>

											<div class="bottom">
												<div class="duration-wrap">
													<img src="{{ URL::asset('resources/assets/img/duration-icon.png') }}" width="16px" height="16px">
													<span class="movie-duration" itemprop="duration">{{ $movie->duration }}</span>
												</div>

												<span class="btn-menu"><img src="{{ URL::asset('resources/assets/img/item-menu-icon.png') }}" width="22px" height="12px"></span>
											</div>
										</div>

										<div class="movie-details">
											<span class="movie-year">{{ $movie->year }}</span>
											<span class="movie-rating" ><img src="{{ URL::asset('resources/assets/img/imdb-icon.png') }}" class="imdb-icon" width="31px" height="15px"> {{ $movie->rating }} / 10</span>
										</div>
									</div>
									<?php $index++; ?>
								@endforeach

								{!! $moviedata -> render() !!}
							@else
								<p class='note'>No Result</p>
							@endif
						</div>
					</div>

					<div class="col-md-3 sidebar-col">
						<div class="fb-wrap socmed-wrap">
							<h3 class="title">Social Media</h3>

							<ul class="socmed-list">
								<li class="pointer"><a title="Bbm" data-toggle="popover" data-placement="bottom" data-content="D860A227"><span class="icon icon-bbm"></span></a></li>
								<li class="pointer"><a title="Line" data-toggle="popover" data-placement="bottom" data-content="dewabioskop21"><span class="icon icon-line"></span></a></li>
							</ul>
						</div>

						<div class="filter-movie-wrap">
							<h3 class="title">Filter Movie</h3>

							<form action="{{ URL::to('/filter') }}" method="GET" class="filter-form">
								<select name="order">
									<option value="Asc">A to Z</option>
									<option value="Desc">Z to A</option>
								</select>

								<select name="genre_1">
									<option value="">Genre 1</option>
									<option value="Action">Action</option>
									<option value="Adventure">Adventure</option>
									<option value="Animation">Animation</option>
									<option value="Bioghraphy">Bioghraphy</option>
									<option value="Comedy">Comedy</option>
									<option value="Crime">Crime</option>
									<option value="Documentary">Documentary</option>
									<option value="Drama">Drama</option>
									<option value="Family">Family</option>
									<option value="Fantasy">Fantasy</option>
									<option value="Film">Film-Noir</option>
									<option value="History">History</option>
									<option value="Horror">Horror</option>
									<option value="Music">Music</option>
									<option value="Musical">Musical</option>
									<option value="Mystery">Mystery</option>
									<option value="Romance">Romance</option>
									<option value="Sci">Sci-Fi</option>
									<option value="Sport">Sport</option>
									<option value="Thriller">Thriller</option>
									<option value="War">War</option>
									<option value="Western">Western</option>
								</select>

								<select name="genre_2">
									<option value="">Genre 2</option>
									<option value="Action">Action</option>
									<option value="Adventure">Adventure</option>
									<option value="Animation">Animation</option>
									<option value="Bioghraphy">Bioghraphy</option>
									<option value="Comedy">Comedy</option>
									<option value="Crime">Crime</option>
									<option value="Documentary">Documentary</option>
									<option value="Drama">Drama</option>
									<option value="Family">Family</option>
									<option value="Fantasy">Fantasy</option>
									<option value="Film">Film-Noir</option>
									<option value="History">History</option>
									<option value="Horror">Horror</option>
									<option value="Music">Music</option>
									<option value="Musical">Musical</option>
									<option value="Mystery">Mystery</option>
									<option value="Romance">Romance</option>
									<option value="Sci">Sci-Fi</option>
									<option value="Sport">Sport</option>
									<option value="Thriller">Thriller</option>
									<option value="War">War</option>
									<option value="Western">Western</option>
								</select>

								<select name="country">
									<option value="">Country</option>
									<option value="Australia">Australia</option>
									<option value="China">China</option>
									<option value="Japan">Japan</option>
									<option value="USA">USA</option>
									<option value="Finland">Finland</option>
									<option value="Canada">Canada</option>
									<option value="Thailand">Thailand</option>
									<option value="Hong Kong">Hong Kong</option>
									<option value="France">France</option>
									<option value="Germany">Germany</option>
									<option value="India">India</option>
									<option value="United Kingdom">United Kingdom</option>
									<option value="Italy">Italy</option>
									<option value="Korea">Korea</option>
									<option value="Malaysia">Malaysia</option>
									<option value="Mexico">Mexico</option>
									<option value="Philippines">Philippines</option>
									<option value="Romania">Romania</option>
									<option value="Russia">Russia</option>
									<option value="Taiwan">Taiwan</option>
								</select>

								<select name="year">
									<option value="">Year</option>
									<option value="2016">2016</option>
									<option value="2015">2015</option>
									<option value="2014">2014</option>
									<option value="2013">2013</option>
									<option value="2012">2012</option>
									<option value="2011">2011</option>
									<option value="2010">2010</option>
									<option value="2009">2009</option>
									<option value="2008">2008</option>
									<option value="2007">2007</option>
									<option value="2006">2006</option>
									<option value="2005">2005</option>
									<option value="2004">2004</option>
									<option value="2003">2003</option>
									<option value="2002">2002</option>
									<option value="2001">2001</option>
									<option value="2000">2000</option>
									<option value="1999">1999</option>
									<option value="1998">1998</option>
									<option value="1997">1997</option>
								</select>								

								<input type="submit"  class="btn btn-default btn-submit" value="search movies">
							</form>
						</div>

						@if( count($bestmovie) != 0 )
							<div class="best-movie-wrap">
								<h3 class="title">Best Movies</h3>

								<div id="best-movie-slider">
									@foreach ($bestmovie as $movie)
										<div class="item" itemscope itemtype="http://schema.org/Movie">
											<span class="movie-title" itemprop="name">{{ $movie->title }}</span><meta itemprop="director" content="{{ $movie->director }}" />

											<div class="movie-thumb" style="background-image: url('{{ 'http://s1.dewabioskop21.com' . '/' . $movie->featured_image }}')" ><meta itemprop="image" content="{{ 'http://s1.dewabioskop21.com' . '/' . $movie->featured_image }}" /></div>

											<div class="right">
												<div class="duration-wrap">
													
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

													<span class="movie-duration" itemprop="duration">Duration <br>
														@if( $movie -> duration == '' )
															{{ '-' }}
														@else
															{{ $movie->duration }}
														@endif
													</span>
													<span class="movie-rating" >Rating <br>{{ $movie->rating }}</span>
													<span class="movie-year">Year <br>{{ $movie->year }}</span>
													<a href="{{ URL::to('/film/' . $movie->slug_id) }}" class="btn-watch" itemprop="url">Watch</a>								
													<a data-link="{{ $y_link_final or ''  }}" class="btn-trailer" rel="nofollow" itemprop="trailer">Trailer</a>
												</div>
											</div>
										</div>
									@endforeach
								</div>
							</div>
						@endif

						@if( count($comingsoonmovie) != 0 )
							<div class="coming-soon-wrap">
								<h3 class="title">Coming Soon</h3>

								<div id="coming-soon-slider">
									@foreach ($comingsoonmovie as $movie)
										<div class="item" itemscope itemtype="http://schema.org/Movie">
											<span class="movie-title" itemprop="name">{{ $movie->title }}</span>

											<div class="movie-thumb" style="background-image: url('{{ 'http://s1.dewabioskop21.com' . '/' . $movie->featured_image }}')" itemprop="image"></div>

											<div class="right">
												<div class="duration-wrap">
													<?php
														$cat_arr = explode(',', $movie -> category);
														$counter = 1;
													?>

													@foreach($cat_arr as $cat)
														<?php 
														if( $counter <= 3  )
															{ ?>
																@if( $cat != 'Coming Soon Selected' AND $cat != 'Coming Soon' )
																	<span class="movie-cat" itemprop="genre">{{ $cat }}</span>
																	<?php $counter++; ?>
																@endif
															<?php } ?>
													@endforeach

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

													<a data-link="{{ $y_link_final or ''  }}" class="btn-trailer" rel="nofollow" itemprop="trailer">Trailer</a>
												</div>
											</div>
										</div>
									@endforeach
								</div>
							</div>
						@endif

						<div class="fb-wrap">
							<h3 class="title">Like Our Facebook</h3>

							<div class="fb-page" data-href="https://www.facebook.com/Dewabioskop21-1181108945261103/" data-height="70" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/Dewabioskop21-1181108945261103/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Dewabioskop21-1181108945261103/">Dewabioskop21.com</a></blockquote></div>
						</div>

						<div  class="fb-wrap insta-wrap">
							<h3 class="title">Instagram</h3>
							
							<!-- InstaWidget -->
							<a href="https://instawidget.net/v/user/dewabioskop21" id="link-3317fdd0198ab3a47ce9b0edff28d0ba424c4e5999a9ae8aea839228116eb753">@dewabioskop21</a>
							<script src="https://instawidget.net/js/instawidget.js?u=3317fdd0198ab3a47ce9b0edff28d0ba424c4e5999a9ae8aea839228116eb753&width=100%"></script>

						</div>

<div  class="fb-wrap">
<a class="twitter-timeline" data-lang="id" data-height="300" data-dnt="true" href="https://twitter.com/dewabioskop21">Tweets by dewabioskop21</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
</div>

						<div  class="fb-wrap">
							<h3 class="title">Chat</h3>

							<script id="cid0020000149180883575" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style="width: 100%;height: 350px;">{"handle":"dewabioskop","arch":"js","styles":{"a":"00BC96","b":100,"c":"FFFFFF","d":"FFFFFF","k":"00BC96","l":"00BC96","m":"00BC96","n":"FFFFFF","p":"10","q":"00BC96","r":100,"fwtickm":1}}</script>

						</div>



					</div>
				</div>
			</div>
		</section>
	@stop

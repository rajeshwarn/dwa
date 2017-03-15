@extends('indexadmin')

	@section('contentadmin')

		<section id="dashboard-admin-section">
			<div class="container-fluid">
				<div class="row admin-row">
					<div class="col-md-2 left-dashboard">

						<div class="admin-identity-wrap">
							<img src="{{ URL::to('resources/assets/img/default_profile.png') }}" class="admin-thumb" width="40px" height="40px">
							<h3 class="greet-welcome">Welcome back, <br> {{ session('user') }}</h3>
						</div>

						<nav id="admin-main-menu">
							<ul>
								<li class="selected"><a href="movie"><i class="fa fa-film" aria-hidden="true"></i></i> Movies</a>
									<ul>
										<li class="selected"><a href="movie">Movie</a></li>
										<li><a href="new-movie">Add Movie</a></li>
										<li><a href="best-movie">Best Movies</a></li>
										<li><a href="coming-soon-movie">Coming Soon Movies</a></li>
										<li><a href="request-movie">Request</a></li>
										<li><a href="import">Import</a></li>
									</ul>
								</li>

								@if( session('role') == 'super-administrator' )
								<li><a href="user"><i class="fa fa-user" aria-hidden="true"></i> Users</a></li>
								<li><a href="social-profiles"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
								@endif
							</ul>
						</nav>
					</div>

					<div class="col-md-10 right-dashboard">

						<h2 class="title">ALL MOVIE</h2>

						@if(session() -> has('msg'))
							{!! session('msg') !!}
						@endif

						{!! $msg or '' !!}
						
						@if( app('request') -> input('filter') )
							<?php $filter = $_GET['filter']; ?>
						@else
							<?php $filter = ''; ?>
						@endif

						@if( app('request') -> input('sort') )
							<?php $sort = $_GET['sort']; ?>
						@else
							<?php $sort = ''; ?>
						@endif						

						<div class="table-movie-wrap">
							<div class="table-responsive">
								<form action="bulk-movie" method="POST">

									<div class="bulk-wrap">
										<select name="bulk-action">
											<option value="">Bulk Action</option>
											<option value="Delete Checked Item">Delete Checked Item</option>
										</select>

										<input type="hidden" name="_token" value="{{ csrf_token() }}">

										<button type="submit" class="btn btn-default btn-submit">Apply</button>
									</div>

									<span class="total-item">Total Item : {{ $total_item }}</span>

									<table class="table table-movie">
										<tr>
											<th><input type="checkbox" name="checkallmovie"></th>
											<th class="movie-title-head">
												<?php 
													if( $filter == 'title' AND $sort == 'asc' )
														{ ?>
															<a href="movie?filter=title&sort=desc">Title <i class="fa fa-sort-asc" aria-hidden="true"></i></a>
														<?php }
													else if( $filter == 'title' AND $sort == 'desc' )
														{ ?>
															<a href="movie?filter=title&sort=asc">Title <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
														<?php }
													else
														{ ?>
															<a href="movie?filter=title&sort=asc">Title <i class="fa fa-sort" aria-hidden="true"></i></a>
														<?php }
												?>
											</th>
											<th class="movie-rating-head">
												<?php
													if( $filter == 'rating' AND $sort == 'asc' )
														{ ?>
															<a href="movie?filter=rating&sort=desc">Rating <i class="fa fa-sort-asc" aria-hidden="true"></i></a>
														<?php }
													else if( $filter == 'rating' AND $sort == 'desc' )
														{ ?>
															<a href="movie?filter=rating&sort=asc">Rating <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
														<?php }
													else
														{ ?>
															<a href="movie?filter=rating&sort=asc">Rating <i class="fa fa-sort" aria-hidden="true"></i></a>
														<?php }
												?>
											</th>
											<th class="movie-year-head">
												<?php
													if( $filter == 'year' AND $sort == 'asc' )
														{ ?>
															<a href="movie?filter=year&sort=desc">Year <i class="fa fa-sort-asc" aria-hidden="true"></i></a>
														<?php }
													else if ( $filter == 'year' AND $sort == 'desc' )
														{ ?>
															<a href="movie?filter=year&sort=asc">Year <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
														<?php }
													else
														{ ?>
															<a href="movie?filter=year&sort=asc">Year <i class="fa fa-sort" aria-hidden="true"></i></a>
														<?php }
												?>
											</th>
											<th class="movie-category-head">
												<?php
													if( $filter == 'category' AND $sort == 'asc' )
														{ ?>
															<a href="movie?filter=category&sort=desc">Category <i class="fa fa-sort-asc" aria-hidden="true"></i></a>
														<?php }
													else if( $filter == 'category' AND $sort == 'desc' )
														{ ?>
															<a href="movie?filter=category&sort=asc">Category <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
														<?php }
													else
														{ ?>
															<a href="movie?filter=category&sort=asc">Category <i class="fa fa-sort" aria-hidden="true"></i></a>
														<?php }
												?>
											</th>
											<th class="movie-last-modify-head">
												<?php 
													if( $filter == 'updated_at' && $sort == 'asc' )
														{ ?>
															<a href="movie?filter=updated_at&sort=desc">Last Modified <i class="fa fa-sort-asc" aria-hidden="true"></i></a>		
														<?php }
													else if( $filter == 'updated_at' && $sort == 'desc' )
														{ ?>
															<a href="movie?filter=updated_at&sort=asc">Last Modified <i class="fa fa-sort-desc" aria-hidden="true"></i></a>		
														<?php }
													else
														{ ?>
															<a href="movie?filter=updated_at&sort=asc">Last Modified <i class="fa fa-sort" aria-hidden="true"></i></a>
														<?php }
												?>
											</th>
										</tr>

									@foreach ( $movie as $item )
										<?php 
											$last_modify = explode(' ', $item->updated_at);
										?>
										<tr class="item">
											<td><input type="checkbox" name="checkmovie[]" value="{{$item->id}}" class="checkmovie"></td>
											<td class="movie-title">
												<a class="btn-title-link" href="edit-movie/{{ $item->id }}">{{ $item->title }}</a>
												<div class="action-btn-wrap">
													<a class="btn-edit" href="edit-movie/{{ $item->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
													<button type="button" class="btn-trash" data-toggle="modal" data-id="{{ $item->id }}"><i class="fa fa-trash" aria-hidden="true"></i></button>
												</div>
											</td>
											<td class="movie-rating">{{ $item->rating }}</td>
											<td class="movie-year">{{ $item->year }}</td>
											<td class="movie-category"><p class="movie-category-pharagraph">{{ str_replace(',', ', ', $item->category) }}</p></td>
											<td class="movie-last-modify">{{ $last_modify[0] }}</td>
										</tr>							
									@endforeach

									</table>
								</form>
							</div>
						</div>	

						<div id="movie-paging-wrap">
							{{ $movie -> links() }}		
						</div>

					</div>
				</div>
			</div>
		</section>

		<div id="modal-confirm-delete-movie" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title">Delete Movie</h4>
		      </div>
		      <div class="modal-body">
		        <p>Are you sure you want to remove this item ?</p>
		        <div class="btn-action-wrap">
			        <a name="link-trash" href="">Yes</a>
			        <button type="button" class="btn btn-default btn-close" data-dismiss="modal">No</button>
		        </div>
		      </div>
		    </div>

		  </div>
		</div>
	@stop


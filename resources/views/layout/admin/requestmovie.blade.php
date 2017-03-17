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
										<li><a href="movie">Movie</a></li>
										<li><a href="new-movie">Add Movie</a></li>
										<li><a href="best-movie">Best Movies</a></li>
										<li><a href="coming-soon-movie">Coming Soon Movies</a></li>
										<li class="selected"><a href="request-movie">Request</a></li>
										<li><a href="import">Import</a></li>
									</ul>
								</li>

								@if( session('role') == 'super-administrator' )
								<li><a href="user"><i class="fa fa-user" aria-hidden="true"></i> Users</a></li>
								<li>
									<a href="client-sync"><i class="fa fa-users" aria-hidden="true"></i> Client Sync</a>
								</li>
								<li><a href="social-profiles"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
								@endif
							</ul>
						</nav>
					</div>

					<div class="col-md-10 right-dashboard">

						<h2 class="title">REQUEST MOVIE</h2>

						@if(session() -> has('msg'))
							{!! session('msg') !!}
						@endif

						{!! $msg or '' !!}

						<div class="request-movie-wrap right-main-wrap">

							<div class="info-wrap">
								<div>
									<div class="block-green"></div>
									Viewed
								</div>
								<div>
									<div class="block-red"></div>
									Unread
								</div>
							</div>

							<ul class="request-list">
								@foreach ( $requestmov as $request )
									<li>
										@if( $request->status == 'viewed' )
											<div class="viewed">
										@else
											<div class="unread">
										@endif
											<span class="request-title">{{ $request -> value }}</span>
											<div class="action-wrap">
												<a class="btn-open-request-movie" data-id="{{ $request->id }}">Open <i class="fa fa-eye" aria-hidden="true"></i></a>
												<a href="mark-request-movie/{{ $request->id }}" class="btn-mark-read">Mark as Read <i class="fa fa-check" aria-hidden="true"></i></a>
												<a href="delete-request-movie/{{ $request->id }}" class="btn-trash">Delete <i class="fa fa-trash" aria-hidden="true"></i></a>
											</div>
										</div>
									</li>
								@endforeach
							</ul>
						</div>

					</div>
				</div>
			</div>
		</section>

		<div id="modal-view-request-movie" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title">Request Movie</h4>
		      </div>
		      <div class="modal-body">
		      </div>
		    </div>

		  </div>
		</div>
	@stop


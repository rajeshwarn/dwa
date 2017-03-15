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
										<li class="selected"><a href="coming-soon-movie">Coming Soon Movies</a></li>
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

						<h2 class="title">COMING SOON</h2>

						@if(session() -> has('msg'))
							{!! session('msg') !!}
						@endif

						{!! $msg or '' !!}
						
						<button type="button" class="btn btn-default btn-add-coming-soon-movie" data-toggle="modal">Add Coming Soon Movie</button>

						<div class="coming-soon-movie-wrap">
							<ul>
								@foreach( $comingsoonmovie as $item )
									<li>
										<span class="movie-title">{{ $item->title }}</span>
										<a href="delete-coming-soon-movie/{{ $item->id }}" class="btn-trash-coming-soon-movie"><i class="fa fa-trash" aria-hidden="true"></i></a>
									</li>
								@endforeach
							</ul>
						</div>

					</div>
				</div>
			</div>
		</section>

		<div id="modal-coming-soon-movie" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Select 3 Movie for Coming Soon Category</h4>
				</div>

				<div class="modal-body body-movie-list">
					<ul class="movie-list">
					    @foreach( $movie as $item )
					    	<li data-id='{{ $item->id }}'><span class="movie-title">{{ $item->title }}</span> <i class="fa fa-plus" aria-hidden="true"></i></li>
					    @endforeach
					</ul>

					<div class="overlay-box">
						<span class="status"></span>
					</div>
				</div>
		    </div>

		  </div>
		</div>
	@stop


@extends('indexadmin')

	@section('contentadmin')

		<section id="dashboard-admin-section">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-2 left-dashboard">

						<div class="admin-identity-wrap">
							<img src="{{ URL::to('resources/assets/img/default_profile.png') }}" class="admin-thumb" width="40px" height="40px">
							<h3 class="greet-welcome">Welcome back, <br> {{ session('user') }}</h3>
						</div>

						<nav id="admin-main-menu">
							<ul>
								<li><a href="movie"><i class="fa fa-film" aria-hidden="true"></i> Movies</a></li>

								@if( session('role') == 'super-administrator' )
								<li><a href="user"><i class="fa fa-user" aria-hidden="true"></i> Users</a></li>
								<li>
									<a href="client-sync"><i class="fa fa-users" aria-hidden="true"></i> Client Sync</a>
								</li>
								<li class="selected"><a href=""><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>
									<ul>
										<li class="selected"><a href="social-profile">Social Profiles</a></li>
									</ul>
								</li>
								@endif
							</ul>
						</nav>
					</div>

					<div class="col-md-10 right-dashboard">
						<h2 class="title">SOCIAL PROFILE SETTING</h2>

						@if(session() -> has('msg'))
							{!! session('msg') !!}
						@endif

						<form id="edit-social-profile-form" action="post-edit-social-profiles" method="POST">
							<div class="form-group col-md-12">
								<label>Facebook</label>
								<input type="text" name="facebook-profile" value="{{ $social_fb->value or '' }}" class="form-control">
								<br>
								<label>Twitter</label>
								<input type="text" name="twitter-profile" value="{{ $social_twitter->value or '' }}" class="form-control">
							</div>

							<div class="form-group col-md-12">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">

								<button type="submit" class="btn btn-default btn-submit">Update</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>

	@stop
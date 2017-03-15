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
								<li class="selected"><a href="new-user"><i class="fa fa-user" aria-hidden="true"></i> Users</a>
									<ul>
										<li><a href="user">User</a></li>
										<li class="selected"><a href="new-user">Add User</a></li>
									</ul>
								</li>
								<li><a href="social-profiles"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
								@endif
							</ul>
						</nav>
					</div>

					<div class="col-md-10 right-dashboard">
						<h2 class="title">ADD NEW USER</h2>

						@if(session() -> has('msg'))
							{!! session('msg') !!}
						@endif

						<form id="new-user-form" action="post-new-user" method="POST">
							<div class="form-group col-md-12">
								<label>Role</label>
								<select name="user-role" class="form-control">
									<option value="super-administrator">Super Administrator</option>
									<option value="administrator">Administrator</option>
								</select>
							</div>

							<div class="form-group col-md-12">
								<label>Username (required)</label>
								<input type="text" name="username" value="{{ old('username') }}" class="form-control">
							</div>

							<div class="form-group col-md-12">
								<label>Email</label>
								<input type="text" name="user-email" value="{{ old('user-email') }}" class="form-control">
							</div>

							<div class="form-group col-md-12">
								<label>Name</label>
								<input type="text" name="user-name" value="{{ old('user-name') }}" class="form-control">
							</div>

							<div class="form-group col-md-12">
								<label>Password (required)</label>
								<input type="password" name="user-password" class="form-control">
							</div>

							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-group col-md-12">
								<button type="submit" class="btn btn-default">Add New User</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>

	@stop
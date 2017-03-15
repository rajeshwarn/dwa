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
								<li><a href="new-movie"><i class="fa fa-user" aria-hidden="true"></i> Movies</a></li>

								@if( session('role') == 'super-administrator' )
								<li class="selected"><a href="user"><i class="fa fa-user" aria-hidden="true"></i> Users</a></li>
								<li><a href=""><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
								@endif
							</ul>
						</nav>
					</div>

					<div class="col-md-10 right-dashboard">
						<h2 class="title">ADD NEW USER</h2>

						<form id="new-user-form" action="post-new-user" method="POST">
							<div class="form-group">
								<label>Username (required)</label>
								<input type="text" name="username" class="form-control">
							</div>

							<div class="form-group">
								<label>Emai (required)</label>
								<input type="text" name="email" class="form-control">
							</div>

							<div class="form-group">
								<label>Name</label>
								<input type="text" name="name" class="form-control">
							</div>

							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control">
							</div>

							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<button type="submit" class="btn btn-default">Add New User</button>
						</form>
					</div>
				</div>
			</div>
		</section>

	@stop
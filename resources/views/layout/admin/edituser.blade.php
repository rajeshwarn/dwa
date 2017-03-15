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
								<li><a href="../movie"><i class="fa fa-film" aria-hidden="true"></i> Movies</a></li>

								@if( session('role') == 'super-administrator' )
								<li class="selected"><a href="new-user"><i class="fa fa-user" aria-hidden="true"></i> Users</a>
									<ul>
										<li class="selected"><a href="../user">User</a></li>
										<li><a href="../new-user">Add User</a></li>
									</ul>
								</li>
								<li><a href="../social-profiles"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
								@endif
							</ul>
						</nav>
					</div>

					<div class="col-md-10 right-dashboard">
						<h2 class="title">EDIT USER</h2>

						@if(session() -> has('msg'))
							{!! session('msg') !!}
						@endif

						<form id="edit-user-form" action="../post-edit-user/{{ $user->id }}" method="POST">
							<div class="form-group col-md-12">
								<label>Role</label>								
								<select name="user-role" class="form-control">
									@if ( $user->role == str_replace(' ', '-', 'super administrator') OR $user->role == str_replace(' ', '-', 'Super Administrator') )
										<option value="super-administrator" selected="selected">Super Administrator</option>
									@else
										<option value="super-administrator">Super Administrator</option>
									@endif

									@if ( $user->role == 'administrator' OR $user->role == 'Administrator' )
										<option value="administrator" selected="selected">Administrator</option>
									@else
										<option value="administrator">Administrator</option>
									@endif
								</select>
							</div>

							<div class="form-group col-md-12">
								<label>Username</label>
								<input type="text" name="username" value="{{  $user->username or old('username') }}" class="form-control" disabled>
							</div>

							<div class="form-group col-md-12">
								<label>Email</label>
								<input type="text" name="user-email" value="{{ $user->email or old('user-email') }}" class="form-control">
							</div>

							<div class="form-group col-md-12">
								<label>Name</label>
								<input type="text" name="user-name" value="{{ $user->name or old('user-name') }}" class="form-control">
							</div>

							<div class="form-group col-md-12">
								<label>Password</label>
								<input type="password" name="user-password" class="form-control">
							</div>

							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-group col-md-12">
								<button type="submit" class="btn btn-default">Update</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>

	@stop
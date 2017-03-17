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
								<li><a href="user"><i class="fa fa-user" aria-hidden="true"></i> Users</a></li>
								<li class="selected">
									<a href="client-sync"><i class="fa fa-users" aria-hidden="true"></i> Client Sync</a>
									<ul>
										<li><a href="client-sync">Client Sync</a></li>
										<li  class="selected"><a href="new-client">Add Client</a></li>
									</ul>
								</li>
								<li><a href="social-profiles"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
								@endif
							</ul>
						</nav>
					</div>

					<div class="col-md-10 right-dashboard">
						<h2 class="title">ADD NEW CLIENT</h2>

						@if(session() -> has('msg'))
							{!! session('msg') !!}
						@endif

						<form id="new-client-form" action="post-new-client" method="POST">
							<div class="form-group col-md-12">
								<label>Client (required)</label>
								<input type="text" name="client-name" value="{{ old('client-name') }}" class="form-control">
								<p class="example">Example : http://example.com</p>
							</div>

							<div class="form-group col-md-12">
								<label>Time Sync</label>
								<input type="text" name="client-time" value="{{ old('client-time') }}" class="form-control">
							</div>

							<div class="form-group col-md-9">
				                <label>Category</label>
				                <ul class="category-list">
					                <li class="cat-coming-soon"><input type="checkbox" name="movie-category[]" value="Coming Soon">Coming Soon</li>
					                <li><input type="checkbox" name="movie-category[]" value="Action">Action</li>
					                <li><input type="checkbox" name="movie-category[]" value="Adventure">Adventure</li>
					                <li><input type="checkbox" name="movie-category[]" value="Animation">Animation</li>
					                <li><input type="checkbox" name="movie-category[]" value="Biography">Biography</li>
					                <li><input type="checkbox" name="movie-category[]" value="Comedy">Comedy</li>
					                <li><input type="checkbox" name="movie-category[]" value="Crime">Crime</li>
					                <li><input type="checkbox" name="movie-category[]" value="Documentary">Documentary</li>
					                <li><input type="checkbox" name="movie-category[]" value="Drama">Drama</li>
					                <li><input type="checkbox" name="movie-category[]" value="Family">Family</li>
					                <li><input type="checkbox" name="movie-category[]" value="Fantasy">Fantasy</li>
					                <li><input type="checkbox" name="movie-category[]" value="Film-Noir">Film-Noir</li>
					                <li><input type="checkbox" name="movie-category[]" value="History">History</li>
					                <li><input type="checkbox" name="movie-category[]" value="Horror">Horror</li>
					                <li><input type="checkbox" name="movie-category[]" value="Music">Music</li>
					                <li><input type="checkbox" name="movie-category[]" value="Musical">Musical</li>
					                <li><input type="checkbox" name="movie-category[]" value="Mystery">Mystery</li>
					                <li><input type="checkbox" name="movie-category[]" value="Romance">Romance</li>
					                <li><input type="checkbox" name="movie-category[]" value="Sci-Fi">Sci-Fi</li>
					                <li><input type="checkbox" name="movie-category[]" value="Sport">Sport</li>
					                <li><input type="checkbox" name="movie-category[]" value="Thriller">Thriller</li>
					                <li><input type="checkbox" name="movie-category[]" value="War">War</li>
					                <li><input type="checkbox" name="movie-category[]" value="Western">Western</li>
					            </ul>
				            </div>
							<div class="form-group col-md-12">
								<button type="submit" class="btn btn-default">Add New Client</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>

	@stop
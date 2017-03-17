<!DOCTYPE html>
<html>
	<head>
		<title>{{ $title }}</title>

		<link rel="shortcut icon" type="image/png" href="{{ URL::asset('resources/assets/img/fav-icon.png') }}">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="{{ URL::asset('resources/assets/css/font-awesome.css') }}">
		
		<link rel="stylesheet" href="{{ URL::asset('resources/assets/css/style.css?ver=1.0.1') }}">
	</head>
	<body>

		<header id="header-admin">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-2 header-col">
						<div class="logo-box">
							<a href="{{ URL::to('/') }}" class="logo"><img src="{{ URL::asset('resources/assets/img/logo.png') }}"></a>
						</div>
					</div>	

					<div class="col-md-10 header-col header-right">

						<form action="{{ URL::to('/dev-admin/movie') }}" method="GET" class="search-form">
							<div class="form-group search-movie-wrap">
								<input type="text" name="search" class="form-control" placeholder="Search Movie ...">
							</div>
						</form>

						<div class="right-header">
							<ul id="admin-top-right-menu">
							<li>
								<a><img src="{{ URL::to('resources/assets/img/default_profile.png') }}" class="admin-image-profile-thumb"> <i class="fa fa-angle-down" aria-hidden="true"></i></a>
								<div class="box-menu-wrap">
									<div class="menu">
										<a href="">Edit Profile</a>
										<span class="divider"></span>
										<a href="{{ URL::to('/dev-admin/logout') }}"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
									</div>
								</div>
							</li>
							</ul>
						</div>
					</div>				
				</div>
			</div>
		</header>
 
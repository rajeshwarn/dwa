<!DOCTYPE html>
<html>
	<head>
		<title>The page you were looking doesn't exist (404)</title>

		<link rel="shortcut icon" type="image/png" href="{{ URL::asset('resources/assets/img/fav-icon.png') }}">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<link rel="stylesheet" href="{{ URL::asset('resources/assets/css/font-awesome.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('resources/assets/css/style.css?ver=1.0.3') }}">
	</head>

	<body>

		<section>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="error-wrap">
							<a href="{{ URL::to('/') }}" class="logo"><img src="{{ URL::asset('resources/assets/img/logo.png') }}"></a>
							<h1 class="error-code">404</h1>
							<h3 class="error-explain">Page Not Found</h3>
							<p class="note">
								We are sorry but the page you were looking for cannot be found.
							</p>
							<br>
							<div class="action-wrap">
							<a class="btn-back" onclick="window.history.back()"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
							<a href="{{  URL::to('/') }}" class="btn-home"><i class="fa fa-home" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
				</div>
			</di>
		</section>

	</body>
</html>
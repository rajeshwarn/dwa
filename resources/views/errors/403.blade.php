<!DOCTYPE html>
<html>
	<head>
		<title>The page you were looking doesn't exist (404)</title>

		<link rel="shortcut icon" type="image/png" href="{{ URL::asset('resources/assets/img/fav-icon.png') }}">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<link rel="stylesheet" href="{{ URL::asset('resources/assets/css/font-awesome.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('resources/assets/css/style.css') }}">
	</head>

	<body>

		<section>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="error-wrap">
							<a href="{{ URL::to('/') }}" class="logo"><img src="{{ URL::asset('resources/assets/img/logo.png') }}"></a>
							<h1 class="error-code">403</h1>
							<h3 class="error-explain">Forbidden Access</h3>
							<p class="note">
								Your country is not allowed to access this site.
							</p>
							<br>
						</div>
					</div>
				</div>
			</di>
		</section>

	</body>
</html>
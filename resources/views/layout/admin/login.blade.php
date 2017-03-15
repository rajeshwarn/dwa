<!DOCTYPE html>
<html>
	<head>
		<title>Dewabioskop21 - Login</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="{{ URL::asset('resources/assets/css/style.css') }}">
	</head>
	
	<body>

		<section class="login-admin-section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div id="login-admin-wrap">
							<div class="logo-box">
								<a href="{{ URL::to('/') }}" class="logo"><img src="{{ URL::asset('resources/assets/img/logo.png') }}"></a>
							</div>

							@if(session() -> has('msg'))
								{!! session('msg') !!}
							@endif

							<form action="dev-admin/login" method="POST">
								<div class="form-group">
									<label>Username or Email</label>
									<input type="text" name="username" class="form-control username-input">
								</div>

								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password" class="form-control password-input">
								</div>

								<input type="hidden" name="_token" value="{{ csrf_token() }}">

								<div class="form-group">
									<button type="submit" class="btn btn-default btn-submit">Log in</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- JQUERY -->
	<script type="text/javascript" src="http://code.jquery.com/jquery-3.1.0.js" integrity="sha256-slogkvB1K3VOkzAI8QITxV3VzpOnkeNVsKvtkYLMjfk=" crossorigin="anonymous"></script>

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<!-- FONT AWESOME -->
		<script src="https://use.fontawesome.com/ddd8426796.js"></script>
	</body>
</html>
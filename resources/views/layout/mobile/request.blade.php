@extends('index_mobile')

	@section('content')

		<section>
			<div class="container">
				<div id="main-content">
					<div class="request-movie-wrap box">
						<h2 class="title">Request Movie</h2>

						<form id="request-form" method="POST" action="request">
							<input type="text" name="movie-req" placeholder="Write movie title here ..." required>

							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<button type="submit" class="btn-submit">SEND</button>
						</form>

						@if(session() -> has('msg'))
							{!! session('msg') !!}
						@endif
					</div>
				</div>
			</div>
		</section>

	@stop
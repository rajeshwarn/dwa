@extends('index_mobile')

	@section('content')

		<section>
			<div class="container">
				<div id="main-content">
					<div class="filter-movie-wrap box">
						<h2 class="title">Filter Movie</h2>

						<form action="{{ URL::to('/filter_mobile') }}" method="GET" id="filter-form">
							<select name="order">
								<option value="Asc">A to Z</option>
								<option value="Desc">Z to A</option>
							</select>

							<select name="genre_1">
								<option value="">Genre 1</option>
								<option value="Action">Action</option>
								<option value="Adventure">Adventure</option>
								<option value="Animation">Animation</option>
								<option value="Bioghraphy">Bioghraphy</option>
								<option value="Comedy">Comedy</option>
								<option value="Crime">Crime</option>
								<option value="Documentary">Documentary</option>
								<option value="Drama">Drama</option>
								<option value="Family">Family</option>
								<option value="Fantasy">Fantasy</option>
								<option value="Film">Film-Noir</option>
								<option value="History">History</option>
								<option value="Horror">Horror</option>
								<option value="Music">Music</option>
								<option value="Musical">Musical</option>
								<option value="Mystery">Mystery</option>
								<option value="Romance">Romance</option>
								<option value="Sci">Sci-Fi</option>
								<option value="Sport">Sport</option>
								<option value="Thriller">Thriller</option>
								<option value="War">War</option>
								<option value="Western">Western</option>
							</select>

							<select name="genre_2">
								<option value="">Genre 2</option>
								<option value="Action">Action</option>
								<option value="Adventure">Adventure</option>
								<option value="Animation">Animation</option>
								<option value="Bioghraphy">Bioghraphy</option>
								<option value="Comedy">Comedy</option>
								<option value="Crime">Crime</option>
								<option value="Documentary">Documentary</option>
								<option value="Drama">Drama</option>
								<option value="Family">Family</option>
								<option value="Fantasy">Fantasy</option>
								<option value="Film">Film-Noir</option>
								<option value="History">History</option>
								<option value="Horror">Horror</option>
								<option value="Music">Music</option>
								<option value="Musical">Musical</option>
								<option value="Mystery">Mystery</option>
								<option value="Romance">Romance</option>
								<option value="Sci">Sci-Fi</option>
								<option value="Sport">Sport</option>
								<option value="Thriller">Thriller</option>
								<option value="War">War</option>
								<option value="Western">Western</option>
							</select>

							<select name="country">
								<option value="">Country</option>
								<option value="Australia">Australia</option>
								<option value="China">China</option>
								<option value="Japan">Japan</option>
								<option value="USA">USA</option>
								<option value="Finland">Finland</option>
								<option value="Canada">Canada</option>
								<option value="Thailand">Thailand</option>
								<option value="Hong Kong">Hong Kong</option>
								<option value="France">France</option>
								<option value="Germany">Germany</option>
								<option value="India">India</option>
								<option value="United Kingdom">United Kingdom</option>
								<option value="Italy">Italy</option>
								<option value="Korea">Korea</option>
								<option value="Malaysia">Malaysia</option>
								<option value="Mexico">Mexico</option>
								<option value="Philippines">Philippines</option>
								<option value="Romania">Romania</option>
								<option value="Russia">Russia</option>
								<option value="Taiwan">Taiwan</option>
							</select>

							<select name="year">
								<option value="">Year</option>
								<option value="2016">2016</option>
								<option value="2015">2015</option>
								<option value="2014">2014</option>
								<option value="2013">2013</option>
								<option value="2012">2012</option>
								<option value="2011">2011</option>
								<option value="2010">2010</option>
								<option value="2009">2009</option>
								<option value="2008">2008</option>
								<option value="2007">2007</option>
								<option value="2006">2006</option>
								<option value="2005">2005</option>
								<option value="2004">2004</option>
								<option value="2003">2003</option>
								<option value="2002">2002</option>
								<option value="2001">2001</option>
								<option value="2000">2000</option>
								<option value="1999">1999</option>
								<option value="1998">1998</option>
								<option value="1997">1997</option>
							</select>								

							<button type="submit"  class="btn-submit">Filtering</button>

						</form>
					</div>
				</div>
			</div>
		</section>

	@stop
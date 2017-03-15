<?php

	include('simple_html_dom.php');

	$url = $_POST['link'];

	$html = file_get_html($url);

	if( $html -> find('h1.header', 0) )
		{
			$title_wrap = $html -> find("h1.header", 0);

			$title = trim($html -> find('h1.header', 0) -> plaintext);
			$slug_title = str_replace(':', '', trim($title));
			$slug_title = str_replace('(', '', $slug_title);
			$slug_title = str_replace(')', '', $slug_title);
			$slug_title = str_replace('.', ' ', $slug_title);
			$slug_title = str_replace(' &', '', $slug_title);
			$slug_title = str_replace('-&', '', $slug_title);
			$slug_title = str_replace('&', '', $slug_title);
			$slug_title = str_replace(' ', '-', $slug_title);
			$slug_title_final = str_replace("'", '', $slug_title);

			$explode_slug_final = explode("-", $slug_title_final);

			foreach ($explode_slug_final as $key => $value) 
				{
					if( trim($value) == '' )
						{
							unset($explode_slug_final[$key]);
						}
				}

			$slug_title_final = implode("-", $explode_slug_final);

			if( $title_wrap -> find('a', 0) )
				{
					$movie_year = $title_wrap -> find('a',0) -> plaintext;	
				}
			else
				{
					$movie_year = '';
				}
		}	

	if( $html -> find("h1[itemprop=name]",0) )
		{
			$title_no_decode = trim($html -> find("h1[itemprop=name]",0) -> plaintext);
			$title = str_replace('&nbsp;', ' ', $title_no_decode);
			$slug_title = str_replace(':', '', trim($title));
			$slug_title = str_replace('(', '', $slug_title);
			$slug_title = str_replace(')', '', $slug_title);
			$slug_title = str_replace('.', ' ', $slug_title);
			$slug_title = str_replace('-&', '', $slug_title);
			$slug_title = str_replace('&', '', $slug_title);
			$slug_title = str_replace(' ', '-', $slug_title);
			$slug_title_final = str_replace("'", '', $slug_title);

			$explode_slug_final = explode("-", $slug_title_final);

			foreach ($explode_slug_final as $key => $value) 
				{
					if( trim($value) == '' )
						{
							unset($explode_slug_final[$key]);
						}
				}

			$slug_title_final = implode("-", $explode_slug_final);
		}

	$title_explode = explode(" ", $title);

	foreach ($title_explode as $key => $value) 
		{
		  if( trim($value) == '' )
		    {
		      unset($title_explode[$key]);
		    }
		}

	$title = implode(" ", $title_explode);

	// DURATION
	$duration = $html -> find('time[itemprop=duration]',0) -> plaintext;
	$duration_final = trim($duration);
	
	// YEAR
	if( $html -> find('span[id=titleYear] a',0) )
		{
			$movie_year = $html -> find('span[id=titleYear] a',0) -> innertext;
		}
	else
		{
			if( $html -> find('h1.header', 0) )
				{
					if( $title_wrap -> find('a', 0) )
						{
							$movie_year = $title_wrap -> find('a',0) -> plaintext;	
						}
					else
						{
							$movie_year = '';
						}
				}
			else
				{
					$movie_year = '';
				}
		}

	// RATING
	if( $html -> find('span[itemprop=ratingValue]',0) )
		{
			$rating = $html -> find('span[itemprop=ratingValue]',0) -> innertext;
		}
	else
		{
			$rating = '';	
		}

	// CATEGORY
	if( $html -> find('div[itemprop=genre]',0) )
		{
			$category_div = $html -> find('div[itemprop=genre]',0);	
			
			foreach ($category_div -> find('a') as $item) 
				{
					$cat[] = ltrim($item -> innertext);
				}

			$cat_final = implode(',', $cat);
		}
	else
		{
			$cat_final = '';
		}

	// DESCRIPTION
	if( $html -> find('div[itemprop=description]', 0) )
		{
			$desc = trim($html -> find('div[itemprop=description]', 0) -> plaintext);
		}
	else
		{
			$desc = '';
		}

	// DETAILS OR COUNTRY
	if( $html -> find('div[id=titleDetails]', 0) )
		{
			$details_div = $html -> find('div[id=titleDetails]', 0);
			$country_div = $details_div -> find('.txt-block');

			foreach ($country_div[1] -> find('a') as $item) 
				{
					$country[] = $item -> innertext;
				}

			$country_final = implode(',', $country);
		}
	else
		{
			$country_final = '';
		}

	// DIRECTOR
	if( $html -> find('span[itemprop=director]') )
		{
			foreach ($html -> find('span[itemprop=director]') as $item) 
				{
					$director[] = $item -> find('a',0) -> plaintext;
				}

			$director_final = implode(',', $director);
		}
	else
		{
			if( $html -> find('div[itemprop=director]', 0) )
				{
					foreach ($html->find("div[itemprop=director] a span[itemprop=name]") as $item) 
						{
							$director[] = $item -> plaintext;
						}

					$director_final = implode(',', $director);
				}
			else
				{
					$director_final = '';
				}
		}

	// RELEASE DATE
	if( $html -> find('div.title_wrapper', 0) )
		{
			$title_wrapper_div = $html -> find('div.title_wrapper', 0);
			$release_date = trim($title_wrapper_div -> find('meta[itemprop=datePublished]', 0) -> parent() -> plaintext);
		}
	else
		{
			if( $html -> find('div.infobar', 0) )
				{
					$infobar_div = $html -> find("div.infobar",0);
					$release_date = trim($infobar_div -> find('meta[itemprop=datePublished]', 0) -> parent() -> plaintext);
				}
			else
				{
					$release_date = '';
				}
		}
	
	// ACTOR
	if( $html -> find('span[itemprop=actors] span.itemprop') )
		{
			foreach ($html -> find('span[itemprop=actors] span.itemprop') as $item) 
				{
					$actor[] = rtrim($item -> plaintext);
				}

			$actor_final = implode(',', $actor);
		}
	else
		{
			if( $html -> find('div[itemprop=actors]', 0) )
				{
					foreach ($html -> find("div[itemprop=actors] a span[itemprop=name]") as $item) 
						{
							$actor[] = trim($item -> plaintext);
						}

					$actor_final = implode(',', $actor);
				}
			else
				{
					$actor_final = '';
				}
		}

	// THUMBIMAGE
	if( $html -> find('img[itemprop=image]', 0) )
		{
			$thumbnail = $html -> find('img[itemprop=image]', 0) -> src;
			$get_img = file_get_contents($thumbnail);

			// file_put_contents("../resources/assets/img/poster-movie/" . $slug_title_final . ".jpg", $get_img);
			file_put_contents("../../s1/" . $slug_title_final . ".jpg", $get_img);

			// $thumbnail_final = 'http://dewabioskop21.com/resources/assets/img/poster-movie/' . $slug_title_final . ".jpg";
			$thumbnail_final = 'http://s1.dewabioskop21.com/' . $slug_title_final . ".jpg";
		}

	$data = ['title' => $title, 'duration' => $duration_final, 'year' => $movie_year, 'rating' => $rating, 'category' => $cat_final, 'desc' => $desc, 'country' => $country_final, 'director' => $director_final, 'release_date' => $release_date, 'actor' => $actor_final, 'thumbnail' => $thumbnail_final, 'thumbnail_name' => $slug_title_final . ".jpg"];
	
	echo json_encode(array('data' => $data));

	$html -> clear();

	
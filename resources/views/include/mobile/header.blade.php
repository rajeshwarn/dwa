<!DOCTYPE html>
<html>
	<head>
		<title>{{ $title }}</title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="Keywords" content="nonton movie, nonton film, nonton movie online, subtitle indonesia">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="publisher" content="dewabioskop21.com">
        <meta name="distribution" content="global">
        <meta http-equiv="copyright@ 2016 dewabioskop21.com" content="dewabioskop21.com">
        <meta name="webcrawlers" content="all">
        <meta name="rating" content="general">
        <meta name="spiders" content="all">
        <meta name="copyright" content="Dewabioskop21.com">
        <meta name="revisit-after" content="2">
        <meta name="Slurp" content='all'>
        <meta name="robots" content="index,follow">
        <meta name="DC.Publisher" content="Dewabioskop21.com">
        <meta name="msvalidate.01" content="834EE5C4885943FC020DC32D54C1DDF3">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ URL::asset('resources/assets/img/fav-icon.png') }}">
        <meta name="theme-color" content="#0F1824">        

        @if( isset($meta_desc) )
        <meta name="description" content="{{ $meta_desc }}"/>
        @else
        <meta name="description" content="Nonton Film Movie Online Bioskop Online Subtitle Indonesia Gratis Download Film Terbaru - dewabioskop21.com"/>
        @endif

        <meta name="robots" content="noodp"/>
        <link rel="canonical" href="http://dewabioskop21.com/"/>
        <meta property="og:locale" content="id_JK"/>
        <meta property="og:type" content="website"/>
        <meta property="og:title" content="{{ $title }}"/>

        @if( isset($meta_desc) )
        <meta property="og:description" content="{{ $meta_desc }}"/>
        @else
        <meta property="og:description" content="Nonton Film Movie Online Bioskop Subtitle Indonesia Gratis Download Film Terbaru - dewabioskop21.com"/>
        @endif

        <meta property="og:url" content="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>"/>
        <meta property="og:site_name" content="dewabioskop21.com DB21"/>
        <meta property="fb:app_id" content="1681579502111967"/>
        <meta property="og:image" content="http://dewabioskop21.com/resources/assets/img/logo.png"/>
        <meta name="twitter:card" content="summary"/>

        @if( isset($meta_desc) )
        <meta name="twitter:description" content="{{ $meta_desc }}"/>
        @else
        <meta name="twitter:description" content="Nonton Film Movie Online Bioskop Online Subtitle Indonesia Gratis Download Film Terbaru - dewabioskop21.com"/>
        @endif

        <meta name="twitter:title" content="{{ $title }}"/>
        <meta name="twitter:site" content="@dewabioskop21"/>

		<link rel="shortcut icon" type="image/png" href="{{ URL::asset('resources/assets/img/fav-icon.png') }}">

		<link rel="stylesheet" href="{{ URL::asset('resources/assets/css/owl.carousel.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('resources/assets/css/owl.theme.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('resources/assets/css/font-awesome.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('resources/assets/css/mobile/style.css?ver=1.0.0') }}">
	</head>

	<body>

		<div id="main-nav">
			<div class="middle">
				<div class="left">
					<ul>
						<li><a href="#year-menu">TAHUN</a></li>
						<li><a href="#country-menu">NEGARA</a></li>
						<li><a href="#popular-menu">POPULAR</a></li>
						<li class="ui-state-focus ui-tabs-active"><a href="#genre-menu">GENRE</a></li>
					</ul>
				</div>

				<div class="right">
					<div id="genre-menu" class="menu-box">
						<ul>
							<li><a href="{{ URL::to('/genre/action') }}">Action</a></li>
							<li><a href="{{ URL::to('/genre/adventure') }}">Adventure</a></li>
							<li><a href="{{ URL::to('/genre/animation') }}">Animation</a></li>
							<li><a href="{{ URL::to('/genre/bioghraphy') }}">Bioghraphy</a></li>
							<li><a href="{{ URL::to('/genre/comedy') }}">Comedy</a></li>
							<li><a href="{{ URL::to('/genre/crime') }}">Crime</a></li>
							<li><a href="{{ URL::to('/genre/documentary') }}">Documentary</a></li>
							<li><a href="{{ URL::to('/genre/drama') }}">Drama</a></li>
							<li><a href="{{ URL::to('/genre/family') }}">Family</a></li>
							<li><a href="{{ URL::to('/genre/fantasy') }}">Fantasy</a></li>
							<li><a href="{{ URL::to('/genre/film') }}-noir">Film-Noir</a></li>
							<li><a href="{{ URL::to('/genre/history') }}">History</a></li>
							<li><a href="{{ URL::to('/genre/horror') }}">Horror</a></li>
							<li><a href="{{ URL::to('/genre/music') }}">Music</a></li>
							<li><a href="{{ URL::to('/genre/musical') }}">Musical</a></li>
							<li><a href="{{ URL::to('/genre/mystery') }}">Mystery</a></li>
							<li><a href="{{ URL::to('/genre/romance') }}">Romance</a></li>
							<li><a href="{{ URL::to('/genre/sci') }}-fi">Sci-Fi</a></li>
							<li><a href="{{ URL::to('/genre/sport') }}">Sport</a></li>
							<li><a href="{{ URL::to('/genre/thriller') }}">Thriller</a></li>
							<li><a href="{{ URL::to('/genre/war') }}">War</a></li>
							<li><a href="{{ URL::to('/genre/western') }}">Western</a></li>
						</ul>	
					</div>

					<div id="popular-menu" class="menu-box">
						<ul>
							<li><a href="{{ URL::to('/popular') }}">Terpopuler</a></li>
							<li><a href="{{ URL::to('/rating') }}">IMDB Rating</a></li>
						</ul>
					</div>

					<div id="country-menu" class="menu-box">
						<ul>
							<li><a href="{{ URL::to('/country/Australia') }}">Australia</a></li>
							<li><a href="{{ URL::to('/country/China') }}">China</a></li>
							<li><a href="{{ URL::to('/country/Japan') }}">Japan</a></li>
							<li><a href="{{ URL::to('/country/USA') }}">USA</a></li>
							<li><a href="{{ URL::to('/country/Canada') }}">Canada</a></li>
							<li><a href="{{ URL::to('/country/Thailand') }}">Thailand</a></li>
							<li><a href="{{ URL::to('/country/Hong Kong') }}">Hong Kong</a></li>
							<li><a href="{{ URL::to('/country/France') }}">France</a></li>
							<li><a href="{{ URL::to('/country/Germany') }}">Germany</a></li>
							<li><a href="{{ URL::to('/country/India') }}">India</a></li>
							<li><a href="{{ URL::to('/country/United') }}">United Kingdom</a></li>
							<li><a href="{{ URL::to('/country/Italy') }}">Italy</a></li>
							<li><a href="{{ URL::to('/country/Korea') }}">Korea</a></li>
							<li><a href="{{ URL::to('/country/Malaysia') }}">Malaysia</a></li>
							<li><a href="{{ URL::to('/country/Mexico') }}">Mexico</a></li>
							<li><a href="{{ URL::to('/country/Philippines') }}">Philippines</a></li>
							<li><a href="{{ URL::to('/country/Romania') }}">Romania</a></li>
							<li><a href="{{ URL::to('/country/Russia') }}">Russia</a></li>
							<li><a href="{{ URL::to('/country/Taiwan') }}">Taiwan</a></li>
						</ul>
					</div>

					<div id="year-menu" class="menu-box">
						<ul>
							<li><a href="{{ URL::to('/year/2016') }}">2016</a></li>
							<li><a href="{{ URL::to('/year/2015') }}">2015</a></li>
							<li><a href="{{ URL::to('/year/2014') }}">2014</a></li>
							<li><a href="{{ URL::to('/year/2013') }}">2013</a></li>
							<li><a href="{{ URL::to('/year/2012') }}">2012</a></li>
							<li><a href="{{ URL::to('/year/2011') }}">2011</a></li>
							<li><a href="{{ URL::to('/year/2010') }}">2010</a></li>
							<li><a href="{{ URL::to('/year/2009') }}">2009</a></li>
							<li><a href="{{ URL::to('/year/2008') }}">2008</a></li>
							<li><a href="{{ URL::to('/year/2007') }}">2007</a></li>
							<li><a href="{{ URL::to('/year/2006') }}">2006</a></li>
							<li><a href="{{ URL::to('/year/2005') }}">2005</a></li>
							<li><a href="{{ URL::to('/year/2004') }}">2004</a></li>
							<li><a href="{{ URL::to('/year/2003') }}">2003</a></li>
							<li><a href="{{ URL::to('/year/2002') }}">2002</a></li>
							<li><a href="{{ URL::to('/year/2001') }}">2001</a></li>
							<li><a href="{{ URL::to('/year/2000') }}">2000</a></li>
							<li><a href="{{ URL::to('/year/1999') }}">1999</a></li>
							<li><a href="{{ URL::to('/year/1998') }}">1998</a></li>
							<li><a href="{{ URL::to('/year/1997') }}">1997</a></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="outer-right">
				<span><i class="fa fa-caret-left" aria-hidden="true"></i></span>
			</div>
		</div>

		<div id="search-wrap">
			<span class="btn-close"><i class="fa fa-times" aria-hidden="true"></i></span>

			<form action="{{ URL::to('/search') }}" method="GET" id="search-form">
				<input type="text" name="search" placeholder="Find your favorite movie">
			</form>
		</div>

		<div id="loading-wrap">
			<div class="content-loading">
				<img src="{{ URL::asset('resources/assets/img/preload-icon.gif') }}">
			</div>
		</div>

		<header>
			<div class="container">
				<div class="main-header">

					<div class="btn-nav"><i class="fa fa-bars" aria-hidden="true"></i></div>

					<div class="logo-box">
						<a href="{{ URL::to('/') }}"><img src="{{ URL::asset('resources/assets/img/logo.png') }}" class="logo"></a>
					</div>

					<span class="btn-search"><i class="fa fa-search" aria-hidden="true"></i></span>
				</div>
			</div>
		</header>
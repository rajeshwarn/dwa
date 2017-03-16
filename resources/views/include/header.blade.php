<!DOCTYPE html>
<html>
    <head>
        <title>{{ $title }}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
        @if( Route::current()->getName() == 'Single' )
            <meta property="og:url" content="http://dwa21.com/{{ Request::segment(1) }}/{{ Request::segment(2) }}" />
            <meta property="og:type" content="website" />
            <meta property="og:title" content="{{ $title }}" />
            <meta property="og:image" content="{{ 'http://s1.dewabioskop21.com' . '/' . $singlemovie->featured_image }}"/>
        @endif

      <!-- Facebook Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
            document,'script','https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '252413955210312', {
            em: 'insert_email_variable,'
            });
            fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=252413955210312&ev=PageView&noscript=1"
        /></noscript>
        <!-- DO NOT MODIFY -->
        <!-- End Facebook Pixel Code -->
     

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

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="//releases.flowplayer.org/6.0.5/skin/functional.css">

        <link rel="stylesheet" href="{{ URL::asset('resources/assets/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('resources/assets/css/owl.theme.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('resources/assets/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('resources/assets/css/style.css?ver=1.8.7') }}">
        <link rel="stylesheet" href="{{ URL::asset('resources/assets/css/style.responsive.css?ver=1.1.4') }}">

    </head>

    <body>

        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 top">
                        <nav class="left-menu">
                            <ul>
                                <li><a href="">HD Quality</a></li>
                                <li><a href="{{ URL::to('/dmca') }}">DMCA</a></li>
                                <li><a href="">Iklan</a></li>
                                <li><a href="{{ URL::to('/request') }}">Request</a></li>
                            </ul>
                        </nav>

                        <nav class="right-social">
                            <ul>
                                @foreach( $social as $link )
                                    @if( $link-> value != '' )
                                        @if( $link->item == 'facebook' )
                                            <li><a href="{{ $link->value }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        @elseif ( $link->item == 'twitter' )
                                            <li><a href="{{ $link->value }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <section class="middle">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 middle">
                            <div class="logo-wrap">
                                <a href="{{ URL::to('/') }}"><img src="{{ URL::asset('resources/assets/img/logo.png') }}" class="logo" width="auto"></a>
                            </div><!--
                            --><form action="{{ URL::to('/search') }}" method="GET" class="search-movie-form">
                                <input type="text" name="search" placeholder="Find your favorite movie">
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="main-menu">
                            <ul>
                                <li><a href="{{ URL::to('/') }}">HOME</a></li>
                                <li>
                                    <a href="#">GENRE <i class="fa fa-caret-down" aria-hidden="true"></i></a>
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
                                </li>
                                
                                <li>
                                    <a href="">POPULAR <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                    <ul>
                                        <li><a href="{{ URL::to('/popular') }}">Terpopuler</a></li>
                                        <li><a href="{{ URL::to('/rating') }}">IMDB Rating</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="">NEGARA <i class="fa fa-caret-down" aria-hidden="true"></i></a>
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
                                </li>
                                <li>
                                    <a href="">TAHUN <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                    <ul>
                                        <li><a href="{{ URL::to('/year/2017') }}">2017</a></li>
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
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <section class="bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="top-category-wrap">
                                Top Categories: 
                                <ul>
                                    @foreach ($topcategories as $item)
                                        <li><a href="{{ URL::to('/genre/' . strtolower($item -> name) ) }}">{{ $item -> name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </header>
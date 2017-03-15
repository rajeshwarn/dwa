<?php

	include('simple_html_dom.php');

	// function curl($url) {
	// 	$ch = @curl_init();
	// 	curl_setopt($ch, CURLOPT_URL, $url);
	// 	$head[] = "Referer:https://de.proxfree.com/permalink.php?url=eKcKvRAsZMJp3EkmD1K78%2Bqx%2FrqnRtIHySNzmMxUbxvJ%2FxfYKDbfQTtfxlzFz63ZA2PxrVLbAzRji7PR98co4KUo8OToTy25nhXHdedVcXsUt3WZdBKH09owwj58mvXq&bit=1";
	// 	$head[] = "Upgrade-Insecure-Requests:1";
	// 	$head[] = "Content-Type:application/x-www-form-urlencoded";
	// 	$head[] = "Cache-Control:max-age=0";
	// 	$head[] = "Connection:keep-alive";
	// 	$head[] = "Accept-Language:en-US,en;q=0.8,vi;q=0.6,und;q=0.4";
	// 	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
	// 	curl_setopt($ch, CURLOPT_ENCODING, '');
	// 	curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// 	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	// 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	// 	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	// 	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	// 	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	// 	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	// 		'Expect:'
	// 	));
	// 	$page = curl_exec($ch);
	// 	curl_close($ch);
	// 	return $page;
	// }

	// $link = $_POST['link'];
	$link = 'https://drive.google.com/file/d/0B4P0MwMUY-PLcnh6d0NnVk9pMWs/view?pli=1';

	// Via CURL
	// $get = curl($link); 
	// $get_explode = explode("<script>", $get);

	// Via SIMPLE HTML DOM
	$html = file_get_html($link);
	$all_script = $html -> find('script');	

	// Via SIMPLE HTML DOM
	$get_script_video = $all_script[6] -> innertext;

	// VIA CURL
	// $get_script_video = $get_explode[6];

	$script_video_decrypt1 = str_replace("\u003d", "=", $get_script_video);
	$script_video_decrypt2 = str_replace("\u0026", "&", $script_video_decrypt1);
	$script_video_decrypt3 = str_replace("%2C", ",", $script_video_decrypt2);

	preg_match_all("/\[[^\]]*\]/", $script_video_decrypt3, $matches);

	$all_link_vid_detail = $matches[0][25];

 	preg_match_all('/"(.*?)"/', $all_link_vid_detail, $all_link_vid_detail_arr);
	$all_link_vid = substr($all_link_vid_detail_arr[0][1], 1, -1);
	$all_link_vid_arr = explode("|", $all_link_vid);

	$i = 0;
	$count_all_link = count($all_link_vid_arr); 

	?>

	<style type="text/css">

		tr th {			
			background: red;
			text-align: center;
		}

		tr th.quality-head {
			width: 200px;
		}

		tr th.source-head {
			width: 200px;
		}

		tr td {
			padding: 10px;
			background: green;
			color: #fff;
			text-align: center;
		}

		tr td.link-item {
			display: inline-block;
			word-wrap: break-word;
			width: 600px;
		}

	</style>

	<?php 
		while ( $i < ($count_all_link-1)) 
			{ ?>
				<tr>
				<?php 

					if ( $i == 0 )
						{
							$code = $all_link_vid_arr[0];
							$link = preg_replace("/\/[^\/]+\.google\.com/","/redirector.googlevideo.com",substr($all_link_vid_arr[1], 0, -3));

							echo $code . "<br>";
							echo $link . "<br>";
						}
					else if( $i == ($count_all_link-1) )
						{
							$code = substr($all_link_vid_arr[$i-1], -2, 2);
							$link = preg_replace("/\/[^\/]+\.google\.com/","/redirector.googlevideo.com",$all_link_vid_arr[$i+1]);

							echo $code . "<br>";
							echo $link . "<br>";
						}
					else
						{
							$code = substr($all_link_vid_arr[$i], -2, 2);
							$link = preg_replace("/\/[^\/]+\.google\.com/","/redirector.googlevideo.com",substr($all_link_vid_arr[$i+1], 0, -3));

							echo $code . "<br>";
							echo $link . "<br>";
						}
				$i++;
			} ?>
<?php
$url='http://tv.zing.vn/video/phim60s-dot-info/'.$_GET['url'].'.html';
function _viewSource($url, $timeout = 15)
			{
			    $ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, $url);
			    curl_setopt($ch, CURLOPT_HTTPGET, true);
			    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			    curl_setopt($ch, CURLOPT_FAILONERROR, true);
			    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
			    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
			    $result = curl_exec($ch);
			    if (curl_errno($ch)) {
			        return false;
			    } else {
			        return $result;
			    }
			}
			
			
				$video = _viewSource($url);
				$video = explode("document.write",$video);
				$video=$video[2];
				$video = explode('"',$video);
				$link=$video[1];
header('Location:'.$link);
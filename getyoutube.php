<?php
# Info head
function VideoYoutubeID($url) {
	preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
	$id = $matches[0];
	return $id;
}
# Get BY Curl
function curlGet($URL) {
    $ch = curl_init();
    $timeout = 3;
    curl_setopt( $ch , CURLOPT_URL , $URL );
    curl_setopt( $ch , CURLOPT_RETURNTRANSFER , 1 );
    curl_setopt( $ch , CURLOPT_CONNECTTIMEOUT , $timeout );
	/* if you want to force to ipv6, uncomment the following line */ 
	//curl_setopt( $ch , CURLOPT_IPRESOLVE , 'CURLOPT_IPRESOLVE_V6');
    $tmp = curl_exec( $ch );
    curl_close( $ch );
    return $tmp;
}
$url = $_REQUEST['url'];
$my_id = VideoYoutubeID($url);
			$my_video_info = 'http://www.youtube.com/get_video_info?&video_id='.$my_id;
			$my_video_info = curlGet($my_video_info);
			$thumbnail_url = $title = $url_encoded_fmt_stream_map = $type = $url = '';
			parse_str($my_video_info);
			if(isset($url_encoded_fmt_stream_map)) {
				$my_formats_array = explode(',',$url_encoded_fmt_stream_map);
			}
			$avail_formats[] = '';
			$i = 0;
			$ipbits = $ip = $itag = $sig = $quality = '';
			$expire = time(); 
			foreach($my_formats_array as $format) {
				parse_str($format);
				$avail_formats[$i]['itag'] = $itag;
				$avail_formats[$i]['quality'] = $quality;
				$type = explode(';',$type);
				$avail_formats[$i]['type'] = $type[0];
				$avail_formats[$i]['url'] = urldecode($url) . '&signature=' . $sig;
				parse_str(urldecode($url));
				$avail_formats[$i]['expires'] = date("G:i:s T", $expire);
				$avail_formats[$i]['ipbits'] = $ipbits;
				$avail_formats[$i]['ip'] = $ip;
				$i++;
			}
			if(count($avail_formats) > 1) {
				for ($i = 0; $i < count($avail_formats); $i++) {
					$url = $avail_formats[$i]['url'];
					//$chatluong = $avail_formats[$i]['type'].' ('.$avail_formats[$i]['quality'].')';
					//$html.= "<a href=\"$url\" title=\"Chất lượng $chatluong\" target=\"_blank\">$chatluong</a>&nbsp;-&nbsp;";
					preg_match('/itag=([0-9]+)/',$avail_formats[$i]['url'],$tm);
					if(in_array($tm[1],array(18,35,22))) {
						$height = (int)str_replace(array(18,35,22),array(360,480,720),$tm[1]);
						$file[] = (string)'{label: "' . $height . '", file: "' . $url . '", type:"mp4"}';
					}
				}
			}
			$jwplayer = (string)'sources: [' . @implode(",",$file) . ']';

echo "
<script src='http://jwpsrv.com/library/SWlTcn0MEeO43SIACi0I_Q.js'></script>
<div id='playeruMVMOjYqLNLj'></div>
<script type='text/javascript'>
    jwplayer('playeruMVMOjYqLNLj').setup({
        ".$jwplayer.",
        image: '//www.longtailvideo.com/content/images/jw-player/lWMJeVvV-876.jpg',
        width: '100%',
        aspectratio: '16:9',
        autostart: 'true',
        repeat: 'true'
    });
</script>
";
?>



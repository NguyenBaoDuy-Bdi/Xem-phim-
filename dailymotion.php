<?php
function unescapeUTF8EscapeSeq($str) {
    return preg_replace_callback("/\\\u([0-9a-f]{4})/i",
        create_function('$matches',
            'return html_entity_decode(\'&#x\'.$matches[1].\';\', ENT_QUOTES, \'UTF-8\');'
        ), $str);
}
# Get BY Curl
function curlGet($URL) {
    $ch = curl_init();
    $timeout = 3;
    curl_setopt( $ch , CURLOPT_URL , $URL );
    curl_setopt( $ch , CURLOPT_RETURNTRANSFER , 1 );
    curl_setopt( $ch , CURLOPT_CONNECTTIMEOUT , $timeout );
	/* if you want to force to ipv6, uncomment the following line */ 
	curl_setopt( $ch , CURLOPT_IPRESOLVE , 'CURLOPT_IPRESOLVE_V6');
    $tmp = curl_exec( $ch );
    curl_close( $ch );
    return $tmp;
}
$url = $_REQUEST['url'];
$get = curlGet($url);
$cat = explode(',["fmt_stream_map","', $get); 
	$cat = explode('"]', $cat[1]);
	$cat = explode(',', $cat[0]);
	foreach($cat as $link){
		$cat = explode('|', $link);
		$links = str_replace(array('\u003d', '\u0026'), array('=', '&'), $cat[1]);
		if($cat[0] == 37) {$f1080p = $links;}
		if($cat[0] == 22) {$f720p = $links;}
		if($cat[0] == 59) {$f480p = $links;}
		if($cat[0] == 43) {$f360p = $links;}
	}
	if(isset($f1080p)){
			$js  = 'sources: [{file: "'.$f1080p.'&format=getlink/sharingland.mp4",label: "1080p"},
						{file: "'.$f720p.'&format=getlink/sharingland.mp4",label: "720p"},
						{file: "'.$f480p.'&format=getlink/sharingland.mp4",label: "480p"},
						{file: "'.$f360p.'&format=getlink/sharingland.mp4",label: "360p","default": "true"}]';
		} elseif(isset($f720p)){
			$js  = 'sources: [{file: "'.$f720p.'&format=getlink/sharingland.mp4",label: "720p"},
						{file: "'.$f480p.'&format=getlink/sharingland.mp4",label: "480p"},
						{file: "'.$f360p.'&format=getlink/sharingland.mp4",label: "360p","default": "true"}]';
		} elseif(isset($f480p)){
			$js  = 'sources: [{file: "'.$f360p.'&format=getlink/sharingland.mp4",label: "360p","default": "true"},
						{file: "'.$f480p.'&format=getlink/sharingland.mp4",label: "480p"}]';
		} else {
			$js  = 'file: "' . trim($f360p) . '",label: "360p" ,type:"mp4" ' . $_DefaultQT;
	}
echo "
<script src='http://jwpsrv.com/library/SWlTcn0MEeO43SIACi0I_Q.js'></script>
<div id='playeruMVMOjYqLNLj'></div>
<script type='text/javascript'>
    jwplayer('playeruMVMOjYqLNLj').setup({
        ".$js.",
        image: '//www.longtailvideo.com/content/images/jw-player/lWMJeVvV-876.jpg',
        width: '100%',
        aspectratio: '16:9',
        autostart: 'true',
        repeat: 'true'
    });
</script>
";
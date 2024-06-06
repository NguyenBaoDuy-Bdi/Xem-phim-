<?php
error_reporting(E_ERROR | E_PARSE);
function get_curl($url){
	$ch = @curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	$head[] = "Connection: keep-alive";
	$head[] = "Keep-Alive: 300";
	$head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$head[] = "Accept-Language: en-us,en;q=0.5";
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
	curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
	$page = curl_exec($ch);
	curl_close($ch);
	return $page;
}
function testcache($url,$expire){
	$dir = 'cache';
	$file = '/cache/'.$url.'.txt';
	if (!is_dir($dir)) {
		mkdir($dir, 0777);
	}
	if(file_exists($file) && filemtime($file) > (time() - $expire))
	{
		$dataplay = file_get_contents($file);
	}
	else
	{
		$dataplay = '';
	}
	return $dataplay; 
}
function savecache($name,$dataplay)
{	
	$file = 'cache/'.$name.'.txt';
	$fp = fopen($file, "w");
	fputs($fp, $dataplay);
	fclose($fp);
}
function clearcache($expire_time)
{
	$captchaFolder  = 'cache/';
	$fileTypes      = '*.txt';
	foreach (glob($captchaFolder . $fileTypes) as $Filename) 
	{
		$FileCreationTime = filectime($Filename);
		$FileAge = time() - $FileCreationTime; 
		if ($FileAge > $expire_time){
			unlink($Filename);
		}
	}
}
function checklink($link) {
	if(strpos($link,"googleusercontent")){
		$server .= get_redirect_url($link);
	}
	else {
		$server .= $link;
	}
	return $server;		
}

function fptlink($str){
	$str = str_replace('#','%23',$str);
	return $str;
}
function geth($url) {
$get = get_headers($url);
$link = explode('Location: ', $get[1]);
$data = $link[1];
return $data;
}
function picasa($link) {
	$name = md5($link);
		$expire = 2629743; //enter value sec
		$testcache = testcache($name,$expire);
		if($testcache!='')
		{
			$js = $testcache;
		}
		else
		{
	$url = urldecode($link);
	if (stristr($url, '#')) list($url, $id) = explode('#', $url);
	$data = get_curl($url);
	if($id) $vlgoogle = explode($id, $data);
	if($vlgoogle[7] != ''){ 
		$vlgoogle = explode('{"url":"', ($id)?$vlgoogle[7]:$data);
	}else{
		$vlgoogle = explode('{"url":"', ($id)?$vlgoogle[6]:$data);
	} 
	$dm240p = urldecode(reset(explode('"', $vlgoogle[3])));
	$dm360p = urldecode(reset(explode('"', $vlgoogle[2])));
	$dm480p = urldecode(reset(explode('"', $vlgoogle[4])));
	$dm720p = urldecode(reset(explode('"', $vlgoogle[5])));
	$dm1080p = urldecode(reset(explode('"', $vlgoogle[6])));
	if(strpos($dm1080p, 'itag=37') || strpos($dm1080p, '=m32') || strpos($dm1080p, '=m37')){
		$js .= 'sources: [{file:"'.$dm1080p.'",label: "1080p",type: "video/mp4"},
				{file:"'.$dm720p.'",label: "720p",type: "video/mp4"},
				{file:"'.$dm360p.'", label: "360p","default": "true",type:"mp4"}]';
	}
	elseif(strpos($dm720p, 'itag=22') || strpos($dm720p, '=m22')){
		$js .= 'sources: [{file:"'.$dm360p.'", label: "360p","default": "true",type:"mp4"},
				{file:"'.$dm720p.'",label: "720p",type: "video/mp4"}]';
	}
	else {
		$js .= 'sources: [{file:"'.$dm360p.'", label: "360p","default": "true",type:"mp4"}]';
		}
	savecache($name,$js);
		}
	return $js;
}


//Get link Plus
function plus($link) {
	$get = get_curl($link);
	$data = explode(',[18,640,360,"', $get);
	$data = explode('"]', $data[1]);
	$v360p = str_replace('\u003d', '=', $data[0]);
	$v720p = str_replace(array(',[22,1280,720,"', '\u003d'), array('', '='), $data[1]);
	$v1080p = str_replace(array(',[37,1920,1080,"', '\u003d'), array('', '='), $data[2]);
	if($v1080p != '' and (strpos($v1080p, '=m')  !== false)){
		$js .= '<source src="'.$v360p.'" type="video/mp4" data-res="360" />';
		$js .= '<source src="'.$v720p.'" type="video/mp4" data-res="720" />';
		$js .= '<source src="'.$v1080p.'" type="video/mp4" data-res="1080" />';
	}elseif($v720p != '' and (strpos($v720p, '=m')  !== false)) {
		$js .= '<source src="'.$v360p.'" type="video/mp4" data-res="360" />';
		$js .= '<source src="'.$v720p.'" type="video/mp4" data-res="720" />';
	}else{
		$js .= '<source src="'.$v360p.'" type="video/mp4" data-res="360" />';
	}
	return $js;
}

//Get link Docs
function docs($link) {
	$get = get_curl($link);
	$cat = explode(',["fmt_stream_map","', $get); $cat = explode('"]', $cat[1]);
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
				$js .= '<source src="'.$f1080p.'" type="video/mp4" data-res="1080" />';
				$js .= '<source src="'.$f720p.'" type="video/mp4" data-res="720" />';
				$js .= '<source src="'.$f480p.'" type="video/mp4" data-res="480" />';
				$js .= '<source src="'.$f360p.'" type="video/mp4" data-res="360" />';
	} elseif(isset($f720p)){
				$js .= '<source src="'.$f720p.'" type="video/mp4" data-res="720" />';
				$js .= '<source src="'.$f480p.'" type="video/mp4" data-res="480" />';
				$js .= '<source src="'.$f360p.'" type="video/mp4" data-res="360" />';
	} elseif(isset($f480p)){
				$js .= '<source src="'.$f480p.'" type="video/mp4" data-res="480" />';
				$js .= '<source src="'.$f360p.'" type="video/mp4" data-res="360" />';
	} else {
				$js .= '<source src="'.$f360p.'" type="video/mp4" data-res="360" />';
	}
	return $js;
}

//Get link youtube
function youtube($link) {
	if ($get = file_get_contents($link)) {
		if (preg_match('/;ytplayer\.config\s*=\s*({.*?});/', $get, $data)) {
			$jsonData  = json_decode($data[1], true);
            $streamMap = $jsonData['args']['url_encoded_fmt_stream_map'];
            $videoUrls = array();

            foreach (explode(',', $streamMap) as $url)
            {
				$url = str_replace('\u0026', '&', $url);
                $url = urldecode($url);

                parse_str($url, $data);
                $dataURL = $data['url'];
                unset($data['url']);

                $videoUrls[] = array($data['itag'],$data['quality'],$dataURL.'&'.urldecode(http_build_query($data)));
            }
            return $videoUrls;
        }
    }
    return array();
}

//Get link zing
function del($url){
	$data = explode("?format", $url);
	return $data[0];
}
function zingtv($link){
	preg_match('/http:\/\/tv.zing.vn\/video\/(.*)\/(.*).html/U', $link, $id);
	$data = 'http://api.tv.zing.vn/2.0/media/info?api_key=d04210a70026ad9323076716781c223f&media_id='.$id[2];
	$dataapi = file_get_contents('compress.zlib://'.$data);
	preg_match('/"file_url": "(.*)",/U', $dataapi, $v360);
	preg_match('/"Video480": "(.*)"/U', $dataapi, $v480);
	preg_match('/"Video720": "(.*)"/U', $dataapi, $v720);
	if($v720[1]){
		$js .='sources: [{file:"http://'.del($v360[1]).'",label: "360p",type: "video/mp4"},
		{file:"http://'.del($v480[1]).'",label: "480p",type: "video/mp4"},
		{file:"http://'.del($v720[1]).'",label: "720p",type: "video/mp4"}]';
	}elseif($v480[1]){
		$js .= 'sources: [{file:"http://'.del($v360[1]).'",label: "360p",type: "video/mp4"},
		{file:"http://'.del($v480[1]).'",label: "480p",type: "video/mp4"}]';
	}else{
		$js .='sources: [{file:"http://'.del($v360[1]).'",label: "360p",type: "video/mp4"}]';	
	}
	return $js;
}

//Get link Clip.vn
function get_clipvn($id){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://clip.vn/ajax/login');
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Requested-With: XMLHttpRequest'));
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('username' => '', 'password' => '', 'persistent' => 1));

    curl_setopt($ch, CURLOPT_URL, 'http://clip.vn/movies/nfo/'.$id);
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('onsite' => 'clip'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
function clipvn($link) {
	$get = get_curl($link);
	preg_match("/Clip.App.clipId = '(.*)';/U",$get,$id);
	preg_match_all("#<enclosure url='(.*?)' duration='([0-9]+)' id='(.*?)' type='(.*?)' quality='([0-9]+)' (.*?) />#is", get_clipvn($id[1]), $data);
	if($data[1][1] != '') {
		$js .= '<source src="'.$data[1][0].'" type="video/mp4" data-res="360p"/>'; 
		$js .= '<source src="'.$data[1][1].'" type="video/mp4" data-res="720p"/>';
	} else {
		$js .= '<source src="'.$data[1][0].'" type="video/mp4" data-res="360p"/>'; 
	}
	return $js;
}



//End TV.ZING.VN
/*
function plus_google_direct($link){
	preg_match('/https:\/\/plus.google.com\/photos\/(.*)\/albums\/(.*)\/(.*)?pid=(.*)&oid=(.*)/U', $link, $id);
	$picasa = 'https://picasaweb.google.com/data/feed/tiny/user/'.$id[1].'/photoid/'.$id[3].'?alt=jsonm';
	$get = get_curl($picasa);
	preg_match_all("/<media:content url='(.*)' height='(.*)' width='(.*)' type='(.*)'\/>/U", $get, $data);
	$type_img = array('image/jpeg','image/png','image/gif');
	foreach($data[2] as $i => $quality) {
		if($quality	== '360') {
			$js .= '<source src="' . ($data[1][$i]) . '" type="video/mp4" data-res="360p" />';
		} elseif($quality > '360' and $quality <= '720') {
			$js .= '<source src="' . ($data[1][$i]) . '" type="video/mp4" data-res="720p" />';
		} elseif($quality > '720' and $quality <= '1080') {
			$js .= '<source src="' . ($data[1][$i]) . '" type="video/mp4" data-res="1080p" />';
		}
	}
	return $js;
}
*/
function photos($link){
	$_HtmlDATA = @file_get_contents($link);
	$data = explode('url\u003d', $_HtmlDATA);
	$link = explode('%3Dm', $data[1]);
	$decode = urldecode($link[0]);
	$count = count($data);
	if($count > 4) {
        $v1080p = $decode.'=m37';
        $v720p = $decode.'=m22';
        $v360p = $decode.'=m18';
        $js .= (string)'sources: [{label: "360p", file: "'.$v360p.'", type:"mp4"},{label: "720p", file: "'.$v720p.'", type:"mp4"},{label: "1080p", file: "'.$v1080p.'", type:"mp4"}]';	
    }
    elseif($count > 3) {
        $v720p = $decode.'=m22';
        $v360p = $decode.'=m18';
        $js .= (string)'sources: [{label: "360p", file: "'.$v360p.'", type:"mp4"},{label: "720p", file: "'.$v720p.'", type:"mp4"}]';	
    }
    elseif($count > 2) {
        $v360p = $decode.'=m18';
        $js .= (string)'sources: [{label: "360p", file: "'.$v360p.'", type:"mp4"}]';
    }
	return $js;
}
function kaiEncode($m){
	$m = base64_encode($m);
	$m = str_replace("H","@zbsg",$m);
	$m = str_replace("G","hxbg@",$m);
	$m = str_replace("R","BeF!",$m);
	$m = str_replace("W","^ISgjs",$m);
	$m = str_replace("E","*6zfga",$m);
	return $m;
}
function player($epid,$type='') {
	if($type != 'video') {
		$episode = MySql::dbselect('id,name,filmid,url,subtitle,thumb,datetime_post,default_subtitle_id','episode',"id = '$epid'");
		$url = $episode[0][3];
		$subtitles_db = MySql::dbselect('subtitle_lang,subtitle_url,id','subtitle',"episode_id = $epid");
		$subtitle = $subtitles_db[0][1];
		$nextid = one_data('id','episode',"id > '$epid' AND filmid = '$filmid' AND url LIKE '%".$link_nxt_type."%'");
	} else {
		$url = $epid;
	}
	$filmid = $episode[0][2];
	if(strpos($url , 'picasa') !== false){
		$linkget = picasa($url);
	}
	
	
	else if(strpos($url, 'photos.google.com') !== false){
		$linkget = photos($url);
	}
	else if(strpos($url, 'plus.google.com') !== false){
		$linkget = plus($url);
	}
	
	else if(strpos($url, 'tv.zing.vn') !== false){
		$linkget = zingtv($url);
	}
	
	else if(strpos($url, 'clip.vn') !== false){
		$linkget = clipvn($url);
	}
	/*
	else if(strpos($url, 'tv.zing.vn')){
		$zing = $url;
		$explode = explode("/",$zing);
		$id = explode(".",$explode[5]);
		$link = "http://tv.zing.vn/embed/video/$id[0]";
		$linken = base64_encode($link);
		$linkget = file_get_contents('http://phim88s.tk/players/plugins/zing.php?zing='.$linken);
	}
	else if(strpos($url, 'plus.google.com')){
		$link = base64_encode($url);
		$linkget = file_get_contents('http://phim88s.tk/players/plugins/plus.php?plus='.$link);
	}
	else if(strpos($url, 'docs.google.com')){
		$link = base64_encode($url);
		$linkget = file_get_contents('http://phim88s.tk/players/plugins/plus.php?Google-Docs='.$link);
	}
	else if(strpos($url, 'clip.vn')){
		$link = base64_encode($url);
		$linkget = file_get_contents('http://phim88s.tk/players/plugins/clipvn.php?clipvn='.$link);
	}
	*/
	else{
		$linkget = '';
	}	
	if(strpos($url , 'picasaweb') !== false){
		$mplayer = '
	<script type="text/javascript" src="'.SITE_URL.'/jw-7.4.3/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key="dWwDdbLI0ul1clbtlw+4/UHPxlYmLoE9Ii9QEw==";</script>
<div id="mediaplayer"></div><script type="text/javascript">jwplayer("mediaplayer").setup({
		'.$linkget.',
		
        autostart: "true",
		height: "300",
        width: "100%",
        primary: "html5",
		tracks: [{file: "'.$subtitle.'",
    						label: "Vie",
            				kind: "captions",
            				"default": true	}],
            			    captions: {
							        color: "#FFFFFF",
							        backgroundOpacity: 70
							    	   },events: {
			onTime: function(event) {
                var time = Math.floor(event.position);
				var counter = 0;
				if(time == 300){
					if(counter == 0){
						updateMovieView('.$filmid.');
						counter++;
					}
					
				}
            }
		}});</script>';
	}
	elseif(strpos($url , 'photos.google.com') !== false){
		$mplayer = '
	<script type="text/javascript" src="'.SITE_URL.'/jw-7.4.3/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key="dWwDdbLI0ul1clbtlw+4/UHPxlYmLoE9Ii9QEw==";</script>
<div id="mediaplayer"></div><script type="text/javascript">jwplayer("mediaplayer").setup({
		'.$linkget.',
		
        autostart: "true",
	height: "300",
        width: "100%",
        primary: "html5",
		tracks: [{file: "'.$subtitle.'",
    						label: "Vie",
            				kind: "captions",
            				"default": true	}],
            			    captions: {
							        color: "#FFFFFF",
							        backgroundOpacity: 70
							    	   },events: {
			onTime: function(event) {
                var time = Math.floor(event.position);
				var counter = 0;
				if(time == 300){
					if(counter == 0){
						updateMovieView('.$filmid.');
						counter++;
					}
					
				}
            }
		}});</script>';
	}
	
	elseif(strpos($url, 'docs.google.com') || strpos($url, 'drive.google.com') !== false){
		$url = str_replace("drive.google.com","docs.google.com",$url);
		$fid = explode("docs.google.com/file/d/",$url);
		$fid = explode("/",$fid[1]);
		$fid = $fid[0];
		$fid = kaiEncode($fid);
		$url = "https://docs.google.com/file/d/"."hayphim.tv-".$fid."/edit?pli=1";
		$mplayer = '<script type="text/javascript" src="http://hayphim.tv/player/gkphp/gkpluginsphp.js?v=2018"></script><div id="player1" style="width:100%;height:350px;"></div><script type="text/javascript">gkpluginsphp("player1",{link:"'.$url.'",autostart:true});</script>';
	}
	elseif(strpos($url , 'fptplay.net') !== false){
		$mplayer = '<iframe frameborder="0" width="100%" height="300px" src="http://hayphim.tv/player.php?url='.fptlink($url).'" allowfullscreen></iframe>';
	}
	elseif(strpos($url , 'vivo.vn') !== false){
		$mplayer = '<iframe frameborder="0" width="100%" height="300px" src="http://hayphim.tv/player.php?url='.$url.'" allowfullscreen></iframe>';
	}
	elseif(strpos($url , 'phim.megabox.vn') !== false){
		$mplayer = '<iframe frameborder="0" width="100%" height="300px" src="http://hayphim.tv/player.php?url='.$url.'" allowfullscreen></iframe>';
	}
	elseif(strpos($url , 'youtube.com') !== false){
		$mplayer = '<iframe frameborder="0" width="100%" height="300" src="http://hayphim.tv/getyoutube.php?url='.$url.'" allowfullscreen></iframe>';
	}
	else if (strpos($url,'openload.co') !== false){
		$data = explode('/', $url1);
		$link = explode('/', $data[4]);
		$openload = $link[0];
		$mplayer = '<iframe allowfullscreen="true" width="100%" height="100%" frameborder="0" src="https://openload.co/embed/'.$openload.'/" scrolling="no"></iframe>'; 
	}	
	elseif(strpos($url , 'iframe') !== false){
		$mplayer = UnHtmlChars($url);
	}
	
	elseif(strpos($url , 'googleusercontent.com') || strpos($url , 'blogspot.com') !== false){
		$mplayer = '<script type="text/javascript" src="'.SITE_URL.'/jw-7.4.3/jwplayer.js"></script><script type="text/javascript">jwplayer.key="dWwDdbLI0ul1clbtlw+4/UHPxlYmLoE9Ii9QEw==";</script>
		<div id="mediaplayer"></div><script type="text/javascript">jwplayer("mediaplayer").setup({
		sources: [{file:"'.$url.'", label: "360p","default": "true",type:"mp4"}],
		
        autostart: "true",
		height: "300",
        width: "100%",
        primary: "html5",
		events: {
			onTime: function(event) {
                var time = Math.floor(event.position);
				var counter = 0;
				if(time == 300){
					if(counter == 0){
						updateMovieView('.$filmid.');
						counter++;
					}
					
				}
            }
		}
		});</script>';
	}
	
	elseif($linkget != ''){
		$mplayer = '<script type="text/javascript" src="'.SITE_URL.'/jw-7.4.3/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key="dWwDdbLI0ul1clbtlw+4/UHPxlYmLoE9Ii9QEw==";</script>
<div id="mediaplayer"></div><script type="text/javascript">jwplayer("mediaplayer").setup({
		'.$linkget.',
		
        autostart: "true",
	height: "300",
        width: "100%",
        primary: "html5",
		tracks: [{file: "'.$subtitle.'",
    						label: "Vie",
            				kind: "captions",
            				"default": true	}],
            			    captions: {
							        color: "#FFFFFF",
							        backgroundOpacity: 70
							    	   },events: {
			onTime: function(event) {
                var time = Math.floor(event.position);
				var counter = 0;
				if(time == 300){
					if(counter == 0){
						updateMovieView('.$filmid.');
						counter++;
					}
					
				}
            }
		}});</script>';
	}
	
	else{
		$mplayer = '<iframe frameborder="0" width="100%" height="300px" src="/player.php?url='.$url.'" allowfullscreen></iframe>';
	}
	//else {
	//	$mplayer = '<video id="myplayer" class="video-js vjs-default-skin" controls autoplay="autoplay" width="100%" height="100%" poster="'.$thumb.'" data-setup="">
	//				   <track src="'.$subtitle.'" kind="subtitles" srclang="vi" label="Vietnamese" default>
	//		 </video>Co The Link Phim Da Bi Loi! Vui Long Lien He Admin...';
	//}
	echo $mplayer;
}
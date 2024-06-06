<?php
require_once("phpfastcache/3.0.0/phpfastcache.php");
error_reporting(E_ERROR | E_PARSE);

//Get link Picasa
function quality_url($type) {
	$id = intval($type);
	if($id  <= 360) {
		$quality = '360';
	} elseif($id  <= 720) {
		$quality = '720';
	} elseif($id  <= 1080) {
		$quality = '1080';
	}
	return $quality;
}

function vshd_get_picasa($link) {
		$data = curlx($link);
		$fuck = explode(',"thumbnail":', $data);
		$count = (count($fuck) - 2);
		$shit = $fuck[$count];
		preg_match_all('/{"url":"(.*)","height":(.*),"width":(.*),"type":"(.*)"}/U', $shit, $arr_link);
		foreach ($arr_link[4] as $key => $value) {
			if(strpos($value, 'video/mpeg4') !== false)
				$html .= '<source data-res="'.quality_url($arr_link[2][$key]).'p" src="'.$arr_link[1][$key].'" type="video/mp4" />';
		}
		return $html;
}
function curlx($url) {
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
function dailymotion_direct($url){
// http://www.dailymotion.com/video/xx55ef_khi-vo-co-bo_shortfilms
		$ID = explode('video/',$url);
		$ID = explode('_',$ID[1]);
		$ID = $ID[0];
        $source = get_curl_x('http://www.dailymotion.com/embed/video/'.$ID.'/');
        $xml = explode('stream_h264_', $source);
		$mp4 = '';
            for($i=5;$i>=1;$i--){
	           $video = explode('":"',$xml[$i]);
	           $video = explode('"',$video[1]);
               $mp4_src =  bocaidau(urlencode($video[0]));
			   if($mp4_src){
			   $type = explode('H264-',$mp4_src);
			   $type = explode('/',$type[1]);
			   $type = $type[0];
			   $type = explode('x',$type);
			   $type = $type[1];
			   $mp4 .= '<source data-res="'.$type.'p" src="'.$mp4_src.'&phimle.mp4" type="video/mp4" />';
			   }
	        } 
return $mp4;

}
//xvideos
function xvideos($link, $quality){
    
    $full_content = tw_get_content_xvideos($link);
    preg_match("/fakepicture_nopoppup', (.*?)'low'\); <\/script>/is", $full_content, $data);
    preg_match_all("/'http:\/\/(.*?)'/is", $data[1], $match);
    if(stripos($match[1][1], 'xvideos.com/videos/mp4') !== false){
        $itemlarge = 'http://'.$match[1][1];
    }
    $itemmedium = 'http://'.$match[1][0];
    if($quality == 'file' && $itemmedium)
        return $itemmedium;
    if($quality == 'file' && !$itemmedium)
        return $itemlarge;
    elseif($quality == 'large.file' && $itemlarge)
        return $itemlarge;
    elseif($quality == 'large.file' && !$itemlarge)
        return $itemmedium;
    elseif($quality == 'hd.file' && $itemlarge)
        return $itemlarge;
    else
        return $itemmedium;
    
}

function get_youporn($url, $ref = 'http://youporn.com', $header = false){
        
        $ch = curl_init();
        $headers[] = "Accept-Language: en-us,en;q=0.5";
        $headers[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
        $headers[] = "Keep-Alive: 115";
        $headers[] = "Connection: keep-alive";
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        $headers[] = "X-Forwarded-For: 118.69.184.28";
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2049.0 Safari/537.36');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_REFERER, $ref);
        curl_setopt($ch, CURLOPT_COOKIE, 'cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, str_replace(' ', '%20', $url));
        $data = curl_exec($ch);
        curl_close($ch);
        if($header){
            preg_match('/Location: http:\/\/(.*?)(\s|\n)/is', $data, $rd);
            return 'http://'.$rd[1];
        }
        else
            return $data;
}
//youporn.com
function youporn($link, $quality){

    $full_content = get_youporn($link);
   if(preg_match("/videoSrc = '(.*?)'/is", $full_content, $data)){
    return $data['1'];
}else{
		return SITE_URL.'/error.mp4';
}
}

function pornhub($link, $q){
    
    $key = explode('viewkey=', $link);
    $embed = get_youporn('http://www.pornhub.com/embed/' . $key[1]);
    preg_match("/src([\s]+): '(.*?)',/s", $embed, $stream);
    return $stream[2];
}
function clipvn($link){
$url = file_get_contents('http://hayphimhd.com/clipvn.php?url='.$link);
return $url;
}
function spankwire($data){
if(preg_match_all('#<span id="spanDownIPhone"><a href="(.+?)"(.+?)class="display-block bold">(.+?)</a></span>#is',$data,$url)){
return $url[1][0];
}else{
	return SITE_URL.'/error.mp4';
}
}

function redtube($data){
if(preg_match_all('#<video src="(.+?)"(.+?)>(.+?)</video>#is',$data,$url)){
return $url[1][0];
}else{
	return SITE_URL.'/error.mp4';
}
}

function xoa($url){
	$data = explode("?format", $url);
	return $data[0];
}
function fptlink($str){
	$str = str_replace('#','%23',$str);
	return $str;
}
function zingtv($link){
	preg_match('/http:\/\/tv.zing.vn\/video\/(.*)\/(.*).html/U', $link, $id);
	$data = 'http://api.tv.zing.vn/2.0/media/info?api_key=d04210a70026ad9323076716781c223f&media_id='.$id[2];
	$dataapi = file_get_contents('compress.zlib://'.$data);
	preg_match('/"file_url": "(.*)",/U', $dataapi, $v360);
	preg_match('/"Video480": "(.*)"/U', $dataapi, $v480);
	preg_match('/"Video720": "(.*)"/U', $dataapi, $v720);
	if($v720[1]){
		$js .= '<source src="http://'.xoa($v360[1]).'" type="video/mp4" data-res="360"/>';
		$js .= '<source src="http://'.xoa($v480[1]).'" type="video/mp4" data-res="480"/>';
		$js .= '<source src="http://'.xoa($v720[1]).'" type="video/mp4" data-res="720"/>';
	}elseif($v480[1]){
		$js .= '<source src="http://'.xoa($v360[1]).'" type="video/mp4" data-res="360"/>';
		$js .= '<source src="http://'.xoa($v480[1]).'" type="video/mp4" data-res="480"/>';
	}else{
		$js .= '<source src="http://'.xoa($v360[1]).'" type="video/mp4" data-res="360"/>';	
	}
	return $js;
}

function get_megabox($content_id,$link){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://phim.megabox.vn/content/get_link_video_lab');
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Requested-With: XMLHttpRequest'));
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('link' => $link, 'type' => '0', 'content_id' => $content_id));
	
    curl_setopt($ch, CURLOPT_URL, 'http://phim.megabox.vn/content/get_link_video_lab');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $data = curl_exec($ch);
    curl_close($ch);
	return $data;
}
//Get link Clip.vn
function get_clipvn($id){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://clip.vn/ajax/login');
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Requested-With: XMLHttpRequest'));
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('username' => 'offervn2012', 'password' => '29111988', 'persistent' => 1));

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

function blogspot($link){
	$js .= '<source src="'.$url.'" type="video/mp4" data-res="360"/>';	
	return $js;
}

$cache = phpFastCache();
$products = $cache->get($link);
if($products == null) {
	$products = get_curl($link);
	$cache->set($link,$products , 1728000);
	echo "";
} else {
	echo "";
	echo $products;
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
	
	if(strpos($url , 'picasa') !== false){
		$linkget = vshd_get_picasa($url);
	}
	
	else if(strpos($url, 'plus.google.com') !== false){
		$linkget = plus($url);
	}
	
	else if(strpos($url, 'tv.zing.vn') !== false){
		$linkget = tvzing($url);
	}
	
	else if(strpos($url, 'clip.vn') !== false){
		$linkget = clipvn($url);
	}
	
	else if(strpos($url, 'googleusercontent.com') !== false){
		$linkget = blogspot($url);
	}
	
	//else if(strpos($url, 'docs.google.com') !== false){
	//	$linkget = docs($url);
	//}
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
	if($linkget != ''){
		$mplayer = '<video id="myplayer" class="video-js vjs-default-skin" controls autoplay="autoplay" width="100%" height="100%" poster="'.$thumb.'" data-setup="">
					  '.$linkget.'
					   <track src="'.$subtitle.'" kind="subtitles" srclang="vi" label="Vietnamese" default>
					  </video>
					  <script type="text/javascript">
							videojs("#myplayer",{ 
							plugins : { 
							resolutionSelector : {
							default_res : "360px"
							} 
						} 
					})     
		</script>';
	}else{
		$mplayer = "<script src=\"".TEMPLATE_URL."js/jwplayer5.js\"></script><script>$(document).ready(function(){onjwplayer('$url','$subtitle','$nextid');});</script>";
	}
	//else {
	//	$mplayer = '<video id="myplayer" class="video-js vjs-default-skin" controls autoplay="autoplay" width="100%" height="100%" poster="'.$thumb.'" data-setup="">
	//				   <track src="'.$subtitle.'" kind="subtitles" srclang="vi" label="Vietnamese" default>
	//		 </video>Co The Link Phim Da Bi Loi! Vui Long Lien He Admin...';
	//}
	echo $mplayer;
}
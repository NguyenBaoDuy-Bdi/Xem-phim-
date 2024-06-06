<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
$main_title = Config_Model::ConfigName('site_name');
$main_description = Config_Model::ConfigName('site_description');
$main_keywords = Config_Model::ConfigName('site_keywords');
require_once 'simple_html_dom.php';
// youtube 

class YoutbeDownloader
{
    private static $endpoint = "http://www.youtube.com/get_video_info";

    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    public function getLink($id)
    {
        $API_URL = self::$endpoint . "?&video_id=" . $id;
        $video_info = $this->curlGet($API_URL);

        $url_encoded_fmt_stream_map = '';
        parse_str($video_info);
        if(isset($reason))
        {
            return $reason;
        }
        if (isset($url_encoded_fmt_stream_map)) {
            $my_formats_array = explode(',', $url_encoded_fmt_stream_map);
        } else {
            return 'No encoded format stream found.';
        }
        if (count($my_formats_array) == 0) {
            return 'No format stream map found - was the video id correct?';
        }
        $avail_formats[] = '';
        $i = 0;
        $ipbits = $ip = $itag = $sig = $quality = $type = $url = '';
        $expire = time();
        foreach ($my_formats_array as $format) {
            parse_str($format);
            $avail_formats[$i]['itag'] = $itag;
            $avail_formats[$i]['quality'] = $quality;
            $type = explode(';', $type);
            $avail_formats[$i]['type'] = $type[0];
            $avail_formats[$i]['url'] = urldecode($url) . '&signature=' . $sig;
            parse_str(urldecode($url));
            $avail_formats[$i]['expires'] = date("G:i:s T", $expire);
            $avail_formats[$i]['ipbits'] = $ipbits;
            $avail_formats[$i]['ip'] = $ip;
            $i++;
        }
        return $avail_formats;
    }

    function curlGet($URL)
    {
        $ch = curl_init();
        $timeout = 3;
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $tmp = curl_exec($ch);
        curl_close($ch);
        return $tmp;
    }
} 


function youtube($url){
$qualitys = YoutbeDownloader::getInstance()->getLink($url);
if(is_string($qualitys))
{
    echo    $qualitys;
}
else {

foreach($qualitys as $video => $value) {
if($value['itag'] == '22') {
echo '{"file":"'.$value[url].'","title":720}';
}
if($value['itag'] == '18') {
echo ',{"file":"'.$value[url].'","title":480}';
}
if($value['itag'] == '17') {
echo ',{"file":"'.$value[url].'","title":240}';
}
}
}

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
if(!function_exists('ip')){
    function ip() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
// porn.com
function porn($link, $quality){

    $content = file_get_contents($link);
   preg_match('#<video poster="data:image/gif,AAAA" autoplay="autoplay" src="(.+?)"></video>#is',$content,$linka);
   print_r($link);
}
//xhamster.com
function xhamster($link, $quality){

    $content = file_get_contents($link);
    preg_match("/file: '(.+?)',/is", $content, $stream);
    return $stream[1];
}



function get($url){
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: text/html','charset:UTF-8'));
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPad; CPU OS 6_0 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A5355d Safari/8536.25');
curl_setopt($curl, CURLOPT_REFERER, 'http://google.com');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
$data = curl_exec($curl);
curl_close($curl);
return $data;
}
function get_direct($url){    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ch);
    if(preg_match('#Location: (.*)#', $result, $r))
    return trim($r[1]);
}


if(!function_exists('tw_get_content_xvideos')){
    function tw_get_content_xvideos($url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_USERAGENT, 'iPhone (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_URL, $url);
        $data = curl_exec($curl);
        return $data;
    }
}


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
function getXMLLink($url){
    $source = curlx($url);
    $start = strpos($source, 'https://picasaweb.google.com/data/feed/base/user/');
    $end = strpos($source, '?alt=');
    $link = substr($source, $start, $end - $start);
    $pos = strpos($url, '#');
    $photoid_array = explode('#', $url);
    $photoid = trim($photoid_array[1], ' ');
    
    $link .= '/photoid/' . $photoid . '?';
    $link .= 'alt=jsonm&authkey=';
    
    $authkey_array = explode('authkey=', $url);
    $authkey = $authkey_array[1];
    
    $authkey_array = explode('#', $authkey);
    $authkey = $authkey_array[0];
    
    $link .= $authkey;
    $link = str_replace('base', 'tiny', $link);
    
    //$link = str_replace(' ', '', $link);
    
    return $link;
}
function getJson($xml_link){
    $sourceJson = curlx($xml_link);
    $decodeJson = json_decode($sourceJson);
    return $decodeJson->feed->media->content;
}

/*function vshd_get_picasa($link) {
		//$linkpica = explode("/",$link);
		if(strpos($link , 'authkey') !== false){
		$json = getJson(getXMLLink($link));	
			foreach ($json as $data){
			if(strpos($data->type, 'video/mpeg4') !== false)
				$html .= '<source data-res="'.quality_url($data->height).'p" src="'.$data->url.'" type="video/mp4" />';
			}
		}else{
		$data = curlx($link);
		$fuck = explode(',"thumbnail":', $data);
		$count = (count($fuck) - 2);
		$shit = $fuck[$count];
		preg_match_all('/{"url":"(.*)","height":(.*),"width":(.*),"type":"(.*)"}/U', $shit, $arr_link);
		foreach ($arr_link[4] as $key => $value) {
			if(strpos($value, 'video/mpeg4') !== false)
				$html .= '<source data-res="'.quality_url($arr_link[2][$key]).'p" src="'.$arr_link[1][$key].'" type="video/mp4" />';
		}
		}
		return $html;
}*/
function vshd_get_picasa($link) {
		$name = md5($link);
		$expire = 1800; //enter value sec
		$testcache = testcache($name,$expire);
		if($testcache!='')
		{
			$html = $testcache;
		}
		else
		{
		if(strpos($link , 'authkey') !== false){
		$json = getJson(getXMLLink($link));	
			foreach ($json as $data){
			if(strpos($data->type, 'video/mpeg4') !== false)
				$html .= '<source data-res="'.quality_url($data->height).'p" src="'.$data->url.'" type="video/mp4" />';
				//$file[] = (string)'{label: "'.quality_url($data->height).'p", file: "'.$data->url.'", type:"mp4"}';
			}
		}else{
		$data = curlx($link);
		$fuck = explode(',"thumbnail":', $data);
		$count = (count($fuck) - 2);
		$shit = $fuck[$count];
		preg_match_all('/{"url":"(.*)","height":(.*),"width":(.*),"type":"(.*)"}/U', $shit, $arr_link);
		foreach ($arr_link[4] as $key => $value) {
			if(strpos($value, 'video/mpeg4') !== false)
				$html .= '<source data-res="'.quality_url($arr_link[2][$key]).'p" src="'.$arr_link[1][$key].'" type="video/mp4" />';
				//$file[] = (string)'{label: "'.quality_url($arr_link[2][$key]).'p", file: "'.$arr_link[1][$key].'", type:"mp4"}';
		}
		}
		//$html = (string)'sources: [' . @implode(",",$file) . ']';
		savecache($name,$html);
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
$url = file_get_contents('http://hayphim.tv.com/clipvn.php?url='.$link);
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
function megabox($a){
$source = file_get_contents($a);
if(preg_match('#obj_id = "(.+?)";#is',$source, $obj_id)){
preg_match('#iosUrl = "(.+?)";#is',$source, $iosUrl);
$all = get_megabox($obj_id[1],$iosUrl[1]);
if(preg_match('#"link":"(.+?)","sv_id"#is',$all,$link)){
$url = str_replace('\\','',$link[1]);
return $url;
}else{
		return SITE_URL.'/error.mp4';
}
}else{
		return SITE_URL.'/error.mp4';
}
}

function beeg($link){
$source = file_get_contents($link);
if(preg_match("#'file': '(.+?)',#is",$source,$data)){
return $data[1];
}else{
		return SITE_URL.'/error.mp4';
}
}
//pornhan.com
function pornhan($link){
$source = file_get_contents($link);
if(preg_match("#cnf='(.+?)';#is",$source,$data)){
$cf = file_get_contents($data[1]);
if(preg_match("#<filehd>(.+?)</filehd>#is",$cf,$hd)){
echo $hd[1];
}else{
	preg_match("#<file>(.+?)</file>#is",$cf,$sd);
	echo $sd[1];
}
}else{
		return SITE_URL.'/error.mp4';;
}
}

function config_site($config_name) {
	$html = get_jsonconfig($config_name,'siteconfig');
	return $html;
}
function one_data($item,$table,$con) {
	$arr = MySql::dbselect("$item","$table","$con");
	$data = $arr[0][0];
	return $data;
}
function filmdata($id,$item) {
	$arr = Film_Model::get("$id","$item");
	return $arr;
}
function get_url($id,$name,$type) {
	$url = Url::get($id,$name,$type);
	return $url;
}
function get_allpage($ttrow, $limit, $page, $url, $type = '') {
    $total = ceil($ttrow / $limit);
    if ($total <= 1)
        return '';
	$main .= '';
    if ($page <> 1) {
        $main .= "<li><a title='Sau' href='" . $url . ($page - 1) . "'>←</a></li>";
    }
    for ($num = 1; $num <= $total; $num++) {
        if ($num < $page - 1 || $num > $page + 4)
            continue;
        if ($num == $page)
            $main .= "<li class=\"active\"><a href=''>$num</a></li>";
        else {
            $main .= "<li><a href=\"$url$num\">$num</a></li>";
        }
    }
    if ($page <> $total) {
        $main .= "<li><a title='Tiếp' href='" . $url . ($page + 1) . "'>→</a></li>";
    }
	$main .= '';
    return $main;
}
function GetTag($data,$type='tag') {
	$data = explode(',',$data);
	for($i=0;$i<count($data);$i++) {
		$name = trim($data[$i]);
		$url = Url::get(0,$name,'tag');
		$output .= "<a href=\"$url\" title=\"".$name."‏\" rel=\"$type\">".$name."‏</a>";
	}
	return $output;
}
function GetTag_a($data,$limit) {
	$data = explode(',',$data);
	for($i=0;$i<$limit;$i++) {
		$name = trim($data[$i]);
		$url = Url::get(0,$name,'tag');
		$output .= "<a href=\"$url\" title=\"".$name."‏\" rel=\"tag\">".$name."‏</a>, ";
	}
	return $output;
}
function Get_List_director($list) {
	$data = explode(',',$list);
	for($i=0;$i<count($data);$i++) {
		$name = RemoveHack($data[$i]);
		if($name) {
			$arr = MySql::dbselect("info,urlmore,thumb","actor","name = '$name'");
			$image = $arr[0][2];
			$info  = $arr[0][0];
			if(!$arr) {
				/*$wiki = cURL::getWiki(trim($data[$i]));
				$image = $wiki[3];
				$urlmore = $wiki[2];
				$info = CutName($wiki[1],200);
				MySql::dbinsert('actor','name,info,urlmore,thumb',"'$name','$info','$urlmore','$image'");*/
				MySql::dbinsert('actor','name',"'$name'");
			}
			if(!$image) $image = TEMPLATE_URL.'img/profile.png';
			$url = Url::get(0,$name,'search');






			$html .= "
			<a class=\"director\" href=\"$url\" title=\"$name\"><span itemprop=\"name\">$name</span></a>
			
			";
		}
	}
	return $html;
}
function Get_List_actor($list) {
	$data = explode(',',$list);
	for($i=0;$i<count($data);$i++) {
		$name = RemoveHack($data[$i]);
		if($name) {
			$arr = MySql::dbselect("info,urlmore,thumb","actor","name = '$name'");
			$image = $arr[0][2];
			$info  = $arr[0][0];
			if(!$arr) {
			/*	$wiki = cURL::getWiki(trim($data[$i]));
				$image = $wiki[3];
				$urlmore = $wiki[2];
				$info = CutName($wiki[1],200);
				MySql::dbinsert('actor','name,info,urlmore,thumb',"'$name','$info','$urlmore','$image'");*/
				MySql::dbinsert('actor','name',"'$name'");
			}

			if(!$image) $image = TEMPLATE_URL.'img/profile.png';
			$url = Url::get(0,$name,'search');
			$html .= "
			<li>
                                                                <a class=\"actor-profile-item\" href=\"$url\" title=\"$name\">
                                    <div class=\"actor-image\" style=\"background-image:url('$image')\"></div>
                                    <div class=\"actor-name\">
                                        <span class=\"actor-name-a\" itemprop=\"name\">$name</span>
                                    </div>
                                    
                                </a>
                            </li>
			";
		}
	}
	return $html;
}
function Get_List_actor2($list) {
	$data = explode(',',$list);
	for($i=0;$i<count($data);$i++) {
		$name = RemoveHack($data[$i]);
		if($name) {
			$arr = MySql::dbselect("info,urlmore,thumb","actor","name = '$name'");
			$image = $arr[0][2];
			$info  = $arr[0][0];
			if(!$arr) {
			/*	$wiki = cURL::getWiki(trim($data[$i]));
				$image = $wiki[3];
				$urlmore = $wiki[2];
				$info = CutName($wiki[1],200);
				MySql::dbinsert('actor','name,info,urlmore,thumb',"'$name','$info','$urlmore','$image'");*/
				MySql::dbinsert('actor','name',"'$name'");
			}

			if(!$image) $image = TEMPLATE_URL.'img/profile.png';
			$url = Url::get(0,$name,'search');
			$html .= "
			<a href=\"$url\" title=\"$name\">$name</a>, 
			";
		}
	}
	return $html;
}
function get_livetv_thumb($sql,$num,$type) {
	$livetv = MySql::dbselect('id,symbol,name,thumb','tv',"$sql order by id desc limit $num");
	if($type == '1') {
		for($i=0;$i<count($livetv);$i++) {
			$id = $livetv[$i][0];
			$symbol = $livetv[$i][1];
			$name = $livetv[$i][2];
			$thumb = $livetv[$i][3];
			$url = get_url($id,$symbol,'Live TV');
			$html .= "<li><div class=\"pageSlide\"><a href=\"$url\" title=\"$name\"><img src=\"$thumb\" alt=\"$symbol\" title=\"\"><div class=\"maskMv\"></div></a></div></li>";
		}
	}else if($type == '2') {
		for($i=0;$i<count($livetv);$i++) {
			$id = $livetv[$i][0];
			$symbol = $livetv[$i][1];
			$name = $livetv[$i][2];
			$thumb = $livetv[$i][3];
			$url = get_url($id,$symbol,'Live TV');
			$html .= "<li><a href=\"$url\" title=\"$name\"><span class=\"over_play\"></span><img src=\"$thumb\" alt=\"$name\" class=\"thumbtivi\"/></a></li>";
		}
	}else {
		for($i=0;$i<count($livetv);$i++) {
			$id = $livetv[$i][0];
			$symbol = $livetv[$i][1];
			$url = get_url($id,$symbol,'Live TV');
			$html .= "<li><a href=\"$url\" title=\"$symbol\">$symbol</a></li>";
		}
	}
	return $html;
}
function li_category() {
	$arr = MySql::dbselect('id,name','category','id != 0');
	for($i=0;$i<count($arr);$i++) {
		$name = $arr[$i][1];
		$url = get_url(0,$name,'Thể loại');

		$html .= "<a href=\"$url\">$name</a>";
	}
	return $html;
}
function li_country() {
	$arr = MySql::dbselect('id,name','country','id != 0');
	for($i=0;$i<count($arr);$i++) {
		$name = $arr[$i][1];
		$url = get_url(0,$name,'Quốc gia');
		$html .= "<a href=\"$url\">$name</a>";
	}
	return $html;
}
function li_year($type) {
	for($i=0;$i<14;$i++) {
		$name = (2016-$i);
		$url = get_url(0,'Phim năm-'.(2016-$i),'Danh sách');
		$html .= "<li> <span class=\"icon\"></span> <a href=\"Phim $url\">Phim $name</a> </li>";
	}
	return $html;
}
function breadcrumb_menu($list, $num = 0) {
    $list = substr($list, 1);
    $list = substr($list, 0, -1);
    $category  = MySql::dbselect("name", "category", "id IN (" . $list . ")");
    for($i=0;$i<count($category);$i++) {
        $name = $category[$i][0];
		$url = get_url(0,$name,'Thể Loại');

        $html .= "<span rel=\"v:child\" typeof=\"v:Breadcrumb\"><a href=\"$url\" rel=\"v:url\" property=\"v:title\">$name</a></span> / ";
    }
    return $html;
}
function category_Watch($list, $num = 0) {
    $list = substr($list, 1);
    $list = substr($list, 0, -1);
    $category  = MySql::dbselect("name", "category", "id IN (" . $list . ")");
    for($i=0;$i<count($category);$i++) {
        $name = $category[$i][0];
        $html .= "Phim $name, ";
    }
	$html = substr($html,0,-2);
    return $html;
}
function category_a($list, $num = 0) {
    $list = substr($list, 1);
    $list = substr($list, 0, -1);
    $category  = MySql::dbselect("name", "category", "id IN (" . $list . ")");
    for($i=0;$i<count($category);$i++) {
        $name = $category[$i][0];
		$url = get_url(0,$name,'Thể Loại');

        $html .= "<a itemprop=\"genre\" href=\"$url\" title=\"Đài Loan\">$name</a>, ";
    }
    return $html;
}
function category_a_f($ido) {
    $category  = MySql::dbselect("name,id", "category", "id != '0'");
	if(!$ido) $classo = 'active';
	$html .= "<option value=\"\">Tất cả</option>";
    for($i=0;$i<count($category);$i++) {
		$id = $category[$i][1];
        $name = $category[$i][0];
		if($id == $ido) $class[$i] = ' class="active"';
        $html .= "<option value=\"$id\">$name</option>";
    }
    return $html;
}
function country_a_f($ido) {
    global $db;
    $country  = MySql::dbselect("name,id", "country", "id != '0'");
	if(!$ido) $classo = 'active';
	$html .= "<option value=\"\">Tất cả</option>";
    for($i=0;$i<count($country);$i++) {
		$id = $country[$i][1];
        $name = $country[$i][0];
		if($id == $ido) $class[$i] = ' class="active"';
        $html .= "<option value=\"$id\">$name</option>";
    }
    return $html;
}
function quality_a_f($qualityid) {
	if($qualityid == 'HD') $hd = 'active';
	else if($qualityid == 'SD') $sd = 'active';
	else if($qualityid == 'CAM') $cam = 'active';
	else $tatca = 'active';
    $html = "<option value=\"\">Tất cả</option>
	<option value=\"HD\">HD</option>
	<option value=\"SD\">SD</option>
	<option value=\"CAM\">CAM</option>";
    return $html;
}
function filmyear_a_f($year) {
	if(!$year) $tatca = 'active';
	$html .= "<option value=\"\">Tất cả</option>";
	for($i=0;$i<6;$i++) {
		$name = 'Năm '.(2014-$i);
		$yearid = (2014-$i);
		if((2014-$i) == $year) $class[$i] = 'active';
		$html .= "<option value=\"$yearid\"> $name</option>";
	}
    return $html;
}
function country_a($id) {
    $country = MySql::dbselect("name", "country", "id = '$id'");
    $name = $country[0][0];
	$url = get_url(0,$name,'Quốc Gia');
    $html = "<a href=\"$url\" title=\"$name\">$name</a>";
    return $html;
}
function cat_hotlist() {
	$arr = MySql::dbselect('id,title,thumb,tourl','hotmenu',"id != 0 order by id asc");
	for($i=0;$i<count($arr);$i++) {
		$name = $arr[$i][1];
		$url = $arr[$i][3];
		$thumb = $arr[$i][2];
		if($thumb !== '') $thumb = " style=\"background: url($thumb) no-repeat;\"";
		if(!$url) $url = "index.html";
		$html .= "<li><span class=\"back bxh\"$thumb></span><span class=\"cover\"></span><h3><a href=\"$url\" title=\"$name\">$name</a></h3></li>";
	}
	return $html;
}
function li_film($sql,$limit) {
	$arr = MySql::dbselect('id,title,thumb,year','film',"$sql ORDER BY id DESC LIMIT $limit");
	for($i=0;$i<count($arr);$i++) {
		$name = $arr[$i][1];
		$url = get_url($arr[$i][0],$name,'Phim');
		$thumb = $arr[$i][2];
		$year = $arr[$i][3];
		$html .= "<li><a href=\"$url\" title=\"$name\"><img src=\"$thumb\" class=\"headthumbimg\" alt=\"$name\"/><span>$name<br/>($year)</span></a></li>";
	}
	return $html;
}
function li_film_h3($sql,$limit) {
	$arr = MySql::dbselect('id,title,thumb,year,duration','film',"$sql ORDER BY id DESC LIMIT $limit");
	for($i=0;$i<count($arr);$i++) {
		$name = $arr[$i][1];
		$url = get_url($arr[$i][0],$name,'Phim');
		$thumb = $arr[$i][2];
		$year = $arr[$i][3];
		$duration = $arr[$i][4];
		 $html .= '<div class="film-grid-item">
    <div class="film-thumbnail">
        <a href="'.$url.'"> <img class="lazy" alt="'.$name.'" title="'.$name.'" src="'.$thumb.'" style="display: inline-block;">
            <div class="hover-play-btn"></div>
<span class="film-label">'.$duration.'</span>
        </a></div>
    <div class="film-info"> <a href="'.$url.'" class="title">'.$name.'</a></div>
</div>';
	}
	return $html;
}

function bxh_show1($type) {
    if($type == 'day') $orderby = 'viewed_day';
    else if($type == 'week') $orderby = 'viewed_week';
    else if($type == 'month') $orderby = 'viewed_month';
    else if($type == 'vote') $orderby = 'total_value';
    $arr = MySql::dbselect('id,title,thumb,year,duration,title_en,actor','film',"id != 0 ORDER BY $orderby DESC LIMIT 10");
    for($i=0;$i<count($arr);$i++) {
        $id = $arr[$i][0];
        $name = $arr[$i][1];
        $name_en = $arr[$i][5];
        $url = get_url($arr[$i][0],$name,'Phim');
        $thumb = $arr[$i][2];
        $thumb_bg = TEMPLATE_URL.'images/grey.jpg';
        $actor = CutName($arr[$i][6],70);
        $year = $arr[$i][3];
        $duration = $arr[$i][4];
        $num = $i+1;
        if($num == 1) $color[$i] = '#FF9934';
        else if($num == 2) $color[$i] = '#66CBFF';
        else if($num == 3) $color[$i] = '#67FF9A';
        else $color[$i] = '#9966FF';
        $html .= "<div class=\"bxh-ngay pull-left\">
    <div class=\"stt-bxh pull-left\">
        <svg width=\"100\" height=\"100\"><circle cx=\"50\" cy=\"50\" r=\"25\" fill=\"".$color[$i]."\"/><text fill=\"#ffffff\" font-size=\"20\" font-family=\"Verdana\" x=\"45\" y=\"56\">$num</text></svg>
    </div>
    <div class=\"movie-img pull-left\">
       <a href=\"$url\" title=\"Xem phim $name - $name_en\">  <img class=\"lazy\" src=\"$thumb\" alt=\"$name - $name_en\"/></a>
    </div>
    <div class=\"movie-title pull-left span8\">
        <a href=\"$url\" title=\"Xem phim $name - $name_en\"> <h2>$name - $name_en ($year)</h2></a>
        Diễn viên: </span><label>$actor</label>
    </div>
    <div class=\"pull-right span1\">
        <div class=\"bxh-control\">
            <a href=\"$url\" title=\"Xem phim $name - $name_en\"><i class=\"mui-ten\"></i></a>
        </div>
        <div class=\"bxh-control-cong\" data-id=\"$id\">
            <a href=\"#\" title=\"Thêm vào xem sau\"><i class=\"dau-cong\"></i></a>
        </div>
    </div>
</div>";
    }
    return $html;
}

function li_film_h3_2($sql,$limit) {
	$arr = MySql::dbselect('id,title,thumb,year,duration','film',"$sql AND duration != '' ORDER BY id DESC LIMIT $limit");
	for($i=0;$i<count($arr);$i++) {
		$name = $arr[$i][1];
		$url = get_url($arr[$i][0],$name,'Phim');
		$thumb = $arr[$i][2];
		$year = $arr[$i][3];
		$duration = $arr[$i][4];
		$html .= "<li><a href=\"$url\" title=\"$name\">".CutName($name,20)."</a><span>$duration</span></li>";
	}
	return $html;
}
function list_actor() {

	$arr = MySql::dbselect('info,name,urlmore,thumb','actor',"thumb != '' order by RAND() limit 2");
	for($i=0;$i<count($arr);$i++) {
		$name = $arr[$i][1];
		$thumb = $arr[$i][3];
		$url = get_url('',$name,'search');
		


		$html .= "<li class=\"profile-item\">
								<a class=\"profile-link\" title=\"Phim của $name\" href=\"$url\">
									<span class=\"profile-image\" style=\"background-image: url('$thumb')\"></span>
									<span class=\"star-profile-name\">$name </span>
								</a>
								<span class=\"star-profile-summary\"></span>
							</li>";
	}
	return $html;
}


function slider_film($sql,$limit) {


    $arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.quality,tb_film.duration,tb_film.actor,tb_film.category,tb_film.country,tb_film.viewed','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql ORDER BY id DESC LIMIT $limit");
	for($i=0;$i<count($arr);$i++) {
		$id = $arr[$i][0];
		$name = $arr[$i][1];
		$url = get_url($arr[$i][0],$name,'Phim');
		$thumb = $arr[$i][2];
		$thumb_big = $arr[$i][4];
		$year = $arr[$i][3];
		$content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),200);
		$name_en = $arr[$i][6];
		$quality = $arr[$i][7];
		$duration = $arr[$i][8];
        $actor = $arr[$i][9];
        $theloai = category_a($arr[$i][10]);
        $quocgia = country_a($arr[$i][11]);
        $viewed = $arr[$i][12];
    
    
	$html .= '<li style="width: 20%;">
            <div class="row">
                <div class="caption">
                    <h3><a href="'.$url.'">'.$name_en.'</a></h3>
                    <h4 class="title-translate">'.$name.'</h4>
                    <p class="description"> '.$content.' <a href="'.$url.'">xem thêm</a> </p>
                    <div class="info">
                        <div class="row"> <span>Quốc gia:</span> '.$quocgia.' </div>
                        <div class="row"> <span>Thể loại:</span> '.$theloai.'</div>
                        <div class="row"> <span>Diễn viên: </span>'.$actor.' </div>
                        <div class="row"> Thời lượng: '.$duration.' </div>
                    </div>
                    <div class="meta"> <span class="views pull-left">Lượt xem: '.$viewed.'</span> 
                                            <a class="view-film pull-right" href="'.$url.'"></a>
                    </div>
                </div>
                <a href="'.$url.'"><img src="http://hayphim.tv/timthumb.php?src='.$thumb_big.'&w=640" class="image" alt="'.$name.'" title="'.$name.'">
                </a>
            </div> <span class="hot-icon"></span> </li>';
	}

	return $html;
}
function category_tip($list, $num = 0) {
    $list = substr($list, 1);
    $list = substr($list, 0, -1);
    $category  = MySql::dbselect("name", "category", "id IN (" . $list . ") LIMIT 1");
    for($i=0;$i<count($category);$i++) {
        $name = $category[$i][0];		
        $html .= $name;
    }	
    return $html;
}
function li_film1($type,$limit,$list='') {
	if($type == 'decu') $sql = "decu = '1'";
	else if($type == 'phimbo') {
		$sql = "filmlb IN (1,2)";
		$orderby = 'ORDER BY timeupdate DESC';
	}
	else if($type == 'phimle') {
		$sql = "filmlb = '0'";
		$orderby = 'ORDER BY timeupdate DESC';
	}
	else if($type == 'rand') {
		$sql = "filmlb = '0'";
		$orderby = "ORDER BY RAND()";
	}
	else if($type == 'category') {
		$list = substr($list,1);
		$list = substr($list,0,-1);
		$ex = explode(",",$list);
		$count = count($ex);
		if($count == 1) $sql = "(category LIKE '%,$list,%' ) OR ";
		else {
			for($x=0;$x<$count;$x++) {
				$sql .= "(category LIKE '%,".$ex[$x].",%' ) OR ";
			}
		}
		$sql = substr($sql,0,-4);
		$orderby = "ORDER BY RAND()";
		$type = $type.$list;
	}
	if(!$orderby) $orderby = 'ORDER BY id DESC';
	$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.duration,tb_film.quality,tb_film.thuyetminh,tb_film.filmlb,tb_film.category,tb_film.trailer','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql $orderby LIMIT $limit");
	for($i=0;$i<count($arr);$i++) {
		$id = $arr[$i][0];
		$name = $arr[$i][1];
		$name_en = $arr[$i][6];
		$name_en_cut = CutName($arr[$i][6],20);
		$name_cut = CutName($name,30);
		$url = get_url($arr[$i][0],$name,'Phim');
		$thumb = $arr[$i][2];
		$thumb_big = $arr[$i][4];
		$duration = $arr[$i][7];
		$quality = $arr[$i][8];
		$thuyetminh = $arr[$i][9];
		$filmlb = $arr[$i][10];
		$year = $arr[$i][3];
		$cat = $arr[$i][11];
		$content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),250);
		if($filmlb!=0){
					$types = 'phimbo';
				}
		if($quality) $quality = "$quality";
		$episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
		$epname = $episode[0][1];
		if($thuyetminh == 1){
			$phude = 'Thuyết Minh';
		}else{
			$phude = 'Vietsub';
		}
		//if($epname && $type == 'phimbo') $epnames = " Tập $epname";
		if(empty($duration) || empty($name_en)){
			$duration = "cập nhật";
			$name_en = "cập nhật";
		}else{


		}
		if($epname && $types == 'phimbo') { $epnames = "<span class=\"film-format\">Tập $epname | $phude</span>"; }else{ $epnames = "<span class=\"film-format\">HD | $phude</span>"; }	
        $html .= '<div class="film-grid-item">
    <div class="film-thumbnail">
        <a href="'.$url.'"  class="jt bxitem-link" data-jtip="#'.$type.'-'.$id.'"> <img class="lazy" alt="'.$name.'" title="'.$name.'" src="http://hayphim.tv/timthumb.php?src='.$thumb.'&amp;w=150" style="display: inline-block;">
            <div class="hover-play-btn"></div>
        </a>
		<div id="'.$type.'-'.$id.'">
		<p class="name-vi">'.$name.' </p>
		<p class="name-en">'.$name_en.'</p>
		<p>Số Tập: '.$epname.' </p>
		<p>Năm sản xuất: '.$year.' </p>
		<div class="clearfix tip-info-bt">
		<span class="tn-pcolor1">'.category_tip($cat,0).'</span>
		<ul class="tip-info-bottom pull-right">
		<li><span title="Chất lượng" class="tagsInfo greenTag"><strong>'.$quality.'</strong></span></li>
		</ul>
		</div>
		<div class="tn-contentdecs mb10">
		'.$content.'
		</div>
		<div class="clearfix">';
		if($arr[$i][12]) {
		$ytubeid = VideoYoutubeID($arr[$i][12]); 
		$html .= '<a href="javascript:void(0)" onclick="viewYT(\''.$ytubeid .'\')" class="btn tn-btn-view pull-left">Trailer</a>';
		}
		$html .= '	
		<a href="'.$url.'" class="btn tn-btn-view2 btn-like-add pull-right later-for-10289">Xem ngay</a>
		</div> </div>		'.$epnames.' </div>
    <div class="film-info"> <a href="'.$url.'" class="title">'.$name.'</a> <span class="title2">'.$name_en.'</span> </div>
</div>';
	}
	return $html;
}

function rand2() {
	
		$sql = "id != '0'";
		$orderby = "ORDER BY RAND()";
	if(!$orderby) $orderby = 'ORDER BY id DESC';
	$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.duration,tb_film.quality,tb_film.thuyetminh,tb_film.filmlb','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql $orderby LIMIT 36");
	for($i=0;$i<count($arr);$i++) {
		$id = $arr[$i][0];
		$name = $arr[$i][1];
		$name_en = $arr[$i][6];
		$name_en_cut = CutName($arr[$i][6],20);
		$name_cut = CutName($name,30);
		$url = get_url($arr[$i][0],$name,'Phim');
		$thumb = $arr[$i][2];
		$thumb_big = $arr[$i][4];
		$duration = $arr[$i][7];
		$quality = $arr[$i][8];
		$thuyetminh = $arr[$i][9];
		$filmlb = $arr[$i][10];
		$year = $arr[$i][3];
		if($thuyetminh == 1){
			$phude = 'Thuyết Minh';
		}else{
			$phude = 'Vietsub';
		}
		$content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),180);
		$episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
		$epname = $episode[0][1];
		if($filmlb!=0){
					$type = 'phimbo';
				}
		if($epname && $type == 'phimbo') { $epnames = "<span class=\"film-format\">Tập $epname | $phude</span>"; }else{ $epnames = "<span class=\"film-format\">HD | $phude</span>"; }	
		if(empty($duration) || empty($name_en)){
			$duration = "cập nhật";
			$name_en = "cập nhật";
		}else{


		}


	

  $html .= '<div class="film-grid-item">
    <div class="film-thumbnail">
        <a href="'.$url.'"> <img class="lazy" alt="'.$name.'" title="'.$name.'" src="http://hayphim.tv/timthumb.php?src='.$thumb.'&w=150" style="display: inline-block;">
            <div class="hover-play-btn"></div>
        </a> '.$epnames.' </div>
    <div class="film-info"> <a href="'.$url.'" class="title">'.$name_en.'</a> <span class="title2">'.$name.'</span> </div>
</div>';
	}
	return $html;
}


function decu1() {
$sql = "decu = '1'";
	$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.duration,tb_film.quality,tb_film.viewed,tb_film.thuyetminh,tb_film.filmlb','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql order by id DESC LIMIT 12");
	for($i=0;$i<count($arr);$i++) {
		$id = $arr[$i][0];
		$name = $arr[$i][1];
		$name_en = $arr[$i][6];
        $view = $arr[$i][9];
		$url = get_url($arr[$i][0],$name,'Phim');
		$thumb = $arr[$i][2];
		$thumb_big = $arr[$i][4];
		$thuyetminh = $arr[$i][10];
		$filmlb = $arr[$i][11];
		if($filmlb!=0){
					$type = 'phimbo';
				}
		if($quality) $quality = "$quality";
		$episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
		$epname = $episode[0][1];
		if($thuyetminh == 1){
			$phude = 'Thuyết Minh';
		}else{
			$phude = 'Vietsub';
		}
        if($epname && $type == 'phimbo') { $epnames = "<span class=\"film-format\">Tập $epname | $phude</span>"; }else{ $epnames = "<span class=\"film-format\">HD | $phude</span>"; }	
        $html .= '<div class="film-grid-item">
    <div class="film-thumbnail">
        <a href="'.$url.'"> <img class="lazy" alt="'.$name.'" title="'.$name.'" src="http://hayphim.tv/timthumb.php?src='.$thumb.'&w=150" style="display: inline-block;">
            <div class="hover-play-btn"></div>
        </a> '.$epnames.' </div>
    <div class="film-info"> <a href="'.$url.'" class="title">'.$name_en.'</a> <span class="title2">'.$name.'</span> </div>
</div>';
	}
	return $html;
}

function filmlb1($id,$limit) {
	if($id == 0)$sql = "filmlb = '2'";
	else $sql = "filmlb = '1'";
		$orderby = "ORDER BY RAND()";
	$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.duration,tb_film.quality','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql $orderby LIMIT $limit");
	for($i=0;$i<count($arr);$i++) {
		$id = $arr[$i][0];
		$name = $arr[$i][1];
		$name_en = $arr[$i][6];
		$name_en_cut = CutName($arr[$i][6],20);
		$name_cut = CutName($name,13);
		$url = get_url($arr[$i][0],$name,'Phim');
		$thumb = $arr[$i][2];
		$thumb_big = $arr[$i][4];
		$duration = $arr[$i][7];
		$quality = $arr[$i][8];
		$year = $arr[$i][3];
		$content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),180);
		if($quality) $quality = "<i class=\"qt\">$quality</i>";
		$episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
		$epname = $episode[0][1];
		if($epname && $type == 'phimbo') $epnames = "<i class=\"ep\">Tập $epname</i>";




		$html .= "<li class=\"box-movie first-items\">
				<a class=\"movie-link\" href=\"$url\" title=\"$name\">
					<div class=\"thumbn\" style=\"background-image: url('$thumb');\"></div>
					<div class=\"meta\">
						<span class=\"name-vn link\">$name</span>
						<br />
						<span class=\"name-en\">$name_en_cut</span>
					</div>
				</a>
				<div class=\"eps\">$duration</div>
				<div class=\"clear\"></div>
			</li>";
	}
	return $html;
}

function tags_rand() {
	$orderby = "ORDER BY RAND()";
	$arr = MySql::dbselect('tb_film_other.filmid,tb_film_other.keywords','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"filmid $orderby LIMIT 17");
	for($i=0;$i<count($arr);$i++) {
		$id = $arr[$i][0];
		$name = $arr[$i][1];
		$name_cut = CutName($name,17);
		$url = get_url('',$name,'search');
		
		$html .= "<li class=\"tag-item\">
			<a class=\"tag-link\" title=\"$name\" href=\"$url\">$name</a>
			<span class=\"tag-end\">&nbsp;</span>
		</li>";
	}
	return $html;
}




function rand1() {
	$limit = "1";
		$sql = "filmlb = '0'";
		$orderby = "ORDER BY RAND()";
	$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.duration,tb_film.quality','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql $orderby LIMIT $limit");
	for($i=0;$i<count($arr);$i++) {
		$id = $arr[$i][0];
		$name = $arr[$i][1];
		$name_en = $arr[$i][6];
		$name_en_cut = CutName($arr[$i][6],20);
		$name_cut = CutName($name,13);
		$url = get_url($arr[$i][0],$name,'Phim');
		$thumb = $arr[$i][2];
		$bg_thumb = TEMPLATE_URL.'images/grey.jpg';
		$thumb_big = $arr[$i][4];
		$duration = $arr[$i][7];
		$quality = $arr[$i][8];
		$year = $arr[$i][3];
		$content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),180);
		if($quality) $quality = "<i class=\"qt\">$quality</i>";
		$episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
		$epname = $episode[0][1];
		if($epname && $type == 'phimbo') $epnames = "<i class=\"ep\">Tập $epname</i>";




		$html .= "  <div class=\"home-box-widget right-box top-film-week\">
						<div class=\"right-box-content\"><a href=\"$url\" title=\"$name - $name_en\">
						<span style=\"    position: absolute;  top: 45%;
    text-align: center;
    width: 100%;
    background: rgba(0,0,0,0.4);
    padding: 10px 0px 10px 0px;
    margin: 0px;
    list-style: none;
    font-size: 18px;
\">$name $epnames $quality</span>
				
			<img width=\"100%\" height=\"518\" src=\"$thumb\">
			
			</a>
			
		    </div>
	    </div>";
	}
	return $html;
}




function li_video() {
	$arr = MySql::dbselect('id,name,url,duration,thumb,viewed','media',"id != 0 order by id desc limit 9");
	for($i=0;$i<count($arr);$i++) {
		$name = $arr[$i][1];
		$url = get_url($arr[$i][0],$name,'xem-video');
		$thumb = $arr[$i][4];
		$duration = $arr[$i][3];
		$viewed = $arr[$i][5];
		if(!$thumb) $thumb = TEMPLATE_URL.'images/bgcatft.jpg';
		$name_cut = CutName($name,25);
		$html .= '<div class="slide" style="float: left; list-style: none; position: relative; width: 314.666666666667px; margin-right: 8px;">
    <a href="'.$url.'"> <img src="http://hayphim.tv/timthumb.php?src='.$thumb.'&amp;w=315" alt="'.$name.'" title="'.$name.'">
    </a>
    <div class="quick-info">
        <div class="row">
            <div class="col-lg-12"> <span class="big-title"><a href="'.$url.'">'.$name.'</a></span> </div>
        </div>
        <div class="row">
            <div class="col-lg-5"> <span class="small-title">'.$duration.'</span> </div>
            
        </div>
    </div>
</div>';
		
	}
	return $html;
}
function li_episode($sql,$limit) {
	$arr = MySql::dbselect('tb_episode.id,tb_episode.name,tb_episode.filmid,tb_film.title,tb_film.thumb,tb_film.thuyetminh','episode JOIN tb_film ON (tb_film.id = tb_episode.filmid)',"$sql ORDER BY tb_episode.id DESC LIMIT $limit");
	for($i=0;$i<count($arr);$i++) {
		$name = $arr[$i][1];
		$filmid = $arr[$i][2];
		$title = $arr[$i][3];
		$url = get_url($arr[$i][0],$title,'Xem Phim');
		$thumb = $arr[$i][4];
		$thuyetminh = $arr[$i][5];
		if($thuyetminh == 1){
			$phude = 'Thuyết Minh';
		}else{
			$phude = 'Vietsub';
		}
		if(!$thumb) $thumb = TEMPLATE_URL.'images/bgcatft.jpg';
		$title_cut = CutName($title,25);
		 $html .= '<div class="film-grid-item">
    <div class="film-thumbnail">
        <a href="'.$url.'"> <img class="lazy" alt="'.$name.' '.$title.'" title="'.$name.' '.$title.'" src="'.$thumb.'" style="display: inline-block;">
            <div class="hover-play-btn"></div>
        </a>
		<span class="film-format">'.$phude.'</span>
		</div>
    <div class="film-info"> <a href="'.$url.'" class="title">'.$title.'</a> <span class="title2">'.$name.'</span> </div>
</div>';
	}
	return $html;
}

function bxh_show($type) {
	if($type == 'day') $orderby = 'viewed_day';
	else if($type == 'week') $orderby = 'viewed_week';
	else if($type == 'month') $orderby = 'viewed_month';
	else if($type == 'vote') $orderby = 'total_value';
	$arr = MySql::dbselect('id,title,thumb,year,duration,title_en,actor,total_votes,total_value,viewed_day,viewed_week,viewed_month','film',"id != 0 ORDER BY $orderby DESC LIMIT 5");
	for($i=0;$i<count($arr);$i++) {
		$id = $arr[$i][0];
		$name = $arr[$i][1];
		$name_en = $arr[$i][5];
		$view_day = $arr[$i][9];
		$view_week = $arr[$i][10];
		$view_month = $arr[$i][11];
		$url = get_url($arr[$i][0],$name,'Phim');
		$thumb = $arr[$i][2];
		$actor = CutName($arr[$i][6],70);
		$year = $arr[$i][3];
		$duration = $arr[$i][4];
if($type == 'day') {$viewed = $view_day;}
	else if($type == 'week') {$viewed = $view_week;}
	else if($type == 'month') {$viewed = $view_month;}

		$html .= "<li class=\"movie\">
				<a class=\"movie-link\" title=\"$name\" href=\"$url\">
					<div class=\"thumbn\" style=\"background-image: url('$thumb');\"></div>
					<div class=\"meta\">
						<span class=\"name-vn link\">$name</span>
						<span class=\"name-en\">$name_en ($year)</span>
					</div>
				</a>
					<span class=\"list-top-movie-item-view\">Lượt xem: $viewed</span>
				<div class=\"clear\"></div>
			</li>";
	}
	return $html;
}

function type_video(&$url) {
    $t_url     = strtolower($url);
    $ext       = explode('.', $t_url);
    $ext       = $ext[count($ext) - 1];
    $ext       = explode('?', $ext);
    $ext       = $ext[0];
    $movie_arr = array('wmv','avi','asf','mpg','mpe','mpeg','asx','m1v','mp2','mpa','ifo','vob','smi');
    $extra_swf_arr = array('www.metacafe.com','www.livevideo.com');
    for ($i = 0; $i < count($extra_swf_arr); $i++) {
        if (preg_match("#^http://" . $extra_swf_arr[$i] . "/(.*?)#s", $url)) {
            $type = 2;
            break;
        }
    }
    $is_youtube       = (preg_match("#youtube.com/([^/]+)#", $url));
    $is_youtube1      = (preg_match("#http://www.youtube.com/watch%(.*?)#s", $url));
    $is_youtube2      = (preg_match("#http://www.youtube.com/watch/v/(.*?)#s", $url));
    $is_youtube3      = (preg_match("#http://www.youtube.com/v/(.*?)#s", $url));
    $is_gdata         = (preg_match("#http://gdata.youtube.com/feeds/api/playlists/(.*?)#s", $url));
    $is_daily         = (preg_match("#dailymotion.com#", $url));
    $is_vntube        = (preg_match("#http://www.vntube.com/mov/view_video.php\?viewkey=(.*?)#s", $url));
    $is_tamtay        = (preg_match("#http://video.tamtay.vn/play/([^/]+)(.*?)#s", $url, $idvideo_tamtay));
    $is_chacha        = (preg_match("#http://chacha.vn/song/(.*?)#s", $url));
    $is_clipvn        = (preg_match("#phim.clip.vn/watch/([^/]+)/([^,]+),#", $url));
    $is_clipvn1       = (preg_match("#clip.vn/watch/(.*?)#s", $url));
    $is_clipvn2       = (preg_match('#clip.vn/w/(.*?)#s', $url));
    $is_clipvn3       = (preg_match('#clip.vn/embed/(.*?)#s', $url));
    $is_googleVideo   = (preg_match("#http://video.google.com/videoplay\?docid=(.*?)#s", $url));
    $is_myspace       = (preg_match("#http://vids.myspace.com/index.cfm\?fuseaction=vids.individual&VideoID=(.*?)#s", $url));
    $is_timnhanh      = (preg_match("#http://video.yume.vn/(.*?)#s", $url));
    $is_veoh          = (preg_match("#http://www.veoh.com/videos/(.*?)#s", $url));
    $is_veoh1         = (preg_match("#http://www.veoh.com/browse/videos/category/([^/]+)/watch/(.*?)#s", $url));
    $is_baamboo       = (preg_match("#http://video.baamboo.com/watch/([0-9]+)/video/([^/]+)/(.*?)#", $url, $idvideo_baamboo));
    $is_livevideo     = (preg_match("#http://www.livevideo.com/video/([^/]+)/(.*?)#", $url, $idvideo_live));
    $is_sevenload     = (preg_match("#sevenload.com/videos/([^/-]+)-([^/]+)#", $url, $id_sevenload));
    $is_picasa        = (preg_match('#picasaweb.google.com/(.*?)#s', $url));
    $is_badongo       = (preg_match("#badongo.com/vid/(.*?)#s", $url));
    $id_sevenload     = (preg_match("#sevenload.com/videos/([^/-]+)-([^/]+)#", $url, $id_sevenload));
    $is_olala         = (preg_match("#http://timvui.vn/player/(.*?)#s", $url));
    $is_zing          = (preg_match("#video.zing.vn/([^/]+)#", $url));
    $is_zing1         = (preg_match("#video.zing.vn/video/clip/([^/]+)#", $url));
    $is_zing2         = (preg_match("#mp3.zing.vn/tv/media/([^/]+)#", $url));
    $is_zing3         = (preg_match("#tv.zing.vn/video/([^/]+)#", $url));
    $is_mediafire     = (preg_match("#http://www.mediafire.com/?(.*?)#s", $url));
    $is_cyworld       = (preg_match("#cyworld.vn/([^/]+)#", $url));
    $is_goonline      = (preg_match("#http://clips.goonline.vn/xem/(.*?)#s", $url));
    $is_movshare      = (preg_match("#http://www.movshare.net/video/(.*?)#s", $url));
    $is_novamov       = (preg_match("#http://www.novamov.com/video/(.*?)#s", $url));
    $is_zippyshare    = (preg_match("#http://www([0-9]+).zippyshare.com/v/(.*?)/file.html#s", $url));
    $is_sendspace     = (preg_match("#sendspace.com/([^/]+)#", $url));
    $is_vidxden       = (preg_match("#http://www.vidxden.com/(.*?)#s", $url));
    $is_megafun       = (preg_match("##megafun.vn/(.*?)#s", $url));
    $is_BB            = (preg_match("#http://www.videobb.com/video/(.*?)#s", $url));
    $is_Sshare        = (preg_match("#http://www.speedyshare.com/files/(.*?)#s", $url));
    $is_4share1       = (preg_match("#4shared.com/file/(.*?)#s", $url));
    $is_4share2       = (preg_match("#4shared.com/video/(.*?)#s", $url));
    $is_4share3       = (preg_match("#4shared.com/embed/(.*?)#s", $url));
    $is_2share1       = (preg_match("#2shared.com/file/(.*?)#s", $url));
    $is_2share2       = (preg_match("#2shared.com/video/(.*?)#s", $url));
    $is_2share3       = (preg_match("#2sharedid=(.*?)#s", $url));
    $is_Wootly        = (preg_match("#http://www.wootly.com/(.*?)#s", $url));
    $is_tusfiles      = (preg_match("#http://www.tusfiles.net/(.*?)#s", $url));
    $is_sharevnn      = (preg_match("#http://share.vnn.vn/dl.php/(.*?)#s", $url));
    $is_BBS           = (preg_match("#http://videobb.com/video/(.*?)#s", $url));
    $is_ovfile        = (preg_match("#http://ovfile.com/(.*?)#s", $url));
    $is_SSh           = (preg_match("#http://phim.soha.vn/watch/3/video/(.*?)#s", $url));
    $is_em4share      = (preg_match("#http://www.4shared.com/embed/(.*?)#s", $url));
    $is_viddler       = (preg_match("#http://www.viddler.com/player/(.*?)#s", $url));
    $is_SeeOn         = (preg_match("#http://video.seeon.tv/video/(.*?)#s", $url));
    $is_vidus         = (preg_match("#http://s([0-9]+).vidbux.com:([0-9]+)/d/(.*?)#s", $url));
    $is_Twitclips     = (preg_match("#http://www.twitvid.com/(.*?)#s", $url));
    $is_videozer      = (preg_match("#http://videozer.com/embed/(.*?)#s", $url));
    $is_eyvx          = (preg_match("#http://eyvx.com/(.*?)#s", $url));
    $is_banbe         = (preg_match("#banbe.net/(.*?)#s", $url));
    $is_nhaccuatui    = (preg_match("#nhaccuatui.com(.*?)#s", $url));
    $is_ggdocs        = (preg_match("#docs.google.com(.*?)#s", $url));
    $is_tvzing        = (preg_match("#tv.zing.vn/video/([^/]+)#", $url));
    $is_upfile        = (preg_match("#upfile.vn/([^/]+)#", $url));
    $is_plusgoogle    = (preg_match("#plus.google.com/([^/]+)#", $url));
    $is_vidbull       = (preg_match("#fptplay.net/([^/]+)#", $url));
    $is_telly         = (preg_match("#vivo.vn/([^/]+)#", $url));
    $is_movreel       = (preg_match("#hdonline.vn/([^/]+)#", $url));
    $is_videoweed     = (preg_match("#phim.megabox.vn/([^/]+)#", $url));
    $is_hulk          = (preg_match("#hu.lk/([^/]+)#", $url));
    $is_novamov       = (preg_match("#novamov.com/([^/]+)#", $url));
    $is_bitshare      = (preg_match("#bitshare.com/([^/]+)#", $url));
    $is_jumbofiles    = (preg_match("#jumbofiles.com/([^/]+)#", $url));
    $is_glumbouploads = (preg_match("#glumbouploads.com/([^/]+)#", $url));
	$is_phimsomotvn = (preg_match("#phimsomot.vn/([^/]+)#", $url));
	$is_fshare 		  = (preg_match("#fshare.vn/([^/]+)#", $url));
    if ($ext == 'flv' || $ext == 'mp4') $type = 1;
    elseif ($ext == 'swf' || $is_googleVideo || $is_baamboo) $type = 2;
    elseif ($is_zing || $is_zing1 || $is_zing2 || $is_zing3) $type = 3;
    elseif ($is_youtube || $is_youtube1 || $is_youtube2 || $is_youtube3) $type = 4;
    elseif ($is_picasa) $type = 5;
    elseif ($is_movshare) $type = 6;
    elseif ($is_tamtay || $is_tamtay1 || $idvideo_tamtay || $idvideo_tamtay2) $type = 7;
    elseif ($is_4share1 || $is_4share2 || $is_4share3) $type = 8;
    elseif ($ext == 'divx' || $is_sendspace || $is_olala || $is_megavideo || $is_mediafire || $is_goonline || $is_sevenload || $is_vidxden || $is_novamov || $is_BB || $is_Sshare || $is_Wootly || $is_tusfiles || $is_sharevnn || $is_BBS || $is_ovfile || $is_SSh || $is_em4share || $is_viddler || $is_vivo || $is_SeeOn || $is_vidus || $is_Twitclips || $is_videozer || $is_eyvx || $is_myspace || $is_timnhanh || $is_chacha) $type = 9;
    elseif ($is_2share1 || $is_2share2 || $is_2share3) $type = 10;
    elseif ($is_clipvn || $is_clipvn1 || $is_clipvn2 || $is_clipvn3) $type = 11;
    elseif ($is_banbe) $type = 12;
    elseif ($is_veoh || $is_veoh1) $type = 13;
    elseif ($is_megafun) $type = 14;
    elseif ($is_nhaccuatui) $type = 15;
    elseif ($is_daily)  $type = 16;
    elseif ($is_zippyshare) $type = 17;
    elseif ($is_gdata) $type = 18;
    elseif ($is_cyworld) $type = 19;
    elseif ($is_badongo) $type = 20;
    elseif ($is_ggdocs) $type = 21;
    elseif ($is_tvzing) $type = 22;
    elseif ($is_upfile) $type = 23;
    elseif ($is_plusgoogle) $type = 24;
    elseif ($is_vidbull) $type = 25;
    elseif ($is_telly) $type = 26;
    elseif ($is_movreel) $type = 27;
    elseif ($is_videoweed) $type = 28;
    elseif ($is_hulk) $type = 29;
    elseif ($is_novamov) $type = 30;
    elseif ($is_bitshare) $type = 31;
    elseif ($is_jumbofiles) $type = 32;
    elseif ($is_glumbouploads) $type = 33;
	elseif ($is_phimsomotvn) $type = 34;
	elseif ($is_fshare) $type = 37;
    elseif (!$type) $type = 35;
    return $type;
}
function list_episode($filmid,$filmname,$epid2) {
    $episode = MySql::dbselect('tb_episode.id,tb_episode.name,tb_episode.filmid,tb_episode.url,tb_episode.subtitle,tb_film.filmlb','episode JOIN tb_film ON (tb_episode.filmid = tb_film.id)',"filmid = '$filmid' ORDER BY id ASC");
    for($i=0;$i<count($episode);$i++) {
        $epid       =   $episode[$i][0];
        $epname     =   $episode[$i][1];
        $playLink   =   get_url($epid,$filmname,'Xem Phim');
        $episode_type = type_video($episode[$i][3]);
        if ($episode[$i][1]==0) {$lebo="";$epname1=$epname;} else {$lebo=" itemprop=\"episode\" itemscope itemtype=\"http://schema.org/TVEpisode\"";$epname1="<span itemprop=\"name\">".$epname."</span>
     <meta itemprop=\"episodeNumber\" content=\"".$epname."\"/>";}
		if(strpos($episode[$i][3],'fshare.vn') != false){
			$sv[$episode_type] .= '<a target="_blank" title="Xem phim '.$filmname.' tập '.$epname.'" class="part btn btn-default " href="'.$episode[$i][3].'">'.$epname1.'</a>';
		}elseif($epid2 == $epid){
			$sv[$episode_type] .= '<a title="Xem phim '.$filmname.' tập '.$epname.'" class="part btn btn-default btn-primary" href="'.$playLink.'">'.$epname1.'</a>';
		}else{
			$sv[$episode_type] .= '<a title="Xem phim '.$filmname.' tập '.$epname.'" class="part btn btn-default " href="'.$playLink.'">'.$epname1.'</a>';
		}    
	}
    if($sv[35]) $total_server .= "<h4 ".$lebo.">Đang Update:</h4><br />".$sv[35]."<br />";
    if($sv[1]) $total_server .= "<h4 ".$lebo.">V.I.P:</h4><br />".$sv[1]."<br />";
    if($sv[2]) $total_server .= "<h4 ".$lebo.">Flash:</h4><br />".$sv[2]."<br />";
    if($sv[3]) $total_server .= "<h4 ".$lebo.">VN:</h4><br />".$sv[3]."<br />";
    if($sv[4]) $total_server .= "<h4 ".$lebo.">YouTube:</h4><br />".$sv[4]."<br />";
    if($sv[5]) $total_server .= "<h4 ".$lebo.">SV.I.P:</h4><br />".$sv[5]."<br />";
    if($sv[26]) $total_server .= "<h4 ".$lebo.">VV.I.P:</h4><br />".$sv[26]."<br />";
    if($sv[28]) $total_server .= "<h4 ".$lebo.">MV.I.P:</h4><br />".$sv[28]."<br />";
    if($sv[25]) $total_server .= "<h4 ".$lebo.">FV.I.P:</h4><br />".$sv[25]."<br />";
    if($sv[27]) $total_server .= "<h4 ".$lebo.">HV.I.P:</h4><br />".$sv[27]."<br />";
    if($sv[6]) $total_server .= "<h4 ".$lebo.">Movshare:</h4><br />".$sv[6]."<br />";
    if($sv[7]) $total_server .= "<h4 ".$lebo.">Tam Tay:</h4><br />".$sv[7]."<br />";
    if($sv[8]) $total_server .= "<h4 ".$lebo.">4Share:</h4><br />".$sv[8]."<br />";
    if($sv[9]) $total_server .= "<h4 ".$lebo.">Unknow:</h4><br />".$sv[9]."<br />";
    if($sv[10]) $total_server .= "<h4 ".$lebo.">2Share:</h4><br />".$sv[10]."<br />";
    if($sv[11]) $total_server .= "<h4 ".$lebo.">Clip.Vn:</h4><br />".$sv[11]."<br />";
    if($sv[12]) $total_server .= "<h4 ".$lebo.">Ban Be:</h4><br />".$sv[12]."<br />";
    if($sv[13]) $total_server .= "<h4 ".$lebo.">Veoh:</h4><br />".$sv[13]."<br />";
    if($sv[14]) $total_server .= "<h4 ".$lebo.">MegaFun:</h4><br />".$sv[14]."<br />";
    if($sv[15]) $total_server .= "<h4 ".$lebo.">NhacCuaTui:</h4><br />".$sv[15]."<br />";
    if($sv[16]) $total_server .= "<h4 ".$lebo.">Dailymotion:</h4><br />".$sv[16]."<br />";
    if($sv[17]) $total_server .= "<h4 ".$lebo.">Zippy Share:</h4><br />".$sv[17]."<br />";
    if($sv[18]) $total_server .= "<h4 ".$lebo.">YouTube:</h4><br />".$sv[18]."<br />";
    if($sv[19]) $total_server .= "<h4 ".$lebo.">Cyworld:</h4><br />".$sv[19]."<br />";
    if($sv[20]) $total_server .= "<h4 ".$lebo.">Gdata:</h4><br />".$sv[20]."<br />";
    if($sv[21]) $total_server .= "<h4 ".$lebo.">Google Docs:</h4><br />".$sv[21]."<br />";
    if($sv[24]) $total_server .= "<h4 ".$lebo.">Picasa 2:</h4><br />".$sv[24]."<br />";
    
    if($sv[29]) $total_server .= "<h4 ".$lebo.">Hu.lk:</h4><br />".$sv[29]."<br />";
    if($sv[30]) $total_server .= "<h4 ".$lebo.">Novamov:</h4><br />".$sv[30]."<br />";
    if($sv[31]) $total_server .= "<h4 ".$lebo.">Bitshare:</h4><br />".$sv[31]."<br />";
    if($sv[32]) $total_server .= "<h4 ".$lebo.">Jumbofiles:</h4><br />".$sv[32]."<br />";
    if($sv[33]) $total_server .= "<h4 ".$lebo.">Glumbouploads:</h4><br />".$sv[33]."<br />";
	if($sv[37]) $total_server .= "<h4 ".$lebo.">Fshare.vn:</h4><br />".$sv[37]."<br />";
    return $total_server;
}


function id_episode($filmid) {
    $episode = MySql::dbselect('tb_episode.id','episode JOIN tb_film ON (tb_episode.filmid = tb_film.id)',"filmid = '$filmid' ORDER BY id ASC LIMIT 1");
    for($i=0;$i<count($episode);$i++) {
        $epid       =   $episode[$i][0];
        
return $epid;
}
        }




function list_episode_slider($filmid,$filmname,$id) {
	$episode = MySql::dbselect('id,name,filmid,url,subtitle,thumb','episode',"filmid = '$filmid' ORDER BY id ASC LIMIT 1");
	if(count($episode) > 1) {
		$total_server .= '<div class="watch-list"><div class="stream-line"><div class="scroll_list"><ul class="stream-items">';
		for($i=0;$i<count($episode);$i++) {
			$epid		=	$episode[$i][0];
			$epname		=	$episode[$i][1];
			$thumb		=	TEMPLATE_URL.'images/bgepisode.jpg';
			$playLink	=	get_url($epid,$filmname,'Xem Phim');
			$episode_type = type_video($episode[$i][3]);
			if($id == $epid) $class[$i] = ' class="current"';
			$sv[$episode_type] .= "
			<li".$class[$i]." id=\"ep_$epid\">
				<a id=\"$epid\" href=\"$playLink\" title=\"Xem phim $filmname tập $epname\">
					<span class=\"video\"></span><span class=\"name\">Tập $epname</span>
					<img rel=\"nofollow\" title=\"Tập $epname\" id=\"img_$epname\" src=\"$thumb\"/>
				</a>
			</li>";
		}
		$epurl = one_data('url','episode',"id = '$id'");
		$eptype = type_video($epurl);
		if($sv[$eptype]) $total_server .= $sv[$eptype];
		$total_server .= '</ul></div><div class="wrap_prev_block"><a href="javascript:void(0)" class="stream-prev prev_block"></a></div><div class="wrap_next_block"><a href="javascript:void(0)" class="stream-next next_block"></a></div></div></div>';
	}
	return $total_server;
}
function get_video($sql,$limit,$type='') {
	$arr = MySql::dbselect('id,name,url,duration,thumb,viewed','media',"$sql order by id desc limit $limit");
	if($type == 'rand') {
		for($i=0;$i<count($arr);$i++) {
			$name = $arr[$i][1];
			$thumb = $arr[$i][4];
			$mediaid = $arr[$i][0];
			$duration = $arr[$i][3];
			$viewed = $arr[$i][5];
			$url = get_url($mediaid,$name,'Xem Video');
            $html .= '<div class="film-grid-item">
    <div class="film-thumbnail">
        <a href="'.$url.'"> <img class="lazy" alt="'.$name.'" title="'.$name.'" src="'.$thumb.'" style="display: inline-block;">
            <div class="hover-play-btn"></div>
            </a>
</div>
    <div class="film-info"> <a href="'.$url.'" class="title">'.$name.'</a></div>
</div>';
		}
	}else {
		for($i=0;$i<count($arr);$i++) {
			$name = $arr[$i][1];
			$thumb = $arr[$i][4];
			$mediaid = $arr[$i][0];
			$duration = $arr[$i][3];
			$viewed = $arr[$i][5];
			$url = get_url($mediaid,$name,'Xem Video');
			$html .= "
			<li style=\"float:left;height:400px\">
			<div class=\"hvideo clearfix\">
				<div class=\"video\">
					<img src=\"$thumb\" title=\"$name\" alt=\"$name\"/><a href=\"$url\"><span class=\"vdicon\"></span></a>
				</div>
				<div class=\"info\">
					<h1>$name</h1>
					<span class=\"content\"><strong>Thời lượng</strong>: $duration</span>
					<span class=\"content\"><strong>Lượt xem</strong>: $viewed</span>
				</div>
			</div>
			</li>
			";
		}
	}
	return $html;
}
function server_nxt($url){
	$sr_type=type_video($url);
	if($sr_type==1){
		$type=0;
	}else if($sr_type==2){
		$type='video.google.com';
	}else if($sr_type==3){
		$type='zing.vn';
	}else if($sr_type==4){
		$type='youtube.com';
	}else if($sr_type==5){
		$type='picasaweb.google.com';
	}else if($sr_type==6){
		$type='movshare.net';
	}else if($sr_type==7){
		$type='tamtay.vn';
	}else if($sr_type==8){
		$type='4shared.com';
	}else if($sr_type==9){
		$type='';
	}else if($sr_type==10){
		$type='2shared.com';
	}else if($sr_type==11){
		$type='clip.vn';
	}else if($sr_type==12){
		$type='banbe.net';
	}else if($sr_type==13){
		$type='veoh.com';
	}else if($sr_type==14){
		$type='megafun.vn';
	}else if($sr_type==15){
		$type='nhaccuatui.com';
	}else if($sr_type==16){
		$type='dailymotion.com';
	}else if($sr_type==17){
		$type='zippyshare.com';
	}else if($sr_type==18){
		$type='gdata.youtube.com';
	}else if($sr_type==19){
		$type='cyworld.vn';
	}else if($sr_type==20){
		$type='badongo.com';
	}else if($sr_type==21){
		$type='docs.google.com';
	}else if($sr_type==22){
		$type='tv.zing.vn';
	}else if($sr_type==23){
		$type='upfile.vn';
	}else if($sr_type==24){
		$type='plus.google.com';
	}else if($sr_type==25){
		$type='fptplay.net';
	}else if($sr_type==26){
		$type='vivo.vn';
	}else if($sr_type==27){
		$type='hdonline.vn';
	}else if($sr_type==28){
		$type='phim.megabox.vn';
	}else if($sr_type==29){
		$type='hu.lk';
	}else if($sr_type==30){
		$type='novamov.com';
	}else if($sr_type==31){
		$type='bitshare.com';
	}else if($sr_type==32){
		$type='jumbofiles.com';
	}else if($sr_type==33){
		$type='glumbouploads.com';
	}else if($sr_type==34){
		$type='phimsomot.vn';
	}else{
		$type=0;
	}
	return $type;
	
}
function youtubecc($string) {
$string = str_replace("https://www.youtube.com/watch?v=","https://www.youtube.com/embed/",$string);
$string = str_replace("http://www.youtube.com/watch?v=","http://www.youtube.com/embed/",$string);
return $string;
}
function player($epid,$type='') {
	if($type != 'video') {
		$episode = MySql::dbselect('id,name,filmid,url,subtitle,thumb,datetime_post,default_subtitle_id','episode',"id = '$epid'");
		$url1 = $episode[0][3];
		$subtitles_db = MySql::dbselect('subtitle_lang,subtitle_url,id','subtitle',"episode_id = $epid");
		$subtitle = $subtitles_db[0][1];
		$nextid = one_data('id','episode',"id > '$epid' AND filmid = '$filmid' AND url LIKE '%".$link_nxt_type."%'");
	} else {
		$url1 = $epid;
	}
	$type_video = type_video($url1);
	if(in_array($type_video, array('5'))) {
echo '<link rel="stylesheet" href="'.SITE_URL.'/content/template/videojs-fix/src/videojs.logobrand.css"><link href="'.SITE_URL.'/content/template/videojs-fix/video-js47.css" rel="stylesheet" /><script src="http://hayphimhd.com/content/template/videojs-fix/video.js"></script><script src="'.SITE_URL.'/content/template/videojs-fix/video-quality-selector.js"></script> <script src="'.SITE_URL.'/content/template/videojs-fix/src/videojs.logobrand.js"></script>
<script src="'.SITE_URL.'/content/template/videojs-fix/video.js-dailymotion-master/src/dailymotion.js"></script>

    <div class="jwplayer playlist-none" id="the-player" style="width: 100%; height: 540px; opacity: 1; background-color: rgb(0, 0, 0);">
       <video id="myplayer" class="video-js vjs-default-skin" controls autoplay="autoplay" width="100%" height="100%" poster="<?php echo $big_thumb;?>" data-setup="">';
		echo vshd_get_picasa($url1);
        
        if($subtitle) $subtitle = '<track src="'.$subtitle.'" kind="subtitles" srclang="vi" label="vietnamese" default>';
		$jwplayer = (string)'' . @implode(",",$file) . '';

		$player .= ''.$jwplayer.''.$subtitle;
$player .= '        <track src="http://hayphim.tv/players/subwcome.srt" kind="subtitles" srclang="vi" label="Giới Thiệu" default></video>
    </div>
    <script type="text/javascript">videojs("#myplayer",{    plugins : { resolutionSelector : {  default_res : "360px"   }   }   }) ClickToLoad(); </script>
    <script type="text/javascript">videojs(\'#myplayer\',{    plugins : { resolutionSelector : {  default_res : \'360px\'   }   }   });
video = document.querySelector(\'video\'),player = videojs(video);player.logobrand({image: "http://hayphim.tv/assets/img/logo.png",destination: "http://hayphim.tv/"});   videojs("#myplayer").ready(function() { var vid = this; vid.on("ended", function() {    var nextid = $("input[name=\'nexturlep\']").val();    if(nextid) {    next_url = $(\'.episodelist a#episode_\'+nextid).attr(\'href\');    window.location.href = next_url;    }   }); });</script>';
/*echo '
<script type="text/javascript" src="'.SITE_URL.'/jw/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key="vmAEdu5OJSCiJfE3aWibJZ6338lN/A7tybduu0fdEfxYgi7AkWpjckRUFeI=";</script>
<div id="mediaplayer"></div><script type="text/javascript">jwplayer("mediaplayer").setup({
		'.vshd_get_picasa($url1).',
		logo: {
		file: "http://hayphim.tv/content/mobile/images/logo.png",
		link: "http://hayphim.tv",
		position: "top-left",
		opacity: ""
		},
        autostart: "true",
		height: "540",
        width: "100%",
        title: "HayPhim.TV",
        abouttext:"HayPhim.TV",
        aboutlink:"http://hayphim.tv",';
		if($subtitle) echo "tracks: [{file: '".$subtitle."', label: \"Tiếng Việt\"}],captions: { color: \"#FFFFFF\",backgroundOpacity: 100},";
		echo '});</script>';*/
	}
	elseif(in_array($type_video, array('16'))) {
$player .= '<link rel="stylesheet" href="'.SITE_URL.'/content/template/videojs-fix/src/videojs.logobrand.css"><link href="'.SITE_URL.'/content/template/videojs-fix/video-js47.css" rel="stylesheet" /><script src="http://hayphimhd.com/content/template/videojs-fix/video.js"></script><script src="'.SITE_URL.'/content/template/videojs-fix/video-quality-selector.js"></script> <script src="'.SITE_URL.'/content/template/videojs-fix/src/videojs.logobrand.js"></script>
<script src="'.SITE_URL.'/content/template/videojs-fix/video.js-dailymotion-master/src/dailymotion.js"></script>

    <div class="jwplayer playlist-none" id="the-player" style="width: 100%; height: 540px; opacity: 1; background-color: rgb(0, 0, 0);">
       <video id="vid1" class="video-js vjs-default-skin" controls preload="auto" width="100%" height="540" data-setup=\'{ "techOrder": ["dailymotion"], "src": "'.$url1.'" }\'></video>
	   </div>
	  </div>';
	}
	elseif(in_array($type_video, array('25'))) {
$player .= '<iframe frameborder="0" width="100%" height="540px" src="http://hayphim.tv/player.php?url='.fptlink($url1).'" allowfullscreen></iframe>';
	}
	elseif(in_array($type_video, array('26'))) {
$player .= '<iframe frameborder="0" width="100%" height="540px" src="http://hayphim.tv/player.php?url='.$url1.'" allowfullscreen></iframe>';
	}
	elseif(in_array($type_video, array('27'))) {
$player .= '<iframe frameborder="0" width="100%" height="540px" src="http://hayphim.tv/player.php?url='.$url1.'" allowfullscreen></iframe>';
	}
        elseif(in_array($type_video, array('28'))) {
$player .= '<iframe frameborder="0" width="100%" height="550px" src="http://hayphim.tv/player.php?url='.$url1.'" allowfullscreen></iframe>';
	}
	elseif(in_array($type_video, array('4'))) {
$player .= '<iframe frameborder="0" width="100%" height="550px" src="http://hayphim.tv/getyoutube.php?url='.$url1.'" allowfullscreen></iframe>';
	}
	else {
		$info = parse_url($url1);
$info['host'] = str_replace('www.', '', $info['host']);
if($info['host'] == 'youporn.com'){
    $link = youporn($url1, 'large.file');
}
elseif($info['host'] == 'pornhub.com'){
    $link = pornhub($url1, 'large.file');
}
elseif($info['host'] == 'porn.com'){
    $link = porn($url1, 'large.file');
}
elseif($info['host'] == 'xvideos.com'){
    $link = xvideos($url1, 'large.file');
}
elseif($info['host'] == 'redtube.com'){
    $link = redtube(get($url1));
}
elseif($info['host'] == 'spankwire.com'){
    $link = spankwire(get($url1));
}
elseif($info['host'] == 'phim.clip.vn'){
    $link = clipvn($url1);
}
elseif($info['host'] == 'beeg.com'){
    $link = beeg($url1);
}
elseif($info['host'] == 'pornhan.com'){
    $link = pornhan($url1);
}
elseif($info['host'] == 'tv.zing.vn'){
    $link = zingtv($url1);
}
else{
	
	$link = $url1;
}
if($subtitle) $subtitle = '<track src="'.$subtitle.'" kind="subtitles" srclang="vi" label="vietnamese" default>';
$player .= '<link rel="stylesheet" href="'.SITE_URL.'/content/template/videojs-fix/src/videojs.logobrand.css"><link href="'.SITE_URL.'/content/template/videojs-fix/video-js47.css" rel="stylesheet" /><script src="http://hayphimhd.com/content/template/videojs-fix/video.js"></script><script src="'.SITE_URL.'/content/template/videojs-fix/video-quality-selector.js"></script> <script src="'.SITE_URL.'/content/template/videojs-fix/src/videojs.logobrand.js"></script>
<script src="'.SITE_URL.'/content/template/videojs-fix/video.js-dailymotion-master/src/dailymotion.js"></script>

    <div class="jwplayer playlist-none" id="the-player" style="width: 100%; height: 540px; opacity: 1; background-color: rgb(0, 0, 0);">
       <video id="myplayer" class="video-js vjs-default-skin" controls autoplay="autoplay" width="100%" height="100%" poster="<?php echo $big_thumb;?>" data-setup="">';
$player .= '' . $link . ''.$subtitle;
$player .= '        <track src="http://hayphim.tv/players/subwcome.srt" kind="subtitles" srclang="vi" label="Giới Thiệu" default></video>
    </div>
    <script type="text/javascript">videojs("#myplayer",{    plugins : { resolutionSelector : {  default_res : "360px"   }   }   }) ClickToLoad(); </script>
    <script type="text/javascript">videojs(\'#myplayer\',{    plugins : { resolutionSelector : {  default_res : \'360px\'   }   }   });
video = document.querySelector(\'video\'),player = videojs(video);player.logobrand({image: "http://hayphim.tv/content/template/images/logo.png",destination: "http://hayphim.tv/"});   videojs("#myplayer").ready(function() { var vid = this; vid.on("ended", function() {    var nextid = $("input[name=\'nexturlep\']").val();    if(nextid) {    next_url = $(\'.episodelist a#episode_\'+nextid).attr(\'href\');    window.location.href = next_url;    }   }); });</script>';
			}
	echo $player;
}
function category_ad($list, $num = 0) {
    $list = substr($list, 1);
    $list = substr($list, 0, -1);
    $category  = MySql::dbselect("en_category", "category", "id IN (" . $list . ")");
    for($i=0;$i<count($category);$i++) {
        $name = $category[$i][0];
        if($i == count($category)-1) {$html .= "$name";} else {$html .= "$name,";}
    }
    return $html;
}
function country_ad($id) {
    $country = MySql::dbselect("en_country", "country", "id = '$id'");
    $html = $country[0][0];
    return $html;
}

?>								
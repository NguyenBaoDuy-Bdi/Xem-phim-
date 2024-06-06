<?php
/**
 * PHP code library developed by Hoang Anh
 *
 * @package     Getlink Player All In One - Ver 4.7
 * @author      Hoang Anh
 * @link        http://www.s2phim.net
 * @copyright   Copyright (c) 2015, Hoang Anh
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @project     Shared
 **/
error_reporting(0);
 @header("Access-Control-Allow-Origin: *");
//START FUNCTION
function is_mobile()
{	
    if(isset($_SERVER['HTTP_X_WAP_PROFILE']))
        return true;
   if(preg_match('/wap.|.wap/i',$_SERVER['HTTP_ACCEPT']))
        return true;
        
    if(isset($_SERVER['HTTP_USER_AGENT']))
    {
        $user_agents = array(
            'midp', 'j2me', 'avantg', 'docomo', 'novarra', 'palmos', 
            'palmsource', '240x320', 'opwv', 'chtml', 'pda', 
            'mmp\/', 'blackberry', 'mib\/', 'symbian', 'wireless', 'nokia', 
            'cdm', 'up.b', 'audio', 'SIE-', 'SEC-', 
            'samsung', 'mot-', 'mitsu', 'sagem', 'sony', 'alcatel', 
            'lg', 'erics', 'vx', 'NEC', 'philips', 'mmm', 'xx', 'panasonic', 
            'sharp', 'wap', 'sch', 'rover', 'pocket', 'benq', 'java', 'pt', 
            'pg', 'vox', 'amoi', 'bird', 'compal', 'kg', 'voda', 'sany', 
            'kdd', 'dbt', 'sendo', 'sgh', 'gradi', 'jb', 'dddi', 'moto', 'ipad', 'iphone', 'Opera Mobi', 'android'
        );
        $user_agents = implode('|', $user_agents);
        if (preg_match("/$user_agents/i", $_SERVER['HTTP_USER_AGENT']))
            return true;
    }
    
    return false;
}
function get_clipvn($link){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://clip.vn/ajax/login');
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Requested-With: XMLHttpRequest'));
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('username' => 'pichusan', 'password' => 'phungngocnhi', 'persistent' => 1));

    curl_setopt($ch, CURLOPT_URL, 'http://clip.vn/movies/nfo/'.$link);
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('onsite' => 'clip'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    $data = curl_exec($ch);
    curl_close($ch);
	return $data;
}
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
function picasa_direct($url) {        
	if (stristr($url, '#')) list($url, $id) = explode('#', $url);    
	$data = file_get_contents($url);    
	if($id) $gach = explode($id, $data);    
	$gach = explode('{"url":"', ($id)?$gach[7]:$data);    
	$v360p = urldecode(reset(explode('"', $gach[2])));    
	$v720p = urldecode(reset(explode('"', $gach[3])));    
	$v1080p = urldecode(reset(explode('"', $gach[4])));    
	if($v1080p != '' and (strpos($v1080p, '=m')  !== false)){        
		$js .= '360p|'.$v360p.';';        
		$js .= '720p|'.$v720p.';';        
		$js .= '1080p|'.$v1080p.'';    
	}
	elseif($v720p != '' and (strpos($v720p, '=m')  !== false)){        
		$js .= '360|'.$v360p.';';        
		$js .= '720|'.$v720p.'';     
	}
	else {        
		$js .= '360|'.$v360p.'';        
	}    
	return $js;
}
function get_curl($url, $header=1){
	$url = str_replace(' ', '%23', $url);
	$useheader = (isset($_POST['iheader']) ? $_POST['iheader'] : $header);
	$useragent = (isset($_POST['iagent'])? (string)$_POST['iagent'] : 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:13.0) Gecko/20100101 Firefox/13.0');
	$referer = $_POST['ireferer'];
	$autoreferer = $_POST['iautoreferer'];
	$usehttpheader = (isset($_POST['ihttpheader']) ? $_POST['ihttpheader'] : true);
	$ucookie = $_POST['icookie'];
	$encoding = (isset($_POST['iencoding']) ? $_POST['iencoding'] : 'gzip,deflate');
	$timeout = $_POST['itimeout'];
	$follow = $_POST['ifollow'];
	$mpost = $_POST['ipost'];
	$mpostfield = $_POST['ipostfield'];
	$proxytunnel = $_POST['iproxytunnel'];
	$proxytype = $_POST['iproxytype'];
	$proxyport = $_POST['iproxyport'];
	$proxyip = $_POST['iproxyip'];
	$sslverify = (isset($_POST['isslverify']) ? $_POST['isslverify'] : true);
	$nobody = $_POST['inobody'];
	$curl = @curl_init();
	$header[0] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
	$header[] = "Accept-Language: en-us,en;q=0.5";
	$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$header[] = "Keep-Alive: 115";
	$header[] = "Connection: keep-alive";
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_HEADER, $useheader);
	if($useragent!=""){curl_setopt($curl, CURLOPT_USERAGENT, $useragent);}
	if($usehttpheader=="true"){curl_setopt($curl, CURLOPT_HTTPHEADER, $header);}
	if($ucookie!=""){curl_setopt($curl, CURLOPT_COOKIE, str_replace('\\"','"',$ucookie));}
	if($referer!=""){curl_setopt($curl, CURLOPT_REFERER, $referer);}
	if($autoreferer=="true"){curl_setopt($curl, CURLOPT_AUTOREFERER, 1);}
	if($encoding!=""){curl_setopt($curl, CURLOPT_ENCODING, $encoding);}
	if($timeout!=""){
		curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
	}
	else{
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	}
	if($follow=="true"){curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);}
	if($mpost=="true"){curl_setopt($curl, CURLOPT_POST, 1);}
	if($mpostfield!=""){curl_setopt($curl, CURLOPT_POSTFIELDS, $mpostfield);}
	if($proxytunnel=="true"){curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL, 1);}
	if($proxytype=="http"){curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);}
	if($proxyip=="socks5"){curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);}
	if($proxyport!=""){curl_setopt($curl, CURLOPT_PROXYPORT, $proxyport);}
	if($proxyip!=""){curl_setopt($curl, CURLOPT_PROXY, $proxyip);}
	if($nobody=="true"){curl_setopt($curl, CURLOPT_NOBODY, 1);}
	if($sslverify=="true"){
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); 
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
	}
	$result = curl_exec($curl);
	curl_close($curl);
	return $result;
}
function rebuild_url($url) {
	return $url['scheme'] . '://' . (!empty($url['user']) && !empty($url['pass']) ? rawurlencode($url['user']) . ':' . rawurlencode($url['pass']) . '@' : '') . $url['host'] . (!empty($url['port']) && $url['port'] != 80 && $url['port'] != 443 ? ':' . $url['port'] : '') . (empty($url['path']) ? '/' : $url['path']) . (!empty($url['query']) ? '?' . $url['query'] : '') . (!empty($url['fragment']) ? '#' . $url['fragment'] : '');
}

function GetVideosArr($fmtmaps, $fmts) {
	$fmturls = array();
	foreach ($fmtmaps as $fmtlist) {
		$fmtlist = array_map('urldecode', FormToArr($fmtlist));
		if (!in_array($fmtlist['itag'], $fmts)) continue;
		$fmtlist['url'] = parse_url($fmtlist['url']);
		$fmtlist['url']['query'] = array_map('urldecode', FormToArr($fmtlist['url']['query']));
		if (empty($fmtlist['url']['query']['signature'])) $fmtlist['url']['query']['signature'] = (!empty($fmtlist['s']) ? '' : $fmtlist['sig']);
		foreach (array_diff(array_keys($fmtlist), array('signature', 'sig', 's', 'url')) as $k) $fmtlist['url']['query'][$k] = $fmtlist[$k];
		ksort($fmtlist['url']['query']);
		$fmtlist['url']['query'] = http_build_query($fmtlist['url']['query']);
		$fmturls[$fmtlist['itag']] = rebuild_url($fmtlist['url']);
	}
	return $fmturls;
}

function FormToArr($content, $v1 = '&', $v2 = '=') {
	$rply = array();
	if (strpos($content, $v1) === false || strpos($content, $v2) === false) return $rply;
	foreach (array_filter(array_map('trim', explode($v1, $content))) as $v) {
		$v = array_map('trim', explode($v2, $v, 2));
		if ($v[0] != '') $rply[$v[0]] = $v[1];
	}
	return $rply;
}
function viewSource($url){  
	$timeout = 15;  
	$ch = curl_init();  
	curl_setopt($ch, CURLOPT_URL,$url);  
	curl_setopt($ch, CURLOPT_HTTPGET,true);  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);  
	curl_setopt($ch, CURLOPT_FAILONERROR, true);  
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);  
	curl_setopt($ch, CURLOPT_ENCODING , 'gzip, deflate');  
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
	curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);  
	$result = curl_exec($ch);  
	if(curl_errno($ch)){  
		return false;  
	}else{  
		return $result;  
	}  
} 
function curl($url) {
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
function curl_post($url,$v,$h=false,$r=false) {
	$ch = @curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	$head[] = "X-Requested-With:XMLHttpRequest";
	$head[] = "Keep-Alive: 300";
	$head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$head[] = "Accept-Language: en-us,en;q=0.5";
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
	curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
    curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    if($h) curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
	//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
    if($r) curl_setopt($ch, CURLOPT_REFERER, $r);
    
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $v);
    
	$page = curl_exec($ch);
	curl_close($ch);
	return $page;
}
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
class zing {
    public $_text = '';
    public $_key = 'f_pk_ZingTV_1_@z';
    public $_iv = 'f_iv_ZingTV_1_@z';
    public $_result = '';
    public function _decrypt(){
        if($this->_text != ''){
            $cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
            $iv_size = mcrypt_enc_get_iv_size($cipher);
            if(mcrypt_generic_init($cipher, $this->_key, $this->_iv) != -1){
                $cipherText = mdecrypt_generic($cipher,$this->_hexToString($this->_text));
                mcrypt_generic_deinit($cipher);
                $this->_result = $cipherText;
                return true;
            }else{
                return false;
            }
        }
    }
    protected function _hexToString($hex){
        if(!is_string($hex)){
            return null;
        }
        $char = '';
        for($i=0; $i<strlen($hex);$i+=2){
            $char .= chr(hexdec($hex{$i}.$hex{($i+1)}));
        }
        return $char;
    }
}
function get_xvideos($id){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://upload.xvideos.com/account');
	$head[] = "Connection: keep-alive";
	$head[] = "Keep-Alive: 300";
	$head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$head[] = "Accept-Language: en-us,en;q=0.5";
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
	curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie_xvideos.txt');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('login' => 'zone18xxx@gmail.com', 'password' => 'tuananh1529', 'log' => 'Login to your account'));
    $data = curl_exec($ch);
    curl_close($ch);
	$data = get_down($id);
	return $data;
}

function get_down($id) {
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://www.xvideos.com/video_download/'.$id);
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie_xvideos.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $data = curl_exec($ch);
    curl_close($ch);
	return $data;
}
function testcache($url,$expire){
	$dir = 'cache';
	$file = 'cache/'.$url.'.txt';
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

function decode($param1)
    {
        global $key;
        $_loc2_ = 0;
        $_loc3_ = 0;
        $_loc4_ = "";
        $_loc5_ = str_split("1234567890qwertyuiopasdfghjklzxcvbnm");
        $_loc6_ = count($_loc5_);
        $_loc7_ = str_split(MD5("hdpro123xvactuanvu"));
        $_loc8_ = str_split(substr($param1, $_loc6_ * 2 + 32));
        $_loc9_ = str_split(substr($param1, 0, $_loc6_ * 2));

        $_loc10_ = array();
        $_loc11_ = substr($param1, $_loc6_ * 2, 32);
        $_loc2_ = 0;

        while ($_loc2_ < $_loc6_ * 2)
        {

            $_loc3_ = ($_loc3_ = ($_loc3_ = array_search($_loc9_[$_loc2_], $_loc5_) * $_loc6_) +
                array_search($_loc9_[$_loc2_ + 1], $_loc5_)) - ord($_loc7_[floor($_loc2_ / 2) % count($_loc7_)]);
            $_loc10_[] = (chr($_loc3_));
            $_loc2_ = $_loc2_ + 2;
        }
        $_loc2_ = 0;
        while ($_loc2_ < count($_loc8_))
        {
            $_loc3_ = ($_loc3_ = ($_loc3_ = array_search($_loc8_[$_loc2_], $_loc5_) * $_loc6_) +
                array_search($_loc8_[$_loc2_ + 1], $_loc5_)) - ord($_loc10_[floor($_loc2_ / 2) % $_loc6_]);
            $_loc4_ = $_loc4_ . chr($_loc3_);
            $_loc2_ = $_loc2_ + 2;
        }
        if ($_loc11_ != MD5($_loc4_))
        {
            return $_loc4_;
        }
        return $_loc4_;
    }

if(isset($_GET['m'])&&$_GET['m']!=''){
     
    $y = curl($_GET['m']);
     
    if(preg_match_all("/https?\:\/\/.+\.m3u8/",$y,$mm,PREG_SET_ORDER)){
        
        foreach($mm as $mmm)
        $y = str_replace($mmm[0],'player.php?m='.urlencode($mmm[0]),$y);
    }else{
        //get domain
        preg_match("/(https?:\/\/[^\/]+)\//",$_GET['m'],$hh); 
        //get domain 2
        preg_match("/(https?:\/\/.+)\/[^\/]+$/",$_GET['m'],$hh2); 
        
        $y = preg_replace_callback("/[\r\n]([^\#h].+([\r\n]|$))/",
            create_function('$m',
                'return "\n".(strpos($m[1],"m3u8")!==false?"player.php?m=":"").($m[1][0]=="/"?"'.$hh[1].'/".$m[1]:"'.$hh2[1].'/".$m[1]);'),$y);
    }
    
    echo $y;
    die();
}



//END FUNCTION
//***********************************************************************************************************************************//
$url = urldecode($_GET['url']); //Get url from request
$expire_time    = 1296000; // enter value sec
clearcache(intval($expire_time)); //Delete cache in cache director 
//***********************************************************************************************************************************//
// START CLIPVN
if(strpos($url , 'clip.vn') !== false)
{
	$name = md5($url);
	$expire = 600; //enter value sec
	$testcache = testcache($name,$expire);
	if($testcache!='')
	{
		$dataplay = $testcache;
	}
	else
	{
		$getid = explode("/",$url);
		$id= $getid[4];
		$get = get_clipvn($id);
		$data = explode("<enclosure url='",$get);
		$data = explode("' duration=",$data[1]);
		$link = '360p|'.$data[0].'';
		$dataplay = $link;
		savecache($name,$dataplay);
	}
}
//END CLIPVN
//START DOCS, DRIVE (WITH IPv6)
elseif(strpos($url , 'docs.google.com') !== false or strpos($url , 'drive.google.com') !== false)
{
	$name = md5($url);
	$expire = 900; //enter value sec
	$testcache = testcache($name,$expire);
	if($testcache!='')
	{
		$dataplay = $testcache;
	}
	else
	{
		$get_id = preg_replace("@(.*).google.com/file/d/(.*)/(.*)@","$2",$url);
		$url = 'https://drive.google.com/file/d/'.$get_id.'/preview';
		$data = get_curl($url);
		$response = explode('url_encoded_fmt_stream_map', $data);
		$response = explode('"]', $response[1]);
		$fmts = explode('https%3A%2F%2F',$response[0]);
		for($i=1;$i < count($fmts); $i++)
		{
			$is_mp4 = (preg_match("#video%2Fmp4#s", $fmts[$i]));
			if($is_mp4)
			{
				if((preg_match("#1080#s", $fmts[$i])))
				$link .= "1080p|https%3A%2F%2F".$fmts[$i].";";
				elseif((preg_match("#720#s", $fmts[$i])))
				$link .= "720p|https%3A%2F%2F".$fmts[$i].";";
				elseif((preg_match("#large#s", $fmts[$i])))
				$link .= "480p|https%3A%2F%2F".$fmts[$i].";";
				elseif((preg_match("#medium#s", $fmts[$i])))
				$link .= "360p|https%3A%2F%2F".$fmts[$i]."";
			}
		}
		$dataplay = $link;
		savecache($name,$dataplay);
	}
}
//END DOCS, DRIVE (WITH IPv6)
//START NCT
elseif(strpos($url , 'nhaccuatui') !== false)
{
	$name = md5($url);
	$expire = 900; //enter value sec
	$testcache = testcache($name,$expire);
	if($testcache!='')
	{
		$dataplay = $testcache;
	}
	else
	{
		$get = curl($url);
		$cut = explode("file=",$get);
		$cut = explode('"',$cut[1]);
		$xml = curl($cut[0]);
		$link = explode(".mp4",$xml);
		$link = explode("http://",$link[0]);
		$get_link = '360p|http://'.$link[1].'.mp4';
		$dataplay = $get_link;
		savecache($name,$dataplay);
	}
}
//END NCT
//START YOUTUBE
elseif(strpos($url , 'youtu') !== false)
{
	$name = md5($url);
	$expire = 600; //enter value sec
	$testcache = testcache($name,$expire);
	if($testcache!='')
	{
		$dataplay = $testcache;
	}
	else
	{
		$idyoutube = explode("=",$url);
		$idyoutube = explode("embed/",$idyoutube[1]);
		$url = "https://www.youtube.com/watch?v=".$youtube_id[1]."";
		$data = youtube($url);
		$res[0] = "720";
		$res[1] = "480";
		$res[2] = "360";
		$res[3] = "240";
		$res[4] = "144";
		for($i=0;$i<=4;$i++) {
			$is_mp4 = (preg_match("#video/mp4(.*?)#s",$data[$i][2]));
			if($is_mp4){
				$dataget .= "".$res[$i]."<source src='".$data[$i][2]."' type='video/mp4' data-res='".$res[$i]."px' />";
			}
		}
		$dataplay = $dataget;
		savecache($name,$dataplay);
	}
}
//END YOUTUBE
//START ZING
elseif(strpos($url , 'zing.vn') !== false)
{
	$name = md5($url);
	$expire = 900; //enter value sec
	$testcache = testcache($name,$expire);
	if($testcache!='')
	{
		$dataplay = $testcache;
	}
	else
	{
		$zing = curlGet($url);
		preg_match_all('/xmlURL: "([^>]*)",/U', $zing, $link_zing);
		$xml = str_replace( 'media', 'media-embed', $link_zing[1][0]);
		$sourceXML = curlGet('compress.zlib://'.$xml);
		$f360 = explode('<source streamingType="1"><![CDATA[',$sourceXML);$f360=explode(']]></source>',$f360[1]);$getf360=new zing; $getf360->_text=''.$f360[0].''; if($getf360->_decrypt()!=false);
		if($getf360->_result != '')
		{
			$f480 = explode('<f480 streamingType="1"><![CDATA[',$sourceXML);$f480=explode(']]></f480>',$f480[1]);$getf480=new zing; $getf480->_text=''.$f480[0].''; if($getf480->_decrypt()!=false);
			$f720 = explode('<f720 streamingType="1"><![CDATA[',$sourceXML);$f720=explode(']]></f720>',$f720[1]);$getf720=new zing; $getf720->_text=''.$f720[0].''; if($getf720->_decrypt()!=false);
			$link360 = explode("?format=f360&device=web_embed_flash",$getf360->_result);
			$link360 = $link360[0];
			$link480 = explode("?format=f480&device=web_embed_flash",$getf480->_result);
			$link480 = $link480[0];
			$link720 = explode("?format=f720&device=web_embed_flash",$getf720->_result);
			$link720 = $link720[0];
			$getzing = '360p|'.$link360.';480p|'.$link480.';720p|'.$link720.'';
		} 
		else
		{
			$f360 = explode('<source streamingType="2"><![CDATA[',$sourceXML);$f360=explode(']]></source>',$f360[1]);$getf360=new zing; $getf360->_text=''.$f360[0].''; if($getf360->_decrypt()!=false);
			if($getf360->_result != ''){
				$f480 = explode('<f480 streamingType="2"><![CDATA[',$sourceXML);$f480=explode(']]></f480>',$f480[1]);$getf480=new zing; $getf480->_text=''.$f480[0].''; if($getf480->_decrypt()!=false);
				$f720 = explode('<f720 streamingType="2"><![CDATA[',$sourceXML);$f720=explode(']]></f720>',$f720[1]);$getf720=new zing; $getf720->_text=''.$f720[0].''; if($getf720->_decrypt()!=false);
				$link360 = explode("?format=f360&device=web_embed_flash",$getf360->_result);
				$link360 = $link360[0];
				$link480 = explode("?format=f480&device=web_embed_flash",$getf480->_result);
				$link480 = $link480[0];
				$link720 = explode("?format=f720&device=web_embed_flash",$getf720->_result);
				$link720 = $link720[0];
				$getzing = '360p|'.$link360.';480p|'.$link480.';720p|'.$link720.'';
			} 
			else 
			{
				preg_match('#<source src="(.+?)" type="video/mp4" />#',$zing,$zing_html5);
				$get = get_headers($zing_html5[1]);
				$cat = explode('Location: ', $get[6]);
				$f360p = explode('?', $cat[1]);
				$getzing = '360p|'.$f360.'';
			}

		}
		$testlink = explode('.mp4;',$getzing);
		$testlink = explode('360p|',$testlink[0]);
		if($testlink[1]=="Array")
		{
			$id = explode(".html",$url);
			$id = explode("/",$id[0]);
			$link = 'http://tv.zing.vn/embed/video/'.$id[5]; 
			$data = viewSource($link);
			$a= explode('<'.'source src="',$data,2);
			$b= explode('</video>',$a[1]);
			$b= explode('<source src="',$b[0]);
			$c1= explode('" type="video/mp4"',$b[0]);
			$c2= explode('" type="video/mp4"',$b[1]);
			$c3= explode('" type="video/mp4"',$b[2]);
			if($c1[0]!=''){
				$getzingmain .= '720p|'.$c1[0].';';
			}
			if($c2[0]!=''){
				$getzingmain .= '480p|'.$c2[0].';';
			}
			if($c3[0]!=''){
				$getzingmain .= '360p|'.$c3[0].';';
			}
		}
		else $getzingmain = $getzing;
		$dataplay = $getzingmain;
		savecache($name,$dataplay);
	}
}
//END ZING
//START PICASA
elseif(strpos($url , 'picasaweb') !== false)
{
	$name = md5($url);
	$expire = 1800; //enter value sec
	$testcache = testcache($name,$expire);
	if($testcache!='')
	{
		$dataplay = $testcache;
	}
	else
	{
		if(stristr($url, '%23')) list($url, $id) = explode('%23', $url);
		$data = get_curl($url);
		if($id){
			$test1=explode('"gphoto$id":"'.$id,$data);
			$test1=explode('"gphoto$id',$test1[1]);
			$data = $test1[0];
		}
		$patten = '/\{"url":"https?:\/\/redirector.googlevideo.com\/videoplayback([^\}]+)/';
		preg_match_all($patten,$data,$match);
		if (count($match[0]) > 0)
		{
			foreach($match[0] as $item)
			{
				$itemJS =json_decode($item.'}', true);             
				if ($itemJS['height']>300 && $itemJS['height'] < 400 && !isset($itemmedium)) $itemmedium = $itemJS['url'];
				if ($itemJS['height']>400 && $itemJS['height'] < 700 && !isset($itemmedium)) $itemlarge = $itemJS['url'];
				if ($itemJS['height']>=700 && $itemJS['height'] < 1000 && !isset($itemhd)) $itemhd = $itemJS['url'];
				if ($itemJS['height']>=1000 && !isset($itemfullhd)) $itemfullhd = $itemJS['url'];				
			}
			if (!isset($itemmedium))
			{
				$itemJS =json_decode($match[0][count($match[0])-1].'}', true);  
				$itemmedium = $itemJS['url'];
			}
		}  
		else {
			$link = picasa_direct($url);
		};
		if($itemfullhd) $link .= '360p|'.$itemmedium.'&format=getlink/s2phim.mp4;720p|'.$itemhd.'&format=getlink/s2phim.mp4;1080p|'.$itemfullhd.'&format=getlink/s2phim.mp4'; 
		elseif($itemhd) $link .= '360p|'.$itemmedium.'&format=getlink/s2phim.mp4;720p|'.$itemhd.'&format=getlink/s2phim.mp4';
		elseif($itemlarge) $link .= '360p|'.$itemmedium.'&format=getlink/s2phim.mp4;480p|'.$itemmedium.'&format=getlink/s2phim.mp4'; 
		elseif($itemmedium) $link .= '360p|'.$itemmedium.'&format=getlink/s2phim.mp4'; 
		$dataplay = $link;
		savecache($name,$dataplay);
	}
}
//END PICASA
//START FPT
elseif(strpos($url, 'fptplay.net') !==false)
{
	$name = md5($url);
	$expire = 0; //enter value sec
	$testcache = testcache($name,$expire);
	if($testcache!='')
	{
		$dataplay = $testcache;
	}
	else
	{
		if(strpos($url,'fptplay.net/xem-video'))
		{
			$url = preg_replace("@(.*)fptplay.net/xem-video/(.*)-(.*?).html#tap-(.*?)@","http://video.fptplay.net/embed/ngoisao/$3/$4",$url);
		}
		elseif(strpos($url,'fptplay.net/video')){
			$url = preg_replace("@(.*)fptplay.net/video/(.*?)/(.*?)/(.*?)@","http://video.fptplay.net/embed/ngoisao/$2/$4",$url);
		}
		$source = curl($url);
		$data=""; $data2="";
		preg_match('/http:\/\/(.*)" +/U', $source, $data); preg_match('/"?&token=(.*)";/U', $source, $data2);
		$link = "
		<script src='http://vtvplay.vn/media/jwplayer.js'></script>
		<script type='text/javascript'>
		jwplayer.key = 'Rx0330I73ZzagzsaqqxQGmCyUzhr6bBasFRdInRt8H4=';
		</script>
		<div id='my-video'></div>
		<script type='text/javascript'>
		function creat_player(sub, type) {
        if (type == '') {
            type = '';
        }
        jwplayer('my-video').setup({
            file: 'http://".$data[1]."?&token=".$data2[1]."',
            tracks: [{
                file: type,
                label: 'Tiếng Việt',
                default: true
            }],
            captions: {
                back: false,
                color: 'ffffff',
                fontsize: 18
            },
			title: 'SERVER V.I.P',
                        flashplayer: 'http://vtvplay.vn/media/jwplayer.swf',
			skin: 'http://waptai2k.com/player/tblue.xml',
            autostart: true,
            width: '100%',
            primary: 'flash',
            height: '100%'
        });
        jwplayer('my-video').onComplete(function() {
            nextmovie();
        });
		};
		creat_player('4', '');
		</script>";
		//if getlink not work, try with 'http://'.preg_replace("@vod.cdn.fptplay.net/ovod/_definst_/mp4:mp4/(.*?)/playlist.m3u8@","vcache1.mvod.cdn.fptplay.net/mp4/$1",$data[1]).'';
		$dataplay = $link;
		savecache($name,$dataplay);
	}
}
//END FPT
//START MEGABOX
elseif(strpos($url, 'megabox.vn') !==false)
{
	$name = md5($url);
	$expire = 86400;
	$testcache = testcache($name,$expire);
    $id = preg_replace("/^.+\-(\d+)\.html$/","\\1",$url);
	if($testcache!='')
	{
		echo $testcache;
	}
	else
	{
		$source = curl($url);
		$sv = rand(1,4);
		$data = "";
		preg_match('/<meta itemprop="contentUrl" content="(.*)"\/\>/U', $source, $data);
		$urlplay = ''.preg_replace("@(.*)media(.*?).megabox.vn/(.*?)@","http://sv$sv.hayphimhd.com/$3",$data[1]).'';
		$link = "<div id='player'></div> <script src='http://hayphimhd.com/player/jwplayer.js'></script> <script type='text/javascript'> jwplayer.key = 'N8zhkmYvvRwOhz4aTGkySoEri4x+9pQwR7GHIQ=='; </script> <script>jwplayer('player').setup({controlbar: 'bottom',width: '100%', height: '100%',autostart: 'true',logo: {file: '/content/template/logopl.png',link: '/'},skin: 'http://hayphimhd.com/players/kleur/kleur.xml',title: '',images: '',file:'".$urlplay."',});</script>";
		$dataplay = $link;
		savecache($name,$dataplay);
	}
}
//END MEGABOX
//START VIVO
elseif(strpos($url, 'vivo.vn') !==false)
{	
	if (is_mobile())
	{
		$opts = array('http' =>
		array(
			'header'  => 'User-agent: Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/3B48b Safari/419.3',
			)
		);

		$context  = stream_context_create($opts);
		$source = file_get_contents($url, false, $context);
		$poster="";
		$data="";
		preg_match('/poster_src_mv="(.*)"/U', $source, $poster);
		preg_match('/video_src_mv= "(.*)"/U', $source, $data);
		$dataplay = '<link rel="stylesheet" type="text/css" media="all" href="http://files.vivo.vn/skin/mobile/videojs_vast/video-js.css" />
<link href="http://files.vivo.vn/skin/mobile/videojs_vast/video.ads.css" rel="stylesheet" type="text/css">
<link href="http://files.vivo.vn/skin/mobile/videojs_vast/videojs.vast.css" rel="stylesheet" type="text/css">
<script src="http://files.vivo.vn/skin/mobile/videojs_vast/video.js"></script>
<script src="http://files.vivo.vn/skin/mobile/videojs_vast/video.ads.js"></script>  
<script src="http://files.vivo.vn/skin/mobile/videojs_vast/vast-client.js"></script>  
<script src="http://files.vivo.vn/skin/mobile/videojs_vast/videojs.vast.js"></script>
<script>
  		videojs.options.flash.swf = "http://files.vivo.vn/skin/mobile/video-js/video-js.swf"
</script>
<script type="text/javascript">
mobile_player_event = {
    onComplete: function(event) {
    	var elapsedTime = jwplayer("abd_mv").getPosition();
        var timedurationvalue = ((elapsedTime / 60).toFixed(2));
        updateValues();        
    },
    onReady: function(event) { 
        var elapsedTime = jwplayer("abd_mv").getPosition();
        var timedurationvalue = ((elapsedTime / 60).toFixed(2));
        updateValues();    
      
    },
    onPlay: function(event) {
        var elapsedTime = jwplayer("abd_mv").getPosition();
        var timedurationvalue = ((elapsedTime / 60).toFixed(2));
        
         
    },
    onVolume: function(event) {
        updateValues();      
    },
    onPause: function(event) {
    	var elapsedTime = jwplayer("abd_mv").getPosition();
        var timedurationvalue = ((elapsedTime / 60).toFixed(2));        
    }
};
function setText(id, messageText) {
    document.getElementById(id).innerHTML = messageText;
}
 function updateValues() {
     var state = jwplayer("abd_mv").getState();
     var elapsed = jwplayer("abd_mv").getPosition();
     setText("stateText", state);
     setText("elapsedText", (elapsed / 60).toFixed(2));
}
</script>
	<div id="abd_mv" style="width:100%; height: auto;"><img  width="100%" src="'.$poster[1].'"> </div>
         		<script type="text/javascript">
					var abd_width_mv = "100%";
					var abd_height_mv ="300";
					var abd_skiptime_mv = 7;
					var poster_src_mv="'.$poster[1].'";
					var video_src_mv= "'.$data[1].'";
					var VNMProt = (document.location.protocol == \'https:\') ? \'https://ambient.cachefly.net/\' : \'http://media.m.ambientplatform.vn/\';
					var VNMMedia_js = VNMProt + \'video-mobile/js/\';
					var head  = document.getElementsByTagName(\'head\')[0];
					var sNew = document.createElement("script");
					sNew.async = false;
					sNew.src = VNMMedia_js + \'jwp6.js\';
					head.appendChild(sNew);
					sNew.onload = function() {
						if (document.getElementById(\'abd_mv\') ){
							jwplayer("abd_mv").setup({ file:atob(video_src_mv), type:"mp4", autostart: true,image:poster_src_mv,width:abd_width_mv, height:abd_height_mv, aspectratio:"16:9", stretching:"fill", primary:"html", events: mobile_player_event });
						}
					}
					sNew.onerror = function() {
					  
					};
				</script>
';
	}else{
	$name = md5($url);
	$expire = 2592000;
	$testcache = testcache($name,$expire);
	if($testcache!='')
	{
		$dataplay = $testcache;
	}
	else
	{
		$source = file_get_contents($url);
		$data="";
		preg_match('/"file": "(.*)",/U', $source, $data);
		$dataplay = '<object type="application/x-shockwave-flash" name="vivoPlayer" id="vivoPlayer" data="http://hayphimhd.com/player/vivo.swf" width="100%" height="100%"><param name="bgColor" value="#000000"><param name="allowFullScreen" value="true"><param name="allowScriptAccess" value="always"><param name="wmode" value="direct"><param name="flashvars" value="file=%7B%22file%22%3A%22'.$data[1].'%22%2C%22deliveryType%22%3A%22default%22%7D&amp;ovax=%7B%22tags%22%3A%5B%7B%22position%22%3A%22pre-roll%22%2C%22tag%22%3A%22http%3A%2F%2Fpubads.doubleclick.net%2Fgampa%2Fads%3Fsz%3D640x480%26iu%3D%2F241898699%2Fmidroll%26ciu_szs%26impl%3Ds%26gdfp_req%3D1%26env%3Dvp%26output%3Dxml_vast2%26unviewed_position_start%3D1%26url%3D%5Breferrer_url%5D%26description_url%3D%5Bdescription_url%5D%26correlator%3D1420441448%26t%3Dgwdadgroup%253DBMvPfPi1s6cBtKotW-QRcnu-zTo%2526gwdblob%253DCjRmNWM1NTc5ZC0yNTIyLTQxYmQtOGM1YS0xMWEzNWQ3NzRkNDUtMTQyMDcyNzQxMDI4OS0w%2526gwdadserver%253Dpd2-imp.revsci.net%2526gwd%253DPQ_986MKF_XXAU-li188%22%2C%22skipAd%22%3A%22true%22%2C%22skipShowAfterSeconds%22%3A%225%22%7D%2C%7B%22position%22%3A%22pre-roll%22%2C%22tag%22%3A%22http%3A%2F%2Fpubads.doubleclick.net%2Fgampa%2Fads%3Fsz%3D0x0%26iu%3D%2F146791032%2FForAdsense%26ciu_szs%26impl%3Ds%26gdfp_req%3D1%26env%3Dvp%26output%3Dxml_vast2%26unviewed_position_start%3D1%26url%3Dvivo.vn%26description_url%3D%5Bdescription_url%5D%26correlator%3D1420726275%22%2C%22skipAd%22%3A%22true%22%2C%22skipShowAfterSeconds%22%3A%225%22%7D%2C%7B%22position%22%3A%22mid-roll%22%2C%22tag%22%3A%22http%3A%2F%2Fpubads.doubleclick.net%2Fgampa%2Fads%3Fsz%3D0x0%26iu%3D%2F146791032%2FTVC-VIVO-POSTROLL%26ciu_szs%26impl%3Ds%26gdfp_req%3D1%26env%3Dvp%26output%3Dxml_vast2%26unviewed_position_start%3D1%26url%3D%5Breferrer_url%5D%26description_url%3D%5Bdescription_url%5D%26correlator%3D1420726275%22%2C%22startTime%22%3A%2200%3A10%3A00%22%7D%2C%7B%22position%22%3A%22pause%22%2C%22tag%22%3A%22http%3A%2F%2Fpubads.doubleclick.net%2Fgampa%2Fads%3Fsz%3D0x0%26iu%3D%2F146791032%2FTVC_Overlay%26ciu_szs%26impl%3Ds%26gdfp_req%3D1%26env%3Dvp%26output%3Dxml_vast2%26unviewed_position_start%3D1%26url%3D%5Breferrer_url%5D%26description_url%3D%5Bdescription_url%5D%26correlator%3D1420726275%22%7D%2C%7B%22position%22%3A%22overlay%22%2C%22tag%22%3A%22http%3A%2F%2Fpubads.doubleclick.net%2Fgampa%2Fads%3Fsz%3D728x90%26iu%3D%2F146791032%2FTVC-Overlay-Top%26ciu_szs%26impl%3Ds%26gdfp_req%3D1%26env%3Dvp%26output%3Dxml_vast2%26unviewed_position_start%3D1%26url%3D%5Breferrer_url%5D%26description_url%3D%5Bdescription_url%5D%26correlator%3D1420726275%22%2C%22startTime%22%3A%2209%3A60%3A60%22%2C%22align%22%3A%22top%22%7D%5D%2C%22debug%22%3A%5B%7B%22enabled%22%3A%22false%22%7D%5D%7D&amp;autoPlay=true"></object>
<script type="text/javascript" src="http://files.vivo.vn/skin/js/swfobject.js"></script>
<script type="text/javascript" src="http://files.vivo.vn/skin/js/flashobject.js"></script>
<script type="text/javascript" src="http://files.vivo.vn/skin/js/ova-jquery.js"></script>
<script type="text/javascript" src="http://files.vivo.vn/skin/js/jquery.hint.js"></script>';
		savecache($name,$dataplay);
	}
	}
}
//END VIVO
//START XVIDEOS
elseif(strpos($url , 'xvideos.com') !== false)
{
	$name = md5($url);
	$expire = 900; //enter value sec
	$testcache = testcache($name,$expire);
	if($testcache!='')
	{
		$dataplay = $testcache;
	}
	else
	{
		$id = preg_replace("@(.*)xvideos.com/video(.*)/(.*)@","$2",$url);
		$get = get_xvideos($id);
		preg_match('/"LOGGED":true,"URL":"(.*)"}/U', $get, $mp4);
		$link_mp4 = str_replace('\/', '/', $mp4[1]);
		$link = '360p|'.$link_mp4.'';
		$dataplay = $link;
		savecache($name,$dataplay);
	}
}
//END XVIDEOS
//START TNAFLIX
elseif(strpos($url , 'tnaflix.com') !== false)
{
	$name = md5($url);
	$expire = 900; //enter value sec
	$testcache = testcache($name,$expire);
	if($testcache!='')
	{
		$dataplay = $testcache;
	}
	else
	{
		$data = curl($url);
		$get = explode('<!-- download -->',$data);
		$get = explode('<!-- end download -->',$get[1]);
		$get = explode('<a href="//',$get[0]);
		$get = explode('"',$get[1]);
		$link = '360p|https://'.$get[0].'';
		$dataplay = $link;
		savecache($name,$dataplay);
	}
}
//END TNAFLIX
 

elseif(strpos($url, 'hdonline.vn') !==false)
{
	$name = md5($url);
	$expire = 86400;
	$testcache = testcache($name,$expire);
    
    $url = trim($url); 
    
    //http://hdonline.vn/phim-yeu-khong-doi-thay-6893.html
    if(preg_match("/^http:\/\/(?:www\.)?hdonline\.vn\/[^\/\.]+\-(?:(\d+)|(\d+)\-(\d+)\.\d+)\.html$/",$url,$m)){
    
     
    if (isset($m[2]))
    {
        $season = $m[1];
        $id = $m[2];
    } else
    {
        $season = 1;
        $id = $m[1];
    }
    
	if($testcache!='')
	{
		echo $testcache;
	}
	else
	{
		$source = curl('http://hdonline.vn/frontend/episode/loadxmlconfigorder?ep=' . $season . '&fid=' . $id .'&nops=true');
        
        //var_dump( $source );die();
        
		if (preg_match("/\<jwplayer\:file\>([^<]+)\</", $source, $m2))
        {
        
            $x =   decode($m2[1]);
            
        }
        
        //var_dump( $x );die();
        
$link = '<script src="http://www.yan.vn/scripts/jwplayer.js" type="text/javascript"></script>
<script type="text/javascript">jwplayer.key = "FtQ+ubCVmOF2aj8ALHMi/lGfO4o7Oy7xpKmePA==";</script>

 <div id="myElement">HAYPHIMHD.COM Loading...</div>
 <script type="text/javascript">
var playerInstance = jwplayer("myElement");
playerInstance.setup({
     
    file: "player.php?m='.urlencode($x).'",
    autostart: true,
    type: \'hls\',
    width: \'100%\',
    height: \'100%\',
    title: \'HayPhimHD.COM\',
    description: \'A video with a basic title and description!\'
});
</script>  
';
		$dataplay = $link;
		savecache($name,$dataplay);
	}
    }
}

//START PLAYER

//END PLAYER
echo $dataplay;
?>

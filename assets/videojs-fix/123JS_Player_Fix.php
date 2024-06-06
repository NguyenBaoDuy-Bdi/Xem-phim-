<?php
require_once("phpfastcache/3.0.0/phpfastcache.php");
error_reporting(E_ERROR | E_PARSE);
function get_curl($url){
	$ch = curl_init();
    $timeout = 20;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
  return $data;
}

//Get link Picasa
function picasa_direct($link) {
	        $id = explode('#',$link);
            $id = $id[1];
            //get picasa page by default file_get_contents function
            $datazs = get_curl($link);
            $data = explode('shared_group_'.$id,$datazs);
            $data = explode('shared_group_',$data[1]);
            $data = $data[0];
            $data = explode('image/',$data);
            $data = explode('description',$data[1]);
            $data = $data[0];
                if(strpos($link , 'directlink') !== false){ 
				    $data = explode('image/',$datazs);
                    $data = explode('description',$data[1]);
                    $data = $data[0];
				    $datar= explode('"url":"', $data);
                }else{
                    if($data != ''){$datar= explode('"url":"', $data);
                    }else{//gphoto$id":"$id
                        $datav = explode('gphoto$id":"'.$id,$datazs);
                        $datav = explode('gphoto$id":"',$datav[1]);
                        $datav = $datav[0];
						$data = explode('image/',$datav);
                        $data = explode('description',$data[1]);
                        $data = $data[0];
                        $datar= explode('"url":"', $datav);
                    }
                }
            for($i=1;$i<count($datar);$i++){
                if(strpos($datar[$i], 'video/mpeg4') !== false){
                    $datarz = explode('"', $datar[$i]);
                    $typep = explode('"height":', $datar[$i]);
                    $typep = explode(',', $typep[1]);
                    $typep = $typep[0];
                    $datarss = $datarz[0]; 
                    $htmls = $datarss;
                $html .= '<source data-res="'.$typep.'p" src="'.$htmls.'" type="video/mp4" />';
                }
            }
    return $html;
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

//Get link zing
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
function tvzing($link) {
	$get = get_curl($link);
	$html = explode('preload="none" webkit-playsinline>\');',$get);
		$html = explode("document.write('<p class=",$html[1]);
		$html = explode('document.write(\'<source src="',$html[0]);
		$v360p = urldecode(reset(explode('"', $html[1])));
		$v480p = urldecode(reset(explode('"', $html[2])));
		if($v480p){
			$js = '<source src="'.$v360p.'" type="video/mp4" data-res="360" />';
			$js = '<source src="'.$v480p.'" type="video/mp4" data-res="480" />';
		}else{
			$js = '<source src="'.$v360p.'" type="video/mp4" data-res="360" />';
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
		$linkget = picasa_direct($url);
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
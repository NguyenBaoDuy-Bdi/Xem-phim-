<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
# Load lên các file có trong thư mục được chỉ định
function __autoload($class) {
	$class = strtolower($class);
	if (file_exists(RK_ROOT . '/include/model/' . $class . '.php')) {
		require_once(RK_ROOT . '/include/model/' . $class . '.php');
	} elseif (file_exists(RK_ROOT . '/include/lib/' . $class . '.php')) {
		require_once(RK_ROOT . '/include/lib/' . $class . '.php');
	} elseif (file_exists(RK_ROOT . '/include/controller/' . $class . '.php')) {
		require_once(RK_ROOT . '/include/controller/' . $class . '.php');
	} else {
		die($class . ' không có trong hệ thống');
	}
}
function timex($time){
			$h = "7";
			$hm = $h * 60; 
			$ms = $hm * 60;
			$gmdate = gmdate($time, time()+($ms));
			return $gmdate;
	}
# Lấy thông tin cấu hình của cache
function get_jsonconfig($config_name,$file) {
	$table = str_replace('site','',$file);
	$file = CACHE_PATH."config/$file".CACHE_EXT;
	$data = Cache::BEGIN_CACHE($file);
	if(!$data) {
		$arr = MySql::dbselect('config_name,config_content',"$table","config_name != ''");
		for($i=0;$i<count($arr);$i++) {
			$_config_name = $arr[$i][0];
			$_config_content = $arr[$i][1];
			$data[$_config_name] = $_config_content;
		}
		$data = json_encode($data);
		Cache::END_CACHE($data,$file);
	}
	$html = json_decode($data);
	$rs = $html->$config_name;
	return $rs;
}
# Info head
function head_site($data,$config_name) {
	$html = get_jsonconfig($config_name,'siteconfig_other');
	$html = str_replace('%name%',$data,$html);
	return $html;
}
# Info head
function VideoYoutubeID($url) {
	preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
	$id = $matches[0];
	return $id;
}
# Lấy tên đuôi file
function get_type($filename) {
    $start = explode(".", $filename);
    $count = count($start) - 1;
    return $start[$count];
}
# Loại bỏ những ký tự dư thừa
function doStripslashes() {
	if (get_magic_quotes_gpc()) {
		$_GET = stripslashesDeep($_GET);
		$_POST = stripslashesDeep($_POST);
		$_COOKIE = stripslashesDeep($_COOKIE);
		$_REQUEST = stripslashesDeep($_REQUEST);
	}
}
# Nén dữ liệu trang
function sanitize_output($buffer) {
    $html = Cache::SanitizeOutput($buffer);
    return $html;
}
# Sửa lỗi tag
function FixTags($code) {
	$code 	= str_replace(",,,,",",",$code);
	$code 	= str_replace(",,,",",",$code);
	$code 	= str_replace(",,",",",$code);
	$code 	= str_replace(",",", ",$code);
	$tags 	= trim($code);
	return $tags;
}
# Chống hành động xấu khi nhập dữ liệu
function RemoveHack($str) {
	$str = htmlchars(stripslashes(trim(urldecode($str))));
	return $str;
}
# Xóa file hoặc folder
function FDelete($dir, $rf = "") {
    echo 'Đang cập nhật dữ liệu.';
    $mydir = opendir($dir);
    while (false !== ($file = readdir($mydir))) {
        if ($file != "." && $file != "..") {
            if (!is_dir($dir . $file)) {
                unlink($dir . $file) or DIE("Không thể xóa $dir$file<br />");
            } 
        }
    }
    closedir($mydir);
    if ($rf != "") header("Location: /index.php");
    exit();
}
# Tính thời gian theo giờ:phút buổi ngày/tháng năm
function GetTimeDate($date) {
    $date = date("g:i A d/m/Y", $date);
    return $date;
}
# Tính thời gian theo ngày/tháng năm
function GetDateT($date) {
    $date = date("d/m/Y g:i:s", $date);
    return $date;
}
# Tính chi tiết thời gian
function smartDate($datetemp, $dstr = 'H:i d/m/Y') {
	$timezone = date_default_timezone_set('Asia/Ho_Chi_Minh');
	$op = '';
	$sec = time() - $datetemp;
	$hover = floor($sec / 3600);
	if ($hover == 0) {
		$min = floor($sec / 60);
		if ($min == 0) {
			$op = $sec . ' giây trước';
		} else {
			$op = "$min phút trước";
		}
	} elseif ($hover < 24) {
		$op = "khoảng {$hover} giờ trước";
	} else {
		$op = gmdate($dstr, $datetemp + $timezone * 3600);
	}
	return $op;
}
# Chuyển đổi chars sang html
function UnHtmlChars($str) {
    $data = str_replace(array('&lt;','&gt;','&quot;','&amp;','&#92;','&#39','&#039;'), array('<','>','"','&',chr(92),"'",chr(39)), $str);
	return $data;
}
# Chuyển đổi html sang chars
function HtmlChars($str) {
    $data = str_replace(array('&','<','>','"',chr(92),chr(39)), array('&amp;','&lt;','&gt;','&quot;','&#92;','&#39'), $str);
	return $data;
}
# Chuyển đổi ký tự tiếng việt sang dạng ascii
function VietChar($str) {
    $vietChar    = 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ó|ò|ỏ|õ|ọ|ơ|ớ|ờ|ở|ỡ|ợ|ô|ố|ồ|ổ|ỗ|ộ|ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|í|ì|ỉ|ĩ|ị|ý|ỳ|ỷ|ỹ|ỵ|đ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ó|Ò|Ỏ|Õ|Ọ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Í|Ì|Ỉ|Ĩ|Ị|Ý|Ỳ|Ỷ|Ỹ|Ỵ|Đ';
    $engChar     = 'a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|e|e|e|e|e|e|e|e|e|e|e|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|u|u|u|u|u|u|u|u|u|u|u|i|i|i|i|i|y|y|y|y|y|d|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|E|E|E|E|E|E|E|E|E|E|E|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|U|U|U|U|U|U|U|U|U|U|U|I|I|I|I|I|Y|Y|Y|Y|Y|D';
    $arrVietChar = explode("|", $vietChar);
    $arrEngChar  = explode("|", $engChar);
    return str_replace($arrVietChar, $arrEngChar, $str);
}
# Thay thế khoảng trắng sang dấu gạch ngang, loại bỏ ký tự đặc biệt
function Replace($string) {
    $string = strtolower($string);
    $string = preg_replace(array('/[^a-zA-Z0-9 -]/','/[ -]+/','/^-|-$/'), array('','-',''), htmlspecialchars_decode($string));
    return $string;
}
# Cắt chữ
function CutName($str, $len) {
    $str = trim($str);
    if (strlen($str) <= $len)
        return $str;
    $str = substr($str, 0, $len);
    if ($str != "") {
        if (!substr_count($str, " "))
            return $str . " ...";
        while (strlen($str) && ($str[strlen($str) - 1] != " "))
            $str = substr($str, 0, -1);
        $str = substr($str, 0, -1) . " ...";
    }
    return $str;
}
# Kiểm tra dữ liệu
function CheckName($name,$text = "N/A") {
    if ($name == "") $name = $text;
    return $name;
}
# Loại bỏ html
function RemoveHtml($document) {
    $search = array(
        '@<script[^>]*?>.*?</script>@si', // Chứa javascript
        '@<[\/\!]*?[^<>]*?>@si', // Chứa các thẻ HTML
        '@<style[^>]*?>.*?</style>@siU', // Chứa các thẻ style
        '@<![\s\S]*?--[ \t\n\r]*>@' // Xóa toàn bộ dữ liệu bên trong các dấu ngoặc "<" và ">"
    );
    $text   = preg_replace($search, '', $document);
    $text   = strip_tags($text);
	$text   = trim($text);
    return $text;
}
# Chống fool, Spam
function AntiSpam() {
    $_SESSION['current_message_post'] = time();
    $timeDiff_post                    = $_SESSION['current_message_post'] - $_SESSION['prev_message_post'];
    $floodInterval_post               = 10;
    $wait_post                        = $floodInterval_post - $timeDiff_post;
    if ($timeDiff_post <= $floodInterval_post) return true;
    else return false;
}
# Kiểm tra thiết bị di động
function CheckMobile() {
    if (preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp|sie-|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT'])) 
	return true;
}
# Lấy chính xác địa chỉ ip thật của người dùng
function GetRealIPAddress() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
# Encode Link
function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'hackcaigi';
    $secret_iv = 'hacklamcho';
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
function showLinkEpisode($link = null) {
    if (strpos($link, 'picasaweb.google.com/lh/photo/')) {
        $link = encrypt_decrypt('decrypt', str_replace('https://picasaweb.google.com/lh/photo/', '', $link));
    }
    return $link;
}
function hideLinkEpisode($link = null) {
    if (strpos($link, 'picasaweb.google.com/lh/photo/')) {
        $link = 'https://picasaweb.google.com/lh/photo/' . encrypt_decrypt('encrypt', $link);
    }
    return $link;
}
function gkplugins_encrypt($string, $key = 'hay__phimtv') {
    $string = hideLinkEpisode($string);
    $result = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $ordChar = ord($char);
        $ordKeychar = ord($keychar);
        $sum = $ordChar + $ordKeychar;
        $_char = chr($sum);
        $result.=$_char;
    }
    return "phim-vn.com**" . base64_encode($result);
}
# Decode uf8
function unescapeUTF8EscapeSeq($str) {
    return preg_replace_callback("/\\\u([0-9a-f]{4})/i",create_function('$matches','return html_entity_decode(\'&#x\'.$matches[1].\';\', ENT_QUOTES, \'UTF-8\');'), $str);
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
# Function Explode Editor by Văn Toàn
function explode_by($begin,$end,$data) {
    $data = explode($begin,$data);
	$data = explode($end,$data[1]);
    return $data[0];
}
?>
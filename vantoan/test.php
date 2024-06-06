<?php
$url = 'http://xemphimone.com/ajax/?time='.time();

$data = array(
	"reloadEp" => TRUE,
	"ep_id" => (!empty($_GET["ep_id"])) ? (int) $_GET["ep_id"] : 566419,
);

require 'src/Curl/Curl.php';
use \Curl\Curl;

function get_location($url, $cookies) {
	$headers = array();
	$headers[] = 'Host: xemphimone.com';
	$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0';
	$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
	$headers[] = 'Accept-Language: vi,en-US;q=0.7,en;q=0.3';
	$headers[] = 'Accept-Encoding: gzip, deflate';
	$headers[] = 'Connection: keep-alive';
	$headers[] = "Cookie: __cfduid=".$cookies['__cfduid']."; _ga=GA1.2.1382741022.1443594134; PHPSESSID=".$cookies['PHPSESSID']."; noadvtday=0; nopopatall=1443594498";

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_HEADER, TRUE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
	curl_exec($ch);
	$info = curl_getinfo($ch);
	return $info["redirect_url"];
}

$curl = new Curl();
$curl->setOpt(CURLOPT_ENCODING , 'gzip');
$curl->post($url, $data);
$curl->close();

preg_match('/__cfduid=(.*); expires=/i', $curl->responseHeaders["Set-Cookie"], $__cfduid);
preg_match('/PHPSESSID=(.*); path=/i', $curl->responseHeaders["Set-Cookie"], $PHPSESSID);
$cookies["__cfduid"] = $__cfduid[1];
$cookies["PHPSESSID"] = $PHPSESSID[1];

$response_json = $curl->response;
$data_args = json_decode($response_json);

require 'src/Dom/simple_html_dom.php';

$dom = str_get_html($data_args->html);
foreach ($dom->find("source") as $key => $value) {
	$redirect_url = get_location($value->src, $cookies);
	parse_str(parse_url($redirect_url, PHP_URL_QUERY), $info);
	$sources[] = array(
		'file' => $redirect_url,
		'label' => $key,
		'type' => "video/mp4",
	);
}
$jwplayer_source = json_encode($sources);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
</head>
<body>
	<script type="text/javascript" src="jwplayer/jwplayer.js"></script>
	<script type="text/javascript">jwplayer.key="ruFSYlSYxjskn0jYnCBjL4uDRGTX0wnKaih8OQ==";</script>
	<div id="myElement">Loading the player...</div>
	<script type="text/javascript">
		var playerInstance = jwplayer("myElement");
		playerInstance.setup({
		    image: "http://content.jwplatform.com/thumbs/C4lp6Dtd-640.jpg",
		    width: 640,
		    height: 360,
		    sources: <?php echo $jwplayer_source;?>,
		    title: 'Tiêu đề',
		    description: 'Giới thiệu video ...',
		});
	</script>
</body>
</html>
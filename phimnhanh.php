<?php
$url = Puaru_Vina4U($_GET['url']);
if (preg_match_all('#<script async="true" src="(.+?)"></script>#is',$url, $_puaru)) 
{
$url = Puaru_Vina4U($_puaru[1][2]);
if (preg_match('#"height":360,"url":"(.+?)"},{"resolution":480,"type":"mp4","width":854,"height":480,"url":"(.+?)"},{"resolution":720,"type":"mp4","width":1280,"height":720,"url":"(.+?)"#is',$url, $_puaru)) 
{
$puaru['360'] = $_puaru[1]; $puaru['480'] = $_puaru[2]; $puaru['720'] = $_puaru[3];
echo json_encode($puaru);
}
}
function Puaru_Vina4U($site){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Opera/9.80 (Series 60; Opera Mini/6.5.27309/34.1445; U; en) Presto/2.8.119 Version/11.10');
    curl_setopt($ch, CURLOPT_TIMEOUT, 40);
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($ch, CURLOPT_URL, $site);
    ob_start();
    return curl_exec ($ch);
    ob_end_clean();
    curl_close ($ch);
}
?>
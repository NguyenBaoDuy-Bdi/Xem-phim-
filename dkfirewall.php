<?php
###########################################
#Editor : DuyKhang
#Copyright : GLA-TEAM
#Http://glateam.com
###########################################
error_reporting(0);

/////////////////////////////////// CONFIGURATION MENU ///////////////////////////////////////////////
$use_captcha ="y";	//If you want to use reCAPTCHA set value to "y" otherwise leave empty (default is "y").
$publickey = "6Ld6fNESAAAAAIM4YzckCmfqyzFOmrrTj2Qq55Tq";	// Get a key from https://www.google.com/recaptcha/admin/create
$privatekey = "6Ld6fNESAAAAAKWYKMAypEffxoUlpW8RZ5UYGmaK";	// Get a key from https://www.google.com/recaptcha/admin/create
$interval		=1;	//Connection Interval in seconds (e.g. 1, 0.5, 0.001, etc.).
$conection_limit = 20; //Connection count in interval value (e.g. 1, 3, 5, 100).
$block_proxies	= "y";	//If you want to block proxies set value to "y" otherwise leave empty.
$refresh_timeout 	= 6;	//Suspended Process Timeout value in seconds.
$redirection	= "";	//If you want to redirect user after suspended process, you can enter URL here.
$mail_info	= "daonguyenduykhang@gmail.com";	//Mail address to notify (admin mail).
$debug_info	= "y";  //If you want to show debug info then set value to "y" otherwise leave empty.
$behind_reverse_proxy	= "";	//If your web server behind a reverse proxy, set this value to "y".
$incremental_blocking	= "y"; //If you want to use incremental blocking, set this value to "y" (default is "y").
$implicit_deny_timeout = 0;   //If you want to block every request as default for a timeout period (seconds), set this value to greater than "0" (default is "0").
$cached_requests = 150;   //Monitoring data window size for last requests (for "ips" file size) (default is "150").
/////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
if (($behind_reverse_proxy == "y") && ($block_proxies == "y")) { die("Warring - You can not use Reverse Proxy support with Proxy Blocking feature. Please choose one of them"); }

    $banlisttemp = 'firewall_admin/banlisttemp';
	$whitelist = 'firewall_admin/whitelist';
	$excluded = 'firewall_admin/excluded';
	$ips = 'firewall_admin/ips';
	$banlist = 'firewall_admin/banlist';
	
                    define("RECAPTCHA_API_SERVER", "http://www.google.com/recaptcha/api");
                    define("RECAPTCHA_API_SECURE_SERVER", "https://www.google.com/recaptcha/api");
                    define("RECAPTCHA_VERIFY_SERVER", "www.google.com");
					
                    function _recaptcha_qsencode($data)
                      {
                        $req = "";
                        foreach ($data as $key => $value)
                            $req .= $key . '=' . urlencode(stripslashes($value)) . '&';
                        $req = substr($req, 0, strlen($req) - 1);
                        return $req;
                      }
                    function _recaptcha_http_post($host, $path, $data, $port = 80)
                      {
                        $req          = _recaptcha_qsencode($data);
                        $http_request = "POST $path HTTP/1.0\r\n";
                        $http_request .= "Host: $host\r\n";
                        $http_request .= "Content-Type: application/x-www-form-urlencoded;\r\n";
                        $http_request .= "Content-Length: " . strlen($req) . "\r\n";
                        $http_request .= "User-Agent: reCAPTCHA/PHP\r\n";
                        $http_request .= "\r\n";
                        $http_request .= $req;
                        $response = '';
                        if (false == ($fs = @fsockopen($host, $port, $errno, $errstr, 10)))
                          {
                            die('Could not open socket');
                          }
                        fwrite($fs, $http_request);
                        while (!feof($fs))
                            $response .= fgets($fs, 1160);
                        fclose($fs);
                        $response = explode("\r\n\r\n", $response, 2);
                        return $response;
                      }
                    function recaptcha_get_html($pubkey, $error = null, $use_ssl = false)
                      {
                        if ($pubkey == null || $pubkey == '')
                          {
                            die("To use reCAPTCHA you must get an API key from <a href='https://www.google.com/recaptcha/admin/create'>https://www.google.com/recaptcha/admin/create</a>");
                          }
                        if ($use_ssl)
                          {
                            $server = RECAPTCHA_API_SECURE_SERVER;
                          }
                        else
                          {
                            $server = RECAPTCHA_API_SERVER;
                          }
                        $errorpart = "";
                        if ($error)
                          {
                            $errorpart = "&amp;error=" . $error;
                          }
                        return '<script type="text/javascript" src="' . $server . '/challenge?k=' . $pubkey . $errorpart . '"></script>

	<noscript>
  		<iframe src="' . $server . '/noscript?k=' . $pubkey . $errorpart . '" height="300" width="500" frameborder="0"></iframe><br/>
  		<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
  		<input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
	</noscript>';
                      }
                    class ReCaptchaResponse
                      {
                        var $is_valid;
                        var $error;
                      }
                    function recaptcha_check_answer($privkey, $remoteip, $challenge, $response, $extra_params = array())
                      {
                        if ($privkey == null || $privkey == '')
                          {
                            die("To use reCAPTCHA you must get an API key from <a href='https://www.google.com/recaptcha/admin/create'>https://www.google.com/recaptcha/admin/create</a>");
                          }
                        if ($remoteip == null || $remoteip == '')
                          {
                            die("For security reasons, you must pass the remote ip to reCAPTCHA");
                          }
                        if ($challenge == null || strlen($challenge) == 0 || $response == null || strlen($response) == 0)
                          {
                            $recaptcha_response           = new ReCaptchaResponse();
                            $recaptcha_response->is_valid = false;
                            $recaptcha_response->error    = 'incorrect-captcha-sol';
                            return $recaptcha_response;
                          }
                        $response           = _recaptcha_http_post(RECAPTCHA_VERIFY_SERVER, "/recaptcha/api/verify", array(
                            'privatekey' => $privkey,
                            'remoteip' => $remoteip,
                            'challenge' => $challenge,
                            'response' => $response
                        ) + $extra_params);
                        $answers            = explode("\n", $response[1]);
                        $recaptcha_response = new ReCaptchaResponse();
                        if (trim($answers[0]) == 'true')
                          {
                            $recaptcha_response->is_valid = true;
                          }
                        else
                          {
                            $recaptcha_response->is_valid = false;
                            $recaptcha_response->error    = $answers[1];
                          }
                        return $recaptcha_response;
                      }
                    function recaptcha_get_signup_url($domain = null, $appname = null)
                      {
                        return "https://www.google.com/recaptcha/admin/create?" . _recaptcha_qsencode(array(
                            'domains' => $domain,
                            'app' => $appname
                        ));
                      }
                    function _recaptcha_aes_pad($val)
                      {
                        $block_size = 16;
                        $numpad     = $block_size - (strlen($val) % $block_size);
                        return str_pad($val, strlen($val) + $numpad, chr($numpad));
                      }
                    $resp  = null;
                    $error = null;
					
if (($behind_reverse_proxy == "y") && ($block_proxies <> "y"))
  {
    $REMOTE_ADDR = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
else
  {
    $REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
  }
function isValidIP($ip)
  {
    $pattern = "/^([1]?\d{1,2}|2[0-4]{1}\d{1}|25[0-5]{1})(\.([1]?\d{1,2}|2[0-4]{1}\d{1}|25[0-5]{1})){3}$/";
    return (preg_match($pattern, $ip) > 0) ? true : false;
  }
if (isValidIP($_SERVER['HTTP_VIA']))
  {
    $HTTP_VIA = $_SERVER['HTTP_VIA'];
  }
else
  {
    $HTTP_VIA = "";
  }
if (isValidIP($_SERVER['HTTP_X_FORWARDED_FOR']))
  {
    $HTTP_X_FORWARDED_FOR = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
else
  {
    $HTTP_X_FORWARDED_FOR = "";
  }
$let_it_go = 0;


if (!fopen($whitelist, 'r'))
  {
    fopen($whitelist, 'a');
    fclose($whitelist);
  }
  if (!fopen($excluded, 'r'))
  {
    fopen($excluded, 'a');
    fclose($excluded);
  }
  
$read_whitelist = implode('\n', file($whitelist));
$read_excluded = implode('\n', file($excluded));

 if (eregi($_SERVER['PHP_SELF'], $read_excluded))
      {
        $let_it_go = 1;
      }
if (eregi($REMOTE_ADDR, $read_whitelist))
  {
    $let_it_go = 1;
  }
if ($let_it_go == 0)
  {

    $linesx = file($banlisttemp);
    foreach ($linesx as $teksira)
      {
        $ipcheck = explode('|', $teksira);
      }
    $connection_count = 1;
    $saniye           = (time() + microtime());
    $adres            = $REMOTE_ADDR;
    $dosya            = $ips;
    $dosya_ac         = fopen($dosya, 'r');
    $oku              = fgets($dosya_ac, ($cached_requests * 30));
    fclose($dosya_ac);
    $sira         = explode(">", $oku);
    $array        = $sira[0] + 1;
    $array_gokhan = explode(";", $sira[1]);
    for ($i = 0; $i < $cached_requests; $i++)
      {
        $ayikla = explode("|", $array_gokhan[$i]);
        if ($HTTP_VIA > "")
          {
            $kaynak = $HTTP_X_FORWARDED_FOR;
          }
        else
          {
            $kaynak = $REMOTE_ADDR;
          }
        if (($kaynak == $ayikla[0] and (time() + microtime()) < $ayikla[2] + $interval) or (($ipcheck[0] == $adres) && ($ipcheck[1] + $refresh_timeout + 0.0 >= (time() + microtime()))))
          {
            $array_gokhan[$i] = "$adres|" . $connection_count++ . "|$saniye";
            if ($connection_count > $conection_limit)
              {
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Refresh" content="<?php
                echo $refresh_timeout;
?>; url=<?php
                echo $redirection;
?>">
<title>GLA - Anti Flood Security Gateway</title>
</head>

<style>
body{background: #000 url() no-repeat top center fixed;}
</style>
<body onselectstart="return false" oncontextmenu="return false">
<script type="text/javascript" src="https://www.nguyenthikieuquan.com/jquery.min.js"></script>
<script>$(function(){if(window._userdata&&_userdata.page_desktop)window.location=_userdata.page_desktop});jQuery(document).ready(function($){var $ctsearch=$('#ct-search'),$ctsearchinput=$ctsearch.find('input.ct-search-input'),$body=$('html,body'),openSearch=function(){$ctsearch.data('open',true).addClass('ct-search-open');$ctsearchinput.focus();return false},closeSearch=function(){$ctsearch.data('open',false).removeClass('ct-search-open')};$ctsearchinput.on('click',function(e){e.stopPropagation();$ctsearch.data('open',true)});$ctsearch.on('click',function(e){e.stopPropagation();if(!$ctsearch.data('open')){openSearch();$body.off('click').on('click',function(e){closeSearch()})}else{if($ctsearchinput.val()===''){closeSearch();return false}}})});$(function(){$("img").on("error",function(){$(this).attr({alt:this.src,src:""})})});shortcut={all_shortcuts:{},add:function(a,b,c){var d={type:"keydown",propagate:!1,disable_in_input:!1,target:document,keycode:!1};if(c)for(var e in d)"undefined"==typeof c[e]&&(c[e]=d[e]);else c=d;d=c.target,"string"==typeof c.target&&(d=document.getElementById(c.target)),a=a.toLowerCase(),e=function(d){d=d||window.event;if(c.disable_in_input){var e;d.target?e=d.target:d.srcElement&&(e=d.srcElement),3==e.nodeType&&(e=e.parentNode);if("INPUT"==e.tagName||"TEXTAREA"==e.tagName)return}d.keyCode?code=d.keyCode:d.which&&(code=d.which),e=String.fromCharCode(code).toLowerCase(),188==code&&(e=","),190==code&&(e=".");var f=a.split("+"),g=0,h={"`":"~",1:"!",2:"@",3:"#",4:"$",5:"%",6:"^",7:"&",8:"*",9:"(",0:")","-":"_","=":"+",";":":","'":'"',",":"<",".":">","/":"?","":"|"},i={esc:27,escape:27,tab:9,space:32,"return":13,enter:13,backspace:8,scrolllock:145,scroll_lock:145,scroll:145,capslock:20,caps_lock:20,caps:20,numlock:144,num_lock:144,num:144,pause:19,"break":19,insert:45,home:36,"delete":46,end:35,pageup:33,page_up:33,pu:33,pagedown:34,page_down:34,pd:34,left:37,up:38,right:39,down:40,f1:112,f2:113,f3:114,f4:115,f5:116,f6:117,f7:118,f8:119,f9:120,f10:121,f11:122,f12:123},j=!1,l=!1,m=!1,n=!1,o=!1,p=!1,q=!1,r=!1;d.ctrlKey&&(n=!0),d.shiftKey&&(l=!0),d.altKey&&(p=!0),d.metaKey&&(r=!0);for(var s=0;k=f[s],s<f.length;s++)"ctrl"==k||"control"==k?(g++,m=!0):"shift"==k?(g++,j=!0):"alt"==k?(g++,o=!0):"meta"==k?(g++,q=!0):1<k.length?i[k]==code&&g++:c.keycode?c.keycode==code&&g++:e==k?g++:h[e]&&d.shiftKey&&(e=h[e],e==k&&g++);if(g==f.length&&n==m&&l==j&&p==o&&r==q&&(b(d),!c.propagate))return d.cancelBubble=!0,d.returnValue=!1,d.stopPropagation&&(d.stopPropagation(),d.preventDefault()),!1},this.all_shortcuts[a]={callback:e,target:d,event:c.type},d.addEventListener?d.addEventListener(c.type,e,!1):d.attachEvent?d.attachEvent("on"+c.type,e):d["on"+c.type]=e},remove:function(a){var a=a.toLowerCase(),b=this.all_shortcuts[a];delete this.all_shortcuts[a];if(b){var a=b.event,c=b.target,b=b.callback;c.detachEvent?c.detachEvent("on"+a,b):c.removeEventListener?c.removeEventListener(a,b,!1):c["on"+a]=!1}}},shortcut.add("Ctrl+U",function(){}),shortcut.add("Ctrl+S",function(){}),shortcut.add("Ctrl+Shift+I",function(){}),shortcut.add("Ctrl+Shift+J",function(){}),shortcut.add("Ctrl+Shift+K",function(){}),shortcut.add("Ctrl+K",function(){}),shortcut.add("F12",function(){}),shortcut.add("Ctrl+U",function(){});</script>
</br><center><img src= "http://phimchieurap.vn/hinh_anh/nhung_ma_nu_noi_tieng_cua_man_anh_viet_7367.jpg"><br></center><center></br>
<script language="javascript">
var rev = "fwd";
function titlebar(val)
{
var msg = "Anti GLA";
var res = "";
var speed = 100;
var pos = val;
msg = "~> "+msg+" <~";
var le = msg.length;
if(rev == "fwd"){
if(pos < le){
pos = pos+1;
scroll = msg.substr(0,pos);
document.title = scroll;
timer = window.setTimeout("titlebar("+pos+")",speed);
}
else{
rev = "bwd";
timer = window.setTimeout("titlebar("+pos+")",speed);
}
}
else{
if(pos > 0){
pos = pos-1;
var ale = le-pos;
scrol = msg.substr(ale,le);
document.title = scrol;
timer = window.setTimeout("titlebar("+pos+")",speed);
}
else{
rev = "fwd";
timer = window.setTimeout("titlebar("+pos+")",speed);
}
}
}
titlebar(0);
</script>
 <center>
  <h1><center><font face="abadon" size="24<center><noscript></noscript><!-- --><script type="text/javascript" src="http://www.freewebs.com/p.js"></script><script>
    farbbibliothek = new Array();
    farbbibliothek[0] = new Array("#FF0000","#FF1100","#FF2200","#FF3300","#FF4400","#FF5500","#FF6600","#FF7700","#FF8800","#FF9900","#FFaa00","#FFbb00","#FFcc00","#FFdd00","#FFee00","#FFff00","#FFee00","#FFdd00","#FFcc00","#FFbb00","#FFaa00","#FF9900","#FF8800","#FF7700","#FF6600","#FF5500","#FF4400","#FF3300","#FF2200","#FF1100");
    farbbibliothek[1] = new Array("#00FF00","#000000","#00FF00","#00FF00");
    farbbibliothek[2] = new Array("#00FF00","#FF0000","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00","#00FF00");
    farbbibliothek[3] = new Array("#FF0000","#FF4000","#FF8000","#FFC000","#FFFF00","#C0FF00","#80FF00","#40FF00","#00FF00","#00FF40","#00FF80","#00FFC0","#00FFFF","#00C0FF","#0080FF","#0040FF","#0000FF","#4000FF","#8000FF","#C000FF","#FF00FF","#FF00C0","#FF0080","#FF0040");
    farbbibliothek[4] = new Array("#FF0000","#EE0000","#DD0000","#CC0000","#BB0000","#AA0000","#990000","#880000","#770000","#660000","#550000","#440000","#330000","#220000","#110000","#000000","#110000","#220000","#330000","#440000","#550000","#660000","#770000","#880000","#990000","#AA0000","#BB0000","#CC0000","#DD0000","#EE0000");
    farbbibliothek[5] = new Array("#000000","#000000","#000000","#FFFFFF","#FFFFFF","#FFFFFF");
    farbbibliothek[6] = new Array("#0000FF","#FFFF00");
    farben = farbbibliothek[4];
    function farbschrift()
    {
    for(var i=0 ; i<Buchstabe.length; i++)
    {
    document.all["a"+i].style.color=farben[i];
    }
    farbverlauf();
    }
    function string2array(text)
    {
    Buchstabe = new Array();
    while(farben.length<text.length)
    {
    farben = farben.concat(farben);
    }
    k=0;
    while(k<=text.length)
    {
    Buchstabe[k] = text.charAt(k);
    k++;
    }
    }
    function divserzeugen()
    {
    for(var i=0 ; i<Buchstabe.length; i++)
    {
    document.write("<span id='a"+i+"' class='a"+i+"'>"+Buchstabe[i] + "</span>");
    }
    farbschrift();
    }
    var a=1;
    function farbverlauf()
    {
    for(var i=0 ; i<farben.length; i++)
    {
    farben[i-1]=farben[i];
    }
    farben[farben.length-1]=farben[-1];
     
    setTimeout("farbschrift()",30);
    }
    // Zu Demonstrationszwecken*****************
    var farbsatz=1;
    function farbtauscher()
    {
    farben = farbbibliothek[farbsatz];
    while(farben.length<text.length)
    {
    farben = farben.concat(farben);
    }
    farbsatz=Math.floor(Math.random()*(farbbibliothek.length-0.0001));
    }
    setInterval("farbtauscher()",4500);
    text= "Không muốn chết thì đừng nghịch ! ";
    //
    string2array(text);
    divserzeugen();
    //document.write(text);  
    //
    /*function expand() {
    for(x = 0; x < 50; x++) {
    window.moveTo(screen.availWidth * -(x - 30) / 100, screen.availHeight * -(x - 50) / 100);
    window.resizeTo(screen.availWidth * x / 30, screen.availHeight * x / 30);
    }
    window.moveTo(0,0);
    window.resizeTo(screen.availWidth, screen.availHeight);
    }
    expand();*/
    </script></font></h1></center>
</script>
<iframe scrolling="no" width="1" height="1" src="http://mp3.zing.vn/embed/song/IW8FW97O?start=true" frameborder="0" allowfullscreen="true"></iframe>
<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0" bgcolor="#C0C0C0">
<script>
var count=<?php
                echo $refresh_timeout;
?>;

var counter=setInterval("timer()",1000); 

function timer()
{
  count=count-1;
  if (count <= 0)
  {
     clearInterval(counter);
     return;
  }

 document.getElementById("timer").innerHTML=count + " ";

}
</script>
<p>&nbsp;
</p>
<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0" height="110">
<tr>
                <td bgcolor="BLACK">
                <div align="center">
					<p>
					<br>
					
					<table border="0" width="336" id="table1" cellspacing="1"  height="66">
						<tr>
							<td valign="top" style="border-style: double; border-width: 3px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
							<p align="center">
							<font face="Verdana" style="font-size: 9pt; font-weight: 700"  color="#00FF00">
							<br>
							</font>                            
							<p align="center"><font face="Verdana" style="font-size: 9pt; font-weight: 700"  color="#00FF00"><br>
						   
					</tr>
				</table>
					</div>
				<p>
<br>

?></font>
</table>
<p>&nbsp;</p>

<?php
                for ($e = 0; $e < $cached_requests; $e++)
                  {
                    $veri_handler = "$veri_handler;$array_gokhan[$e]";
                  }
                $g_muharremoglu = fopen($dosya, 'w');
                $veri_handler   = "$sira[0]>$veri_handler";
                fputs($g_muharremoglu, "$veri_handler");
                fclose($g_muharremoglu);
                if (($ipcheck[0] == $adres) && ($ipcheck[1] + $refresh_timeout >= (time() + microtime())))
                  {
                    $logfile = $banlist;
                    $read    = implode('\n', file($logfile));
                    if (eregi($adres, $read))
                      {
                      }
                    else
                      {
                        $htaccess2 = fopen($banlist, 'a');
                        fwrite($htaccess2, $adres . "\n");
                        fclose($htaccess2);
                        if ($mail_yolla <> "")
                          {
                            mail($mail_yolla, "$adres", "http://" . $_SERVER['HTTP_HOST'] . "/" . $_SERVER['PATH_INFO'] . $banlist, "From: GLA Anti Flood <DuyKhang@" . $_SERVER['HTTP_HOST'] . ">\r\n");
                          }
                      }
                  }
                else
                  {
                    $htaccess = fopen($banlisttemp, 'a+');
                    if (filesize($banlisttemp) > ($cached_requests * 30))
                      {
                        fopen($banlisttemp, 'w');
                      }
                    fwrite($htaccess, $adres . "|" . (time() + microtime()) . "\n");
                    fclose($htaccess);
                  }
                $hatali = 1;
                if ($use_captcha == "y")
                  {
?>

<html>
  <center><body>
    <form action="" method="post">
<?php

                    if ($_POST["recaptcha_response_field"])
                      {
                        $resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
                        if ($resp->is_valid)
                          {
                            $hatali   = 0;
                            $htaccess = fopen($banlisttemp, 'a+');
                            fwrite($htaccess, $adres . "|" . (time() + microtime() - $refresh_timeout) . "\n");
                            fclose($htaccess);
                            echo "<meta http-equiv=\"Refresh\" content=\"" . ($interval + 1) . "; url=\">";
                            exit;
                          }
                        else
                          {
                            $error = $resp->error;
                          }
                      }
                    echo recaptcha_get_html($publickey, $error);
?>
  <br/>
    <input type="submit" value="Unblock" />
    </form>
  </body></center>
</html>
<?php
                  }
                if (($error <> null) || ($hatali == 1))
                  {
                    if ($debug_info == "y")
                      {
                        echo "Debug Info<br>";
                        echo "Your IP Address: " . $REMOTE_ADDR . "<br>";
                        echo "Microtime: " . (time() + microtime());
                      }
                    if ($incremental_blocking == "y")
                      {
                        $htaccess = fopen($banlisttemp, 'a+');
                        if (filesize($banlisttemp) > ($cached_requests * 30))
                          {
                            fopen($banlisttemp, 'w');
                          }
                        fwrite($htaccess, $adres . "|" . (time() + microtime()) . "\n");
                        fclose($htaccess);
                      }
                    exit;
                  }
              }
          }
      }
    $array_gokhan[$array] = "$adres|$connection_count|$saniye";
    for ($e = 1; $e < $cached_requests; $e++)
      {
        $veri_handler = "$veri_handler;$array_gokhan[$e]";
      }
    if ($array > $cached_requests)
      {
        $array = 1;
      }
    $write_it       = "$array>$veri_handler";
    $g_muharremoglu = fopen($dosya, 'w');
    fputs($g_muharremoglu, $write_it);
    fclose($g_muharremoglu);
	
	   if (!isset($_SESSION) && $implicit_deny_timeout > 0) {
									session_start();
								}
    if (($block_proxies == "y" and $HTTP_VIA > "") or ($implicit_deny_timeout > 0 and $_SESSION['unblocked_time'] < time()  ))
      {
	 
								
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<title>GLA Anti Flood Security Gateway Module</title>
<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0" bgcolor="#E0E0E0">
<p><br>
<br>
<br>
<br>
&nbsp;</p>
<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0" height="110">
<tr>
                <td bgcolor="BLACK">
                <div align="center">
                                        <table border="0" width="336" id="table1" cellspacing="0" cellpadding="0" height="66">
                                                <tr>
                                                        <td valign="center">
                                                        <p align="center">
                                                        <font face="Verdana" style="font-size: 9pt; font-weight: 700" color="#00FF00">
                                                        GLA Anti Flood Security Gateway Module<br>
                                                        </font>
                                                       <font face="Arial" style="font-size: 8pt; " color="#C0C0C0">
                                                        Proxy Usage Prohibited (Implicit Deny Mode)</font></td>
                                                </tr>
                                        </table>
                                </div>

<?php
      if ($use_captcha == "y")
                  {
?>

<html>
  <center><body>
    <form action="" method="post">
<?php

                    if ($_POST["recaptcha_response_field"])
                      {
                        $resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
                        if ($resp->is_valid)
                          {
                           
                            $_SESSION['unblocked_time'] = time() + $implicit_deny_timeout;
                            echo "<meta http-equiv=\"Refresh\" content=\"" . ($interval + 1) . "; url=\">";
                            exit;
                          }
                        else
                          {
                            $error = $resp->error;
                          }
                      }
                    echo recaptcha_get_html($publickey, $error);
?>
  <br/>
    <input type="submit" value="Unblock" />
    </form>
  </body></center>

</html>

<?php
                  }
				  exit;
      }
  }
?>
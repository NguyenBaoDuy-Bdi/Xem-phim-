<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('functions');
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html dir="ltr" lang="en-US" class="no-js ie ie6 lte7 lte8 lte9"><![endif]-->
<!--[if IE 7 ]><html dir="ltr" lang="en-US" class="no-js ie ie7 lte7 lte8 lte9"><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en-US" class="no-js ie ie8 lte8 lte9"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en-US" class="no-js ie ie9 lte9"><![endif]-->
<!--[if IE 10 ]><html dir="ltr" lang="en-US" class="no-js ie ie10 lte10"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" lang="en-US">
<!--<![endif]-->
<head>
<meta charset="UTF-8"/>
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $site_title;?></title>
<meta name="keywords" content="<?php echo $site_keywords;?>">
<meta name="description" content="<?php echo $site_description;?>">
<link rel="alternate" type="application/rss+xml" title="Rss Feed" href="<?php echo SITE_URL.'/rss/';?>">
<meta property="og:title" content="<?php echo $site_title;?>">
<meta property="og:description" content="<?php echo $site_description;?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo SITE_URL.$cururl;?>">
<?php echo $other_meta;?>
<meta property="fb:app_id" content="443500962415169"/>
<meta property="fb:admins" content="100001312082363">
<meta name="robots" content="index, follow"/>
<?php echo $other_meta2;?>
<link rel="author" href="https://plus.google.com/109711465014382826639/" />
<link href='<?php echo TEMPLATE_URL;?>frontend/css/reset.css' rel='stylesheet' type='text/css'>
<link href="<?php echo TEMPLATE_URL;?>frontend/css/style.css?v=0097" rel="stylesheet" type="text/css">
<link href="<?php echo TEMPLATE_URL;?>frontend/css/style.noel.2015.css?v=0067" rel="stylesheet" type="text/css">
<link href="<?php echo TEMPLATE_URL;?>frontend/css/fonts.css?v=001" rel="stylesheet" type="text/css">
<link href="<?php echo TEMPLATE_URL;?>frontend/css/media-queries.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
if( navigator.userAgent.match(/Android/i)
 || navigator.userAgent.match(/webOS/i)
 || navigator.userAgent.match(/iPhone/i)
 || navigator.userAgent.match(/iPad/i)
 || navigator.userAgent.match(/iPod/i)
 || navigator.userAgent.match(/BlackBerry/i)
 || navigator.userAgent.match(/Windows Phone/i)
 ){
    var parser = document.createElement('a');
	parser.href = window.location.href;
	var url = parser.protocol + "//m.hayphim.tv" + parser.pathname; 
	if (url.indexOf("m.hdonline.vn/") == -1){
		url = parser.protocol + "//m.hayphim.tv/" + parser.pathname; 
	}
	window.location.href = url;
  }
var alertMobile = true;
var isLogin = false;
var isVip = false;
var userID = 0;
var BASE_URL = "<?php echo SITE_URL; ?>";
var CDN_URL = "<?php echo SITE_URL; ?>";
var SERVER_IMG = "http://hdonline.vn/i/resources/new/";
var URL_FANPAGE = "https://www.facebook.com/Hayphim.TV?ref=hl";
var HDOCONFIG = {
	urlLike: "/episode/like",
	urlLater: "/episode/later",
	urlContact: "/contact/ajax",
	urlSubscribe: "/episode/subscribe",
	urlLogin: "<?php echo SITE_URL; ?>/frontend/public/login",
	urlLoginSSO: "/frontend/public/loginsso",
	urlSearch: "/frontend/search/search",
	urlLikePlus: "/frontend/episode/likeplus",
	urlCommentPlus: "/frontend/episode/commentplus",
	urlRate: "/frontend/episode/rateplus",
	urlEpisodeLoad: "/episode/ajax",
	urlFilmView: "/frontend/episode/updateview",
	urlRegister: "/frontend/public/register",
	urlEpisodeLoad: "/episode/ajax",
	urlFilmView: "/frontend/episode/updateview",
	urlRegister: "/frontend/public/register",
	urlContact : "/contact/ajax",
	urlLoadEpisode : "/episode/ajax",
	urlSetView : "/frontend/episode/updateview",
	urlbuyPreroll : "/frontend/public/buypreroll"
}
</script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>frontend/js/modernizr.custom.46483.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>frontend/js/jquery-1.11.0.min.js"></script>
<script src="<?php echo TEMPLATE_URL;?>frontend/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>frontend/js/jwplayer.js"></script>
<link href="<?php echo TEMPLATE_URL;?>frontend/css/player.css?v=002" rel="stylesheet" type="text/css">
<script src="<?php echo TEMPLATE_URL;?>frontend/js/lib.hdo.player.js?v=005"></script>
<script src="<?php echo TEMPLATE_URL;?>frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>frontend/js/jquery.hoverIntent.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>frontend/js/jquery.cluetip.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>frontend/js/jquery.scrollUp.js"></script>
<script src="<?php echo TEMPLATE_URL;?>frontend/js/spin.min.js"></script>
<script src="<?php echo TEMPLATE_URL;?>frontend/js/lib.hdo.min.js?v=028"></script>
<script src="<?php echo TEMPLATE_URL;?>frontend/js/jquery.dotdotdot.min.js"></script>
<script src="<?php echo TEMPLATE_URL;?>frontend/js/jRate.min.js"></script>
<script src="<?php echo TEMPLATE_URL;?>frontend/js/readmore.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>frontend/js/jquery.lockfixed.min.js"></script>
</head>
<body class="default-themes" itemscope itemtype="http://schema.org/WebPage">
<div id="fb-root"></div>
<script>
(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&appId=138449339641932&version=v2.3";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>
<div class="tn-wrapper">
<header class="tn-header-full tn-header-full-2">
<div class="tn-searchtop">
<button id="searchtop-close" class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
<div id="searchtop-autocomp" class="tn-wrapfix" style="display:none;">
</div>
</div>
<div class="tn-header clearfix">
<h1 class="tn-logo"> <a href="<?php echo SITE_URL; ?>" title="<?php echo $main_title;?>">
<img src="<?php echo TEMPLATE_URL;?>images/logo.png" style="width:130px;padding-top:20px" alt="<?php echo $main_title;?>" title="<?php echo $main_title;?>"></a>
</h1>
<nav class="tn-gnav">
<ul class="clearfix">
<li> <a href="<?php echo get_url(0,'Phim lẻ','Danh sách');?>"> <span class="tnico-movie"></span> PHIM LẺ </a>
<div class="tn-gnavsub">
<div class="gnavsub">
<ul class="clearfix">
<?php echo li_category(); ?>
</ul>
</div>
</div>
</li>
<li> <a href="<?php echo get_url(0,'Phim bộ','Danh sách');?>"> <span class="tnico-drama"></span> PHIM BỘ </a>
<div class="tn-gnavsub">
<div class="gnavsub">
<ul class="clearfix">
<?php echo li_country(); ?>
</ul>
</div>
</div>
</li>
<li> <a href="/dien-anh.html" onclick="hdoTrackEvent('Điện ảnh','NewsPostTopMenu', 'Click nâng cấp Điện Ảnh Menu')"> <span class="tnico-news"></span> TIN TỨC </a>
 
<li> <a href="#" onclick="javascript:void(0)"> <span class="tnico-more"></span> MORE </a>
<div class="tn-gnavsub">
<div class="gnavsub">
<ul class="clearfix">
<li><a href="/danh-sach/phim-moi.html">Phim Mới</a></li>
<li><a href="/danh-sach/phim-chieu-rap.html">Phim Chiếu Rạp</a></li>
<li><a href="/hdo-de-cu.html">Phim Đề Cử</a></li>
<li><a href="/danh-sach/phim-trailer.html">Trailer Phim Mới</a></li>
<li><a href="/phim-long-tieng.html">Phim Lồng Tiếng</a></li>
<li><a href="/phim-thuyet-minh.html">Phim Thuyết Minh</a></li>
 
<li><a href="javascript:void(0)" onclick="mAlert('Tính năng sắp ra mắt')">Bảng Xếp Hạng</a></li>
<li><a href="javascript:void(0)" onclick="mAlert('Tính năng sắp ra mắt')">Real-time</a></li>
<li><a href="<?php echo get_url(0,'Phim năm 2015','Danh sách');?>">Phim 2015</a></li>
<li><a href="<?php echo get_url(0,'Phim năm 2014','Danh sách');?>">Phim 2014</a></li>
<li><a href="<?php echo get_url(0,'Phim năm 2013','Danh sách');?>">Phim 2013</a></li>
<li><a href="<?php echo get_url(0,'Phim năm 2012','Danh sách');?>">Phim 2012</a></li>
<li><a href="<?php echo get_url(0,'Phim năm 2011','Danh sách');?>">Phim 2011</a></li>
<li><a href="<?php echo get_url(0,'Phim năm 2010','Danh sách');?>">Phim 2010</a></li>
</ul>
</div>
</div>
</li>
</ul>
</nav> 
<div class="tn-notif">
<ul class="clearfix">
<li class="wrap-search-input" style="margin-top: 0px">
<input id="searchtop-input" type="text" class="form-control" placeholder="Tìm: Phim, Đạo diễn, Diễn viên...">
</li>
<li class="dropdown menuNoelColor">
<?php echo user_menu();?>

</li>
</ul>
</div>
<style>#user-message-area,#user-notification-area{padding-top:0px;padding-bottom:0px;}#user-message-area li,#user-notification-area li{padding-top:5px;padding-bottom:10px;margin-top:0px;}#user-message-area li:hover,#user-message-area li.unread,#user-notification-area li:hover{cursor:pointer;background-color:#F7F5F5;}</style>
</div>
</header>
<div class="tn-main-full">

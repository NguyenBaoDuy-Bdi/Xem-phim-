<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('functions');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="initial-scale=1.0, width=device-width" name="viewport">
<title><?php echo $site_title;?></title>
<base href="<?php echo SITE_URL; ?>/" />
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="format-detection" content="telephone=no">
<meta name="title" content="Xem phim online chất lượng cao">
<meta name="description" content="Xem phim HD online chất lượng cao và miễn phí chỉ có tại HayphimTV. Xem phim online với nhiều thể loại phim mới nhất và được cập nhật liên tục với chất lượng HD">
<meta name="keywords" content="Phim, xem phim, xem phim online, phim online, xem phim hd, phim hd, xem phim hd online, xem phim hay, phim hay, phim hd hay, phim online hay, xem, phim">
<meta name="ROBOTS" content="noindex, follow">
<meta property="fb:app_id" content="1679493742267094"/>
<meta property="fb:admins" content="100004932183117">
<meta name="theme-color" content="#4caf50">
<link rel="manifest" href="manifest.json">
<link href='//fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'/>
<link href="<?php echo TEMPLATE_M_URL;?>skin/material/css/base.css?v=021" rel="stylesheet">
<link href="<?php echo TEMPLATE_M_URL;?>skin/material/css/custome.css?v=030" rel="stylesheet">
<link rel="stylesheet" href="<?php echo TEMPLATE_M_URL;?>skin/material/css/mediaelementplayer.min.css?v=04"/>
<script type="text/javascript">
		var base_url ="<?=SITE_URL?>/";
		var tpl_url  = "<?php echo TEMPLATE_M_URL;?>";
	</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_M_URL;?>skin/material/js/mediaelement-and-player.js?v=03"></script>
<script src="<?php echo TEMPLATE_M_URL;?>skin/material/js/mep-feature-qualities.js" type="text/javascript"></script>
<script src="<?php echo TEMPLATE_M_URL;?>skin/material/js/jRate.min.js" type="text/javascript"></script>
<script>
		 
		
		function loadMoreNews(idData){
			var $el, $ps, $up;
			$el = $("#" + idData);
			$up = $el.parent();
			$el.css({"max-height": "none"});
			$up.css({"height": "auto", "max-height": "none"});
			$("#" + idData + " .read-more").fadeOut();
			
			return false;
		};
		
	</script>
<style>.subtitle{font-size:12px;font-style:normal;display:block;margin-top:-5px;color:#e34e47;}.card-heading{margin-top:5px!important;font-size:25px;}.card-category{margin:0px;margin-top:-20px;font-size:14px;}.card-view{margin-top:-20px;color:#A0C7A8;}.card-info{font-size:15px;}.card-wrap{margin-top:0px;}.pagination_list{text-align:center;}.share-bottom{position:fixed;left:0px;bottom:0px;line-height:50px;text-align:center;width:100%;font-size:14px;font-weight:300;color:#000;z-index:9;margin:0px auto;height:0px;margin-bottom:75px;}.share-bottom .buttom-share{width:50px;height:50px;margin:5px;margin-bottom:15px;display:inline-block;-webkit-border-radius:25px;border-radius:25px;line-height:50px;text-align:center;color:#fff;}.share-bottom .buttom-share .fa{margin-top:20px;}.share-facebook{background-color:#3c599b;}.share-google{background-color:#dd4b39;}.ads_right div,.comment_facebook span{margin:0px auto;display:block!important;}.container{margin-top:10px;}@media only screen and (max-width: 520px) {.card-inner p{margin-top:0px;margin-bottom:5px;}.card-heading{font-size:17px;}.row{margin-bottom:-10px;}}.thumb-post-center{text-align:center;width:100%;display:block;}.thumb-post-center img{max-width:100%!important;}.line-break{border-bottom:2px solid #ccc;margin-top:20px;}.ajax-max-height{max-height:700px;position:relative;overflow:hidden;}.ajax-max-height .read-more{position:absolute;bottom:0;left:0;width:100%;text-align:center;padding:30px 0px 0px 0px;background-image:-moz-linear-gradient(top,transparent,#fff);background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0,transparent),color-stop(1,#fff));z-index:1000;vertical-align:bottom;height:170px;line-height:219px;}.button-read-more{padding:10px 24px;background-color:rgba(255,255,255,0.64);border-radius:5px;color:#000;font-weight:bold;cursor:pointer;text-decoration:none;bottom:10px;width:250px;max-width:90%;border:2px solid #ccc;}.button-read-more:hover{text-decoration:none;background-color:#ccc;border:2px solid #ccc;color:#000;}.avatar-group{display:inline-block;width:50px;vertical-align:top;}.card-group-title{display:inline-block;width:calc(100% - 60px);}.card-group-title .card-heading,.card-group-title .card-heading a,.card-heading-title-new,.card-heading-title-new a{font-size:1.3em;color:#000;margin-bottom:0px;padding-bottom:0px;}.card-group-title .card-by{font-weight:bold;margin-top:5px;padding-top:0px;}.relate-block-list .card-group-title,.relate-block-list .card-group-title .card-heading,.relate-block-list .card-group-title .card-heading a{font-size:1em;width:100%;}</style>

</head>

<body class="avoid-fout">
<header class="header">
<ul class="nav nav-list " style="width: 100%;">
<li style="width:15%" class="">
<a data-toggle="menu" href="#menu">
<span class="fa fa-bars"></span>
</a>
</li>
<li style="width: 70%;">
<center><a href="/" style="padding: 0px;"><img src="/assets/images/logo-black.png" style="width: 100px;padding-top:15px"></a></center>
</li>
<li style="width: 15%;" class="">
<a data-toggle="menu" href="#profile" class="pull-right">
<span class="avatar avatar-sm"><img alt="alt text for John Smith avatar" src="http://m.hdonline.vn/skin/material/avatar-001.jpg"></span>
</a>
<div class="div-button-search">
<a href="javascript:openSeach()" class="div-button-search-a"><i class="fa fa-search"></i></a>
</div>
</li>
</ul>
<div class="form-search-menu">
<form method="post" onsubmit="search_page();return false;">
<div class="form-group form-group-label" style="margin:0px;position:relative">
<input class="form-control" id="search-input" type="text">
<a href="javascript:void(0)" onclick="search_page();return false;" class="btn btn-alt btn-full-search"><i class="fa fa-search"></i></a>
<a href="javascript:void(0)" class="btn btn-red btn-close-search"><i class="fa fa-times"></i></a>
</div>
</form>
</div>
</header>
<div id="search-hover" style="position: fixed; z-index: 31;top: 47px;margin-left: 5px;margin-right: 5px;width:100%">
</div>
<script>
		
		var instantSearch; 
		function openSeach(){
			$(".form-search-menu").show();
			$("#search-input").focus();
		}
		function callSearch(){
			
			if ($("#search-input").val() != ""){
				$.ajax({
				  url: "<?=SITE_URL?>/search.php?searchinstant=" + $("#search-input").val(),
				})
				  .done(function( data ) {
					$("#search-hover").html(data);
					$("#search-hover").show();
				  });
				
			} else {
				$("#search-hover").hide();
			}
				
		}
		$(document).ready(function(){
			$("#search-input").on( "keyup", function(){
				clearTimeout(instantSearch);
				instantSearch = setTimeout(function(){
					callSearch();
				}, 300);
			});
			
			$(window).click(function(e){
				if ($(e.target).attr('id') == "search-input"){
					return;
				}
			});
			$(".btn-close-search").click(function(){
				$("#search-hover, .form-search-menu").hide();
				$("#search-input").val('');
			});
		});
	</script>
<nav class="menu" id="menu">
<div class="menu-scroll">
<div class="menu-top" style="background-color: #4B644C;">
<div style="padding: 10px 0px;">
<a class="menu-top-user" href="javascript:void(0)">
<img alt="xem phim hdonline" style="margin: 10px auto;" src="/assets/images/logo-black.png">
</a>
</div>
</div>
<div class="menu-wrap" style="top:100px;">
<div class="menu-content">
<ul class="nav" style="">
<li><a href="<?=SITE_URL?>/" title="Trang Chủ"><i class="fa fa-home"></i>Trang chủ</a></li>
<hr>

<li>
<a href="<?php echo get_url(0,'Phim mới','Danh sách');?>"><i class="fa fa-film"></i>Phim Mới</a>
<span class="menu-collapse-toggle collapsed" data-target="#menu-list-year" data-toggle="collapse" aria-expanded="false">
<i class="fa fa-ellipsis-h menu-collapse-toggle-close"></i>
<i class="fa fa-ellipsis-v menu-collapse-toggle-default"></i>
</span>
<ul class="menu-collapse collapse" id="menu-list-year" aria-expanded="false" style="height: 0px;">
<li><a href="<?php echo get_url(0,'Phim năm 2016','Danh sách');?>" title="Phim sản xuất năm 2016"><i class="icon fade">theaters</i>Phim 2016</a></li>
<li><a href="<?php echo get_url(0,'Phim năm 2015','Danh sách');?>" title="Phim sản xuất năm 2015"><i class="icon fade">theaters</i>Phim 2015</a></li>
<li><a href="<?php echo get_url(0,'Phim năm 2014','Danh sách');?>" title="Phim sản xuất năm 2014"><i class="icon fade">theaters</i>Phim 2014</a></li>
<li><a href="<?php echo get_url(0,'Phim năm 2013','Danh sách');?>" title="Phim sản xuất năm 2013"><i class="icon fade">theaters</i>Phim 2013</a></li>
<li><a href="<?php echo get_url(0,'Phim năm 2012','Danh sách');?>" title="Phim sản xuất năm 2012"><i class="icon fade">theaters</i>Phim 2012</a></li>
<li><a href="<?php echo get_url(0,'Phim năm 2011','Danh sách');?>" title="Phim sản xuất năm 2011"><i class="icon fade">theaters</i>Phim 2011</a></li>
<li><a href="<?php echo get_url(0,'Phim năm 2010','Danh sách');?>" title="Phim sản xuất năm 2010"><i class="icon fade">theaters</i>Phim 2010</a></li>
</ul>
</li>
<li><a href="<?=SITE_URL?>/danh-sach/phim-thanh-vien/" title="Phim thành viên đóng góp"><i class="fa fa-film"></i>Film's Member</a></li>
<li>
<a href="<?php echo get_url(0,'Phim lẻ','Danh sách');?>"><i class="fa fa-film"></i>Phim Lẻ</a>
<span class="menu-collapse-toggle collapsed" data-target="#menu-list-le" data-toggle="collapse" aria-expanded="false">
<i class="fa fa-ellipsis-h menu-collapse-toggle-close"></i>
<i class="fa fa-ellipsis-v menu-collapse-toggle-default"></i>
</span>
<ul>
<?php echo li_category(); ?>
</ul>
</li>
<li>
<a href="<?php echo get_url(0,'Phim bộ','Danh sách');?>"><i class="fa fa-film"></i>Phim Bộ</a>
<span class="menu-collapse-toggle collapsed" data-target="#menu-list-bo" data-toggle="collapse" aria-expanded="false">
<i class="fa fa-ellipsis-h menu-collapse-toggle-close"></i>
<i class="fa fa-ellipsis-v menu-collapse-toggle-default"></i>
</span>
<ul>
<?php echo li_country(); ?>
</ul>
</li>

<hr>
<ul class="nav" style="">
<li><a href="<?=SITE_URL?>" title="Phiên bản Web"><i class="fa fa-television"></i>Phiên bản Desktop</a></li>
<hr>
</div>
</div>
</div>
</nav>
<nav class="menu menu-right" id="profile">
<div class="menu-scroll">
<div class="menu-wrap">
<div class="menu-top">
<div class="menu-top-img">
<img alt="John Smith" src="http://m.hdonline.vn/skin/material/images/samples/landscape.jpg">
</div>
<div class="menu-top-info">
<a class="menu-top-user" href="javascript:void(0)"><span class="avatar pull-left">
<img alt="" src="http://m.hdonline.vn/skin/material/images/users/avatar-001.jpg"></span>Guest!</a>
</div>
</div>
<div class="menu-content">
<ul class="nav">
<li>
<a href="<?=SITE_URL?>/thanh-vien/dang-nhap.html"><i class="fa fa-sign-in"></i> Đăng Nhập</a>
</li>
<li>
<a href="<?=SITE_URL?>/dang-ky.html"><i class="fa fa-user-plus"></i> Đăng Ký</a>
</li>
</ul>
</div>
</div>
</div>
</nav>
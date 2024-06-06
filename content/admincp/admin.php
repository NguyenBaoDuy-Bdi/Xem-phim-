<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::AdminView('functions');
if(!IS_ADMIN) include View::AdminView('login');
else { 
$Adminid = $_SESSION["RK_Adminid"];
$Admingroup = $_SESSION["RK_Admingroup"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Hệ thống</title>
<base href="<?php echo SITE_URL.'/'.ADMINCP_NAME.'/'?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<link href="<?php echo ADMINCP_URL;?>css/bootstrap.min.css" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/bootstrap-responsive.min.css" rel="stylesheet"/>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/font-awesome.min.css" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>/css/ui-lightness/jquery-ui-1.10.0.custom.min.css" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/base-admin-2.css" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/base-admin-2-responsive.css" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/pages/dashboard.css" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/custom.css" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>js/plugins/msgGrowl/css/msgGrowl.css" rel="stylesheet" />
<link href="<?php echo ADMINCP_URL;?>js/plugins/lightbox/themes/evolution-dark/jquery.lightbox.css" rel="stylesheet" />	
<link href="<?php echo ADMINCP_URL;?>js/plugins/msgbox/jquery.msgbox.css" rel="stylesheet" />	
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="<?php echo ADMINCP_URL;?>js/libs/jquery-1.8.3.min.js"></script>
<script src="<?php echo ADMINCP_URL;?>js/libs/jquery-ui-1.10.0.custom.min.js"></script>
<script src="<?php echo ADMINCP_URL;?>js/libs/bootstrap.min.js"></script>
<script src="<?php echo ADMINCP_URL;?>js/plugins/msgGrowl/js/msgGrowl.js"></script>
<script src="<?php echo ADMINCP_URL;?>js/plugins/lightbox/jquery.lightbox.min.js"></script>
<script src="<?php echo ADMINCP_URL;?>js/plugins/msgbox/jquery.msgbox.min.js"></script>
<script src="<?php echo ADMINCP_URL;?>js/Application.js"></script>
<script src="<?php echo ADMINCP_URL;?>/ckeditor/ckeditor.js"></script>
<script src="<?php echo ADMINCP_URL;?>/ckeditor/adapters/jquery.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<i class="icon-cog"></i>
			</a>
			<a class="brand" href="<?php echo SITE_URL.'/'.ADMINCP_NAME.'/';?>">
			Admin Panel GLAphimTV<sup>3.0</sup>
			</a>
			<div class="nav-collapse collapse">
				<ul class="nav pull-right">
					<li class="dropdown">
						<a href="?action=config"><i class="icon-cog"></i>Cài đặt</a>
					</li>
					<?php echo user_menu();?>
				</ul>
				<form class="navbar-search pull-right" method="get"/>
					<input type="hidden"name="action" value="film"/>
					<input type="text" class="search-query" name="search" placeholder="Tìm kiếm phim"/>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="subnavbar">
	<div class="subnavbar-inner">
		<div class="container">
			<a class="btn-subnavbar collapsed" data-toggle="collapse" data-target=".subnav-collapse">
			<i class="icon-reorder"></i>
			</a>
			<div class="subnav-collapse collapse">
				<ul class="mainnav">
					<li>
					<a href="<?php echo SITE_URL.'/'.ADMINCP_NAME.'/';?>">
					<i class="icon-home"></i>
					<span>Trang chủ </span>
					</a>
					</li>
					<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-th"></i>
					<span>Danh mục </span>
					<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li class="dropdown-submenu">
						<a tabindex="-1" href="?action=film">Phim</a>
						<ul class="dropdown-menu">
							<li><a tabindex="-1" href="?action=film&mode=add">Thêm phim</a></li>
                                                        <li><a tabindex="-1" href="?action=grabfilm">Grab Phim</a></li>
							<li><a tabindex="-1" href="?action=grabzingtv">Grab Chap ZingTv</a></li>
							<li><a tabindex="-1" href="?action=grabclipvn">Grab Chap Phim.Clip.Vn</a></li>
							<li><a tabindex="-1" href="?action=film&mode=phimle">Phim lẻ</a></li>
							<li><a tabindex="-1" href="?action=film&mode=phimbo">Phim bộ đã hoàn thành</a></li>
							<li><a tabindex="-1" href="?action=film&mode=phimbochuahoanthanh">Phim bộ chưa hoàn thành</a></li>
							<li><a tabindex="-1" href="?action=film&mode=trailer">Phim Trailer</a></li>
							<li><a tabindex="-1" href="?action=film&mode=film_member">Phim thành viên đăng</a></li>
							<li><a tabindex="-1" href="?action=film&mode=decu">Phim đề cử</a></li>
							<li><a tabindex="-1" href="?action=film&mode=slider">Phim slider</a></li>
							<li><a tabindex="-1" href="?action=film&mode=bigthumb">Phim có ảnh lớn</a></li>
							<li><a tabindex="-1" href="?action=film&mode=error">Phim bị lỗi</a></li>
						</ul>
						</li>
                                                <li class="dropdown-submenu">
						<a tabindex="-1" href="?action=media">Video</a>
						<ul class="dropdown-menu">
							<li><a tabindex="-1" href="?action=media&mode=add">Thêm video</a></li>
							<li><a tabindex="-1" href="?action=media">Danh sách video</a></li>
							<li><a tabindex="-1" href="?action=media&mode=slide">Video trên slide</a></li>
						</ul>
						</li>
						<li class="dropdown-submenu">
						<a tabindex="-1" href="?action=tv">Live TV</a>
						<ul class="dropdown-menu">
							<li><a tabindex="-1" href="?action=tv&mode=add">Thêm kênh</a></li>
							<li><a tabindex="-1" href="?action=tv">Danh sách kênh</a></li>
						</ul>
						</li>
						<li><a href="?action=category">Thể loại</a></li>
						<li><a href="?action=country">Quốc gia</a></li>
					</ul>
					</li>
<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-copy"></i>
					<span>Bài viết </span>
					<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="?action=news&mode=add">Thêm bài viết</a></li>
						<li><a href="?action=news">Danh sách bài viết</a></li>
					</ul>
					</li>
					<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-external-link"></i>
					<span>Khác </span>
					<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="?action=actor">Đạo diễn & Diễn viên</a></li>
						<li><a href="?action=user">Thành viên</a></li>
						<li><a href="?action=log">Quản lý yêu cầu</a></li>
						<li><a href="?action=config">Cài đặt</a></li>
						<li><a href="?action=config_other">Cài đặt nâng cao</a></li>
						<li><a href="?action=resetview">Reset lượt xem</a></li>
						<li><a href="?action=cache">Xóa Cache</a></li>
					</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php
	parse_str(parse_url(Url::curRequestURL(),PHP_URL_QUERY), $RK);
	$action = $RK['action'];
	$filmid = $RK['filmid'];
	$epid = $RK['epid'];
	$mediaid = $RK['mediaid'];
	$userid = $RK['userid'];
	$groupid = $RK['groupid'];
	$mode = $RK['mode'];
	$page = $RK['page'];
	$search = $RK['search'];
	$page = $RK['page'];
	$cid = $RK['cid'];
	switch ($action) {
		case 'film':
			include View::AdminView('admin_code/film');
			break;
                case 'grabfilm':
			include View::AdminView('admin_code/grabfilm');
			break;
		case 'grabzingtv':
			include View::AdminView('admin_code/grabzingtv');
			break;
		case 'grabclipvn':
			include View::AdminView('admin_code/grabclipvn');
			break;	
		case 'episode':
			include View::AdminView('admin_code/episode');
			break;
		case 'multi-episode':
			include View::AdminView('admin_code/multi_episode');
			break;
		case 'user':
			include View::AdminView('admin_code/user');
			break;
		case 'category':
			include View::AdminView('admin_code/category');
			break;
		case 'country':
			include View::AdminView('admin_code/country');
			break;
		case 'config':
			include View::AdminView('admin_code/config');
			break;
		case 'config_other':
			include View::AdminView('admin_code/config_other');
			break;
		case 'hotmenu':
			include View::AdminView('admin_code/hotmenu');
			break;
		case 'media':
			include View::AdminView('admin_code/media');
			break;
		case 'news':
			include View::AdminView('admin_code/news');
			break;
		case 'actor':
			include View::AdminView('admin_code/actor');
			break;
		case 'log':
			include View::AdminView('admin_code/log');
			break;
		case 'cache':
			include View::AdminView('admin_code/cache');
			break;
		case 'tv':
			include View::AdminView('admin_code/tv');
			break;
		case 'resetview':
			include View::AdminView('admin_code/resetview');
			break;
		case 'logout':
			if(LoginAuth::logoutAdmin() == 1) header('Location: '.SITE_URL.'/'.ADMINCP_NAME);
			break;
		default:
			include View::AdminView('home');
	}
?>
<div class="footer">
	<div class="container">
		<div class="row">
			<div id="footer-copyright" class="span6">
		
			</div>
			<div id="footer-terms" class="span6">
				 Design And Coder by <a href="http://facebook.com/pibanh96" target="_blank">DuyKhang</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php
}
?>
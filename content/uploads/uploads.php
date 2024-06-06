<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::UploadView('functions');
if(!IS_UPLOADER) include View::UploadView('login');
else { 
$Uploadid = $_SESSION["RK_Uploadid"];
$Uploadgroup = $_SESSION["RK_Uploadgroup"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Hệ thống Upload Phim Member</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<link href="<?php echo MEMUPLOAD_URL;?>css/bootstrap.min.css" rel="stylesheet"/>
<link href="<?php echo MEMUPLOAD_URL;?>css/bootstrap-responsive.min.css" rel="stylesheet"/>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet"/>
<link href="<?php echo MEMUPLOAD_URL;?>css/font-awesome.min.css" rel="stylesheet"/>
<link href="<?php echo MEMUPLOAD_URL;?>/css/ui-lightness/jquery-ui-1.10.0.custom.min.css" rel="stylesheet"/>
<link href="<?php echo MEMUPLOAD_URL;?>css/base-admin-2.css" rel="stylesheet"/>
<link href="<?php echo MEMUPLOAD_URL;?>css/base-admin-2-responsive.css" rel="stylesheet"/>
<link href="<?php echo MEMUPLOAD_URL;?>css/pages/dashboard.css" rel="stylesheet"/>
<link href="<?php echo MEMUPLOAD_URL;?>css/custom.css" rel="stylesheet"/>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="<?php echo MEMUPLOAD_URL;?>js/libs/jquery-1.8.3.min.js"></script>
<script src="<?php echo MEMUPLOAD_URL;?>js/libs/jquery-ui-1.10.0.custom.min.js"></script>
<script src="<?php echo MEMUPLOAD_URL;?>js/libs/bootstrap.min.js"></script>
<script src="<?php echo ADMINCP_URL;?>/ckeditor/ckeditor.js"></script>
<script src="<?php echo MEMUPLOAD_URL;?>ckeditor/adapters/jquery.js"></script>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<i class="icon-cog"></i>
			</a>
			<a class="brand" href="<?php echo SITE_URL.'/'.MEMBER_UPLOAD;?>/">
			HayPhimTV <sup>1.0</sup>
			</a>
			<div class="nav-collapse collapse">
				<ul class="nav pull-right">
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
					<a href="<?php echo SITE_URL.'/'.MEMBER_UPLOAD;?>/">
					<i class="icon-home"></i>
					<span>Trang chủ </span>
					</a>
					</li>
					<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-th"></i>
					<span>Phim </span>
					<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
		
						<li><a href="?action=film&mode=film">Danh sách</a></li>
						<li><a href="?action=film&mode=add">Thêm mới</a></li>
						
					</ul>
					</li>
					<li>
					<a target="_blank" href="<?=SITE_URL?>/post/huong-dan-kiem-tien/">
					<i class="icon-money"></i>
					<span>Hướng dẫn đăng phim </span>
					</a>
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
			include View::UploadView('php_code/film');
			break;
		case 'grabfilm':
			include View::UploadView('php_code/grabfilm');
			break;
		case 'episode':
			include View::UploadView('php_code/episode');
			break;
		case 'multi-episode':
			include View::UploadView('php_code/multi_episode');
			break;
		case 'actor':
			include View::UploadView('php_code/actor');
			break;		
		case 'logout':
			if(LoginAuth::logoutUpload() == 1) header('Location: '.SITE_URL.'/'.MEMBER_UPLOAD.'/');
			break;
		default:
			include View::UploadView('home');
	}
?>
<div class="footer">
	<div class="container">
		<div class="row">
			<div id="footer-copyright" class="span6">
				 &copy; 2015
			</div>
			<div id="footer-terms" class="span6">				 
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php
}
?>
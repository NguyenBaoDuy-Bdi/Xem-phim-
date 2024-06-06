<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
$err = 'Đăng nhập vào hệ thống Upload phim';
if($_POST['submit']) {
	$err = LoginAuth::loginUpload($_POST['username'],$_POST['password']);
	if($err == 'user') $err = 'Sai tên đăng nhập hoặc tài khoản không được phép sử dụng ở đây';
	else if($err == 'pass') $err = 'Sai mật khẩu';
	else header('Location: '.SITE_URL.'/'.MEMBER_UPLOAD.'/');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Đăng nhập</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<link href="<?php echo ADMINCP_URL;?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ADMINCP_URL;?>css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ADMINCP_URL;?>css/font-awesome.min.css" rel="stylesheet"/>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/ui-lightness/jquery-ui-1.10.0.custom.min.css" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/base-admin-2.css" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/base-admin-2-responsive.css" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/pages/signin.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ADMINCP_URL;?>css/custom.css" rel="stylesheet"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<i class="icon-cog"></i>
			</a>
			<a class="brand" href="<?php echo SITE_URL.'/'.ADMINCP_NAME;?>">
			HayPhimTV <sup>1.0</sup>
			</a>
			<div class="nav-collapse">
				<ul class="nav pull-right">
					<li class="">
					<a href="<?php echo SITE_URL;?>" class="">
					<i class="icon-chevron-left"></i>
					Trang chủ </a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="account-container stacked">
	<div class="content clearfix">
		<form method="post"/>
			<h1>Đăng nhập</h1>
			<div class="login-fields">
				<p>
					<?php echo $err;?>
				</p>
				<div class="field">
					<label for="username">Tên đăng nhập:</label>
					<input type="text" id="username" name="username" value="" placeholder="Tên đăng nhập" class="login username-field"/>
				</div>
				<div class="field">
					<label for="password">Mật khẩu:</label>
					<input type="password" id="password" name="password" value="" placeholder="Mật khẩu" class="login password-field"/>
				</div>
			</div>
			<div class="login-actions">
				<button class="button btn btn-warning btn-large" name="submit" value="submit">Đăng nhập</button>
			</div>
		</form>
	</div>
</div>
<script src="<?php echo ADMINCP_URL;?>js/libs/jquery-1.8.3.min.js"></script>
<script src="<?php echo ADMINCP_URL;?>js/libs/jquery-ui-1.10.0.custom.min.js"></script>
<script src="<?php echo ADMINCP_URL;?>js/libs/bootstrap.min.js"></script>
<script src="<?php echo ADMINCP_URL;?>js/Application.js"></script>
<script src="<?php echo ADMINCP_URL;?>js/signin.js"></script>
</body>
</html>

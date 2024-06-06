<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
?>
<!doctype html>
<html lang="vi" itemscope="itemscope" itemtype="http://schema.org/WebPage">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $site_title;?></title>
	<meta name="keywords" content="<?php echo $site_keywords;?>" />
	<meta name="description" content="<?php echo $site_description;?>" />
	<base href="<?php echo SITE_URL; ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>css/reset.css">
	<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL;?>css/hdo.css">
	<link rel="shortcut icon" href="<?php echo TEMPLATE_URL;?>images/favicon.ico" type="image/x-icon"/>
	<div id="fb-root"></div>
<head>
<body>
<span style="position:absolute">xem phim hd</span>
<div id="wrapper">
	<div class="p404">
		<div class="wap">
			<div class="content">
				<h1>OPPS!Lỗi</h1>
				<span class="tit">Trang bạn tìm không có. Hãy thử lại</span>
				<span class="tit2">Có thể bạn gõ sai đường dẫn hoặc sai từ khóa tìm kiếm. Hãy sử dụng tính năng tìm kiếm trên website để tìm chính xác bộ phim bạn cần tìm. Nếu vẫn xảy ra lỗi. Hãy liên hệ để được hỗ trợ.</span>
				<a class="back" href="<?php echo SITE_URL; ?>">Trang chủ</a>
				<?php header("Location: ".SITE_URL);?>
			</div>
		</div>
	</div>
</div>
</div>
</body>
</html>
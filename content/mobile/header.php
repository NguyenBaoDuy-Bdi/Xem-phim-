<?php
require_once("security.php"); 
header('Content-type: text/html; charset=UTF-8');
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('functions');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title><?php echo $site_title;?></title>
	<meta name="keywords" content="<?php echo $site_keywords;?>" />
	<meta name="description" content="<?php echo $site_description;?>" />
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="1 days">
	<meta charset="utf-8">
	<meta name="google-site-verification" content="prtFNNYe8r1XehhrhfwnhxSxokAB-NQV9reLxDur-0g" />
	<meta name="clickadu" content="b5f6a9fb44b1e4cf78cfe2a42addd20f" />
	<link rel="Shortcut Icon" type="image/ico" href="/favicon.ico" />
	<link rel="alternate" type="application/rss+xml" title="Rss Feed" href="<?php echo SITE_URL.'/rss/';?>">
	<meta property="og:title" content="<?php echo $site_title;?>">
	<meta property="og:description" content="<?php echo $site_description;?>">
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?php echo SITE_URL.$cururl;?>">
	<meta property="fb:app_id" content="803198449807533"/>
	<meta property="fb:admins" content="100011040966196">
	<?php echo $other_meta;?>
	<base href="<?php echo SITE_URL; ?>/" />
	<script>var base_url = '<?php echo SITE_URL;?>/';</script>
	<link rel="stylesheet" href="<?php echo SITE_URL;?>/assets/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo SITE_URL;?>/assets/css/main.css?v=2.8" type="text/css" />
	<link rel="stylesheet" href="<?php echo SITE_URL;?>/assets/css/jquery.cluetip.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo SITE_URL;?>/assets/css/jquery.qtip.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo SITE_URL;?>/assets/css/custom.css?v=1.0" type="text/css" />
	<link rel="stylesheet" href="<?php echo SITE_URL;?>/assets/css/slide.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo SITE_URL;?>/assets/css/psbar.css" type="text/css" />
	<script type="text/javascript" src="<?php echo SITE_URL;?>/assets/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL;?>/assets/js/jquery.lazyload.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL;?>/assets/js/jquery.qtip.min.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL;?>/assets/js/jquery.cookie.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL;?>/assets/js/hayphim.min.js"></script>
	<?php if($mode=='phim' || $mode=='xem-phim'){?>
	<link rel="stylesheet" href="<?php echo SITE_URL;?>/assets/css/star-rating.css" type="text/css" />
	<script type="text/javascript" src="<?php echo SITE_URL;?>/assets/js/psbar.jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL;?>/assets/js/star-rating.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL;?>/assets/js/jquery.smooth-scroll.min.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL;?>/assets/js/jquery.slimscroll.min.js"></script>
	<?}?>

</head>
<body>

<!--header-->
<header>

    <div class="container">
        <div class="header-logo">
            <h1>
                <a title="Phim Hay | Phim hd" href="<?=SITE_URL?>/" id="logo">Phim Hay | Phim hd</a>
            </h1>
        </div>
        <div class="mobile-menu"><i class="fa fa-reorder"></i></div>
        <div class="mobile-search"><i class="fa fa-search"></i></div>
        <div id="menu">
            <ul class="top-menu">
                <li class="">
                    <a href="<?=SITE_URL?>/" title="Home">HOME</a>
                </li>
				<li class="">
                    <a href="<?php echo get_url(0,'Phim lẻ','Danh sách');?>" title="Phim le hay">THÊ LOAI</a>

                    <div class="sub-container" style="display: none">
                        <ul class="sub-menu">
                                 <?php echo li_category(); ?>
                            </ul>
                        <div class="clearfix"></div>
                    </div>
                </li>
                <li class="">
                    <a href="<?php echo get_url(0,'Phim bộ','Danh sách');?>" title="Phim bo hay">QUÔC GIA</a>

                    <div class="sub-container" style="display: none">
                        <ul class="sub-menu">
                                 <?php echo li_country(); ?> 
						</ul>
                        <div class="clearfix"></div>
                    </div>
                </li>
				<li>
                    <a href="<?php echo SITE_URL;?>/the-loai/trailer-phim-moi/" title="Video">TRAILER</a>
                </li>
                <li>
                    <a href="<?php echo SITE_URL;?>/video" title="Video">VIDEO</a>
                </li>
                <li class="">
                    <a href="<?php echo SITE_URL;?>/danh-sach/phim-thanh-vien/" title="Phim do thành viên upload">FILM'S MEMBER</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div id="top-user">

        </div>
        <div id="search">
            <div class="search-content">

				<input autocomplete="off" name="keyword" type="text" class="form-control search-input"
                       placeholder="Tìm kiếm..."/>
                <a onclick="searchMovie()" class="search-submit" href="javascript:void(0)" title="Search"><i
                        class="fa fa-search"></i></a>

                <div class="search-suggest" style="display: none;"></div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</header>
<script type="text/javascript">
    var hidden = true;
    $('.search-suggest').mouseover(function () {
        hidden = false;
    });

    $('.search-suggest').mouseout(function () {
        hidden = true;
    });

    /*$('input[name=keyword]').keyup(function () {
        var keyword = $(this).val();
        if (keyword.trim().length > 2) {
            $.ajax({
                url: base_url + 'ajax/suggest_search',
                type: 'POST',
                dataType: 'json',
                data: {keyword: keyword},
                success: function (data) {
                    $('.search-suggest').html(data.content);
                    if (data.content.trim() !== '') {
                        $('.search-suggest').show();
                    } else {
                        $('.search-suggest').hide();
                    }
                }
            })
        } else {
            $('.search-suggest').hide();
        }
    });
    $('input[name=keyword]').blur(function () {
        if (hidden) {
            $('.search-suggest').hide();
        }
    });
    $('input[name=keyword]').focus(function () {
        if ($('.search-suggest').html() !== '') {
            $('.search-suggest').show();
        }
    });*/

    $('input[name=keyword]').keypress(function (event) {
        if (event.which == 13) {
            searchMovie();
        }
    });

    function searchMovie() {
        var keyword = $('input[name=keyword]').val();
        if (keyword.trim() !== '') {
            keyword = keyword.replace(/(<([^>]+)>)/ig, "").replace(/[`~!@#$%^&*()_|\=?;:'",.<>\{\}\[\]\\\/]/gi, "");
            keyword = keyword.split(" ").join("+");
            window.location.href = base_url + 'search/' + keyword + '/';
        }
    }
</script>
<!--/header-->
<div class="header-pad"></div>
<!-- main -->
<div id="main" <?php if($mode=='phim' || $mode=='xem-phim' || $mode=='xem-video'){ echo ' class="page-detail"';}elseif($mode=='user'){ echo 'class="page-detail page-profiles"';}?>>
    <div class="container">

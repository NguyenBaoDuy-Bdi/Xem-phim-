<?php
header('Content-type: text/html; charset=UTF-8');
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('functions');
?>
<!doctype html><html lang="vi" itemscope="itemscope" itemtype="http://schema.org/WebPage" class=" desktop portrait">
<head>
	<title><?php echo $site_title;?></title>
	<meta name="keywords" content="<?php echo $site_keywords;?>" />
	<meta name="description" content="<?php echo $site_description;?>" />
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="1 days">
	<meta charset="utf-8">
	<link rel="alternate" type="application/rss+xml" title="Rss Feed" href="<?php echo SITE_URL.'/rss/';?>">
	<meta property="og:title" content="<?php echo $site_title;?>">
	<meta property="og:description" content="<?php echo $site_description;?>">
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?php echo SITE_URL.$cururl;?>">
	<meta property="fb:app_id" content="803198449807533"/>
	<meta property="fb:admins" content="100011040966196">
	<base href="<?php echo SITE_URL; ?>" />

    <script type="text/javascript">var base_url = '<?php echo SITE_URL; ?>';</script>
	<link rel="shortcut icon" type="image/png" href="<?php echo SITE_URL;?>/assets/img/favicon.png">  
    <link href="<?php echo SITE_URL;?>/css/bootstrap.min.css,jquery.mCustomScrollbar.css,app1.css,style.css,jquery.bxslider.css" rel="stylesheet">  
    <link rel="stylesheet" href="<?php echo SITE_URL;?>/assets/css/app.css"> 

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.0/jquery.qtip.min.js"></script>
<script src="<?php echo SITE_URL;?>/javascript/bootstrap.min.js,jquery.mCustomScrollbar.concat.min.js,imagesloaded.pkgd.min.js,jquery.lazy.min.js,jquery.hoverIntent.min.js,jquery.cluetip.min.js"></script>
<style>
.qtip {
    display: none!important;
}
.jwdisplayIcon {
  display: none!important;
}
.has-dots {
    height: 320px!important;
}
</style>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-72329152-1', 'auto');
  ga('send', 'pageview');
</script>

</head>
<body>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5&appId=803198449807533";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
$(document).ready(function(){
    $(".play-icon").click(function(){
        $(".jwdisplayIcon").css("display", "block");
    });
 $(".play-video").click(function(){
        $(".jwdisplayIcon").css("display", "block");
    });
});
</script>




<div id="wrapper">
<div class="td-transition-content-and-menu td-mobile-nav-wrap">
    <div id="td-mobile-nav">
        <div class="td-mobile-close"> <a href="javascript:void(0);">CLOSE</a>
            <div class="td-nav-triangle"></div>
        </div>
        <div class="td-mobile-content">
            <div class="menu-header-menu-container">
                <ul class="menu-mobile">
                    <li>
                        <a href="<?php echo get_url(0,'Phim lẻ','Danh sách');?>"> <img class="menu-icon" src="<?php echo SITE_URL;?>/assets/img/icon_phimle.png" alt="Phim Le Hay"> <span>Phim lẻ</span> </a>
                        <div class="children">
                            <ul class="children-left list-unstyled">
                                <?php echo li_category(); ?>

                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo get_url(0,'Phim bộ','Danh sách');?>"><img src="<?php echo SITE_URL;?>/assets/img/icon_phimbo.png" alt="Phim Bo Hay" class="menu-icon"><span>phim bộ</span>
                        </a>
                        <div class="children">
                            <ul class="children-left list-unstyled">
                                <?php echo li_country(); ?> </ul>
                        </div>
                    </li>
                    <li>
                        <a href="/"><img src="<?php echo SITE_URL;?>/assets/img/icon_show.png" alt="Show Hay HD" class="menu-icon"><span>show</span>
                        </a>
                    </li>
                    <li>
                        <a href="/"><img src="<?php echo SITE_URL;?>/assets/img/icon_clip.png" alt="Clip Hay HD" class="menu-icon"><span>clip</span>
                        </a>
                    </li>
                    <li>
                        <a href="/"><img src="<?php echo SITE_URL;?>/assets/img/icon_yeucau.png" alt="Xem truyen hinh truc tuyen" class="menu-icon"><span>live TV</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="page-wrapper">
<?if($mode !='xem-phim' && $mode !='phim'){?>
<div class="container">
<?}?>
<header>

    <div class="row">
        <div class="col-lg-2 col-xs-4">
            <div id="logo">
                <a href="/" title="Phim Hay hd"><img src="<?php echo SITE_URL;?>/assets/img/logo.png" alt="Phim Hay | Phim hd">
                </a>
            </div>
        </div>
        <div id="Header" class="cf headerver1">
    <div id="Header-in" class="cf">
        <div class="fl-left" style="width: auto; display: inline-flex;">
                <span class="logo-details">HayPhim – Xem phim online miễn phí chất lượng cao full HD</span>
                <a href="<?php echo SITE_URL;?>" id="Logo"><img src="<?php echo SITE_URL;?>/assets/img/logo.png" alt="HayPhimTV" style="padding-top:5px;" /></a>
            <ul class="mainmenu cf">
                                    <li id="menu-phimle" class="mainmenulist"><a class="mainitem" menuid="3" href="<?php echo SITE_URL;?>/danh-sach/phim-le/" title="Xem phim lẻ">Phim lẻ</a>
                        <ul class="childmainmenu cf">
						<li class="childcols childcols2">
                             <?php echo li_category(); ?>
						</li>
                        </ul>
                    </li>
                        <li id="menu-phimbo" class="mainmenulist"><a class="mainitem" menuid="10" href="<?php echo SITE_URL;?>/danh-sach/phim-bo/" title="Xem phim bộ">Phim bộ</a>
                        <ul class="childmainmenu childmainmenus cf">
						<li class="childcols">
                             <?php echo li_country(); ?>         
						</li>
                        </ul>
                    </li>
                                <li class="mainmenulist fause">
                    <a class="mainitem1 mainitem" href="<?php echo SITE_URL;?>/video" menuid="fa" title="Video" >Video</a>
                                    </li>
                <li class="mainmenulist tvuse"><a class="mainitem" href="<?php echo SITE_URL;?>/live-tv" menuid="tv" title="Xem TV">Xem TV</a></li>
                <li class="mainmenulist tvuse"><a class="mainitem" href="http://hayphim.tv/phim/4286-running-man-vietsub/" rel="nofollow">Running Man</a></li>
                <li class="mainmenulist tvuse"><a class="mainitem" href="<?php echo SITE_URL;?>/bang-xep-hang/" title="Xếp Hạng" target="_blank" >Xếp Hạng</a></li>
            </ul>
        </div>
        <div class="fl-right">
                        
            <ul class="menuuser">
               
                <li class="lisearch">
				
				<form action="/" id="form">
                    <a href="javascript:;" class="btn-search" title="Search">Search</a>
                    <input type="text" class="txtsearch" name="s" id="search" placeholder="Tìm kiếm phim, đạo diễn, diễn viên..." />
                 </form>   
                   
                </li>
               
            </ul>
        </div>
    </div><!--Header-in-->
</div>
    </div>
</header>
<div id="abdMasthead" style="margin:0 auto; width:970px"></div>
<section id="main">


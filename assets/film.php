<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
$film = MySql::dbselect("tb_film.title,tb_film.title_en,tb_film.category,tb_film.release_time,tb_film.timeupdate,tb_film.thumb,tb_film.country,tb_film.director,tb_film.actor,tb_film.year,tb_film.duration,tb_film.viewed,tb_film_other.content,tb_film_other.keywords,tb_film.total_votes,tb_film.total_value,tb_film.trailer,tb_film.big_image,tb_film.quality,tb_film.filmlb,tb_film.link_down",'film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"id = '$filmid'");
$tenphim = $film[0][0];
$tentienganh = $film[0][1];
$watchurl = get_url($epwatch,$tenphim,'Xem Phim');
$breadcrumb = breadcrumb_menu($film[0][2]);
$urlfilm = get_url($filmid,$tenphim,'Phim');
$big_thumb = $film[0][17];
$phathanh = $film[0][3];
$thumb = $film[0][5];
if(!$thumb) $thumb = TEMPLATE_URL.'images/grey.jpg';
$theloai = category_a($film[0][2]);
$quocgia = country_a($film[0][6]);
$genre = category_ad($film[0][2]);
$country = country_ad($film[0][6]);
$daodien_a = CheckName($film[0][7]);	
$urldaodien = get_url('',$daodien_a,'search');
$daodien = Get_List_director($film[0][7]);
$dienvien = Get_List_actor($film[0][8]);
$dienvien2 = Get_List_actor2($film[0][8]);
$year = CheckName($film[0][9]);
$duration = CheckName($film[0][10]);
$viewed = $film[0][11];
$loaiphim = $film[0][19];
$content = $film[0][12];
$tags = GetTag_a($film[0][13],5);
$image_r = explode("<img ",UnHtmlChars($film[0][12]));
$Astar = $film[0][15];
$Bstar = $film[0][14];
$Cstar = ($Astar/$Bstar);
$Dstar = number_format($Cstar,0);
$Cstar = number_format($Cstar,1);
for($i=1;$i<count($image_r);$i++) {
	preg_match('/src="([^"]+)"/', $image_r[$i], $image);
	$image = $image[1];
	$image_all .= "<img src=\"$image\" alt=\"$tenphim - $tentienganh\" width=\"600px\"/>";
}
for($i=1;$i<11;$i++) {
	$votes .= "<div class=\"vote-line-hv\" data-id=\"$i\"></div>";
}
$trailer = $film[0][16];
$quality = $film[0][18];
$episodeid = $epid[0][3];
$epurl = $epid[0][3];
$epsubtitle = $epid[0][4];
?>

<script>
var	download_video = false;
function load_datadownload(epid) {
	if(download_video == false) {
		$('.download-box').show().html("<img src='/assets/img/loadings.gif'> Đang tải, vui lòng chờ trong giây lát ...");
		$.post('/index.php', {
			RK_Download: 1,
			epid: epid
		}, function (data) {
			if(data) {
				$('.download-box').html('<center><span style="color:#fff">Chọn chất lượng phim sau đó nhấn chuột phải để lưu phim về máy</span><br />'+data+'</center>');
				download_video = true;
			}			
		});
	}
	return false;
}
$(document).ready(function () {
$("#tai-phim").click(function () {
		var epid = $(this).attr('data-id');
		load_datadownload(epid);
		return false;
	});
});
</script>
<style>
.turnon-light .turndiv-light{background:url(/assets/img/icon/switch2_off.png) no-repeat;background-position:0px center;padding-left:22px;color:#292929;text-shadow:0px 1px 0px transparent;}.turnoff-light .turndiv-light{background:url(/assets/img/icon/download.png) no-repeat;background-position:0px center;padding-left:22px;}a.btn-actions.turnon-light.light-over{background-color:#f2f2f2;font-family:roboto-condensed;}
</style>

	<?php if($mode == 'xem-phim') { ?>
<style>
    .vjs-default-skin .vjs-big-play-button {
    top: 40%;
}
.bg_player {
    background: #3b3b3c none repeat scroll 0 0;
    margin: 0 auto;
    width: 100%;
}
.hh_view{background:url(/assets/img/icon/views.png) no-repeat #F4F5F5;background-position:1px center;padding-left:25px;border:none;border:1px solid #B9B9B9;padding:0px 10px -1px 40px;margin:0px;height:29px;outline:none;color:#6F6F6F;margin-right:1px;vertical-align:0px;position:relative;padding-right:10px;border-radius:3px;}.hh_view:hover{}
.btn-actions,.btn-actions:focus{background-color:#ff2e2e;color:#fff;font-size:13px;text-decoration:none;font-family:roboto-condensed;padding:5px 6px;text-decoration:none;transition:All 0.3s ease;-webkit-transition:All 0.3s ease;-moz-transition:All 0.3s ease;-o-transition:All 0.3s ease;display:inline-block;border:1px solid #ff1515;border-radius:3px;}.btn-actions:hover,.btn-actions.active{background:rgb(135,135,135);text-decoration:none;color:#fff;border:1px solid transparent;}.fb_btn_color,.fb_btn_color:hover,.fb_btn_color:focus{background-color:#3251A1;color:#fff;border:1px solid #3251A1;}.fa-facebook{background:url(/assets/img/icon/fa-facebook.png) no-repeat;background-position:0px center;padding-left:22px;}

.box-shadow{text-align:center;padding-bottom:10px;background:#e6e6e6;padding-top:10px;}
</style>
<div class="bg_player">
<div class="row">
    <div class="col-lg-12">
	<div class="container">
        <div id="film-content">
<div class="film-player">
<?php echo player($id);?>
</div>
 </div></div>
        </div>
    </div>
<div class="box_share container">
<ul class="choose-server">
<?php
$epactive = MySql::dbselect('tb_episode.id,tb_episode.name,tb_episode.filmid,tb_episode.url,tb_episode.subtitle,tb_film.filmlb,tb_episode.present','episode JOIN tb_film ON (tb_episode.filmid = tb_film.id)',"filmid = '$filmid' AND name = '".$epid[0][1]."' ORDER BY id DESC");
for($i=0;$i<count($epactive);$i++) {
	$epids		=	$epactive[$i][0];
	$epnames		=	$epactive[$i][1];
	$playLink	=	get_url($epids,$tenphim,'Xem Phim');
	if($epids == $epid[0][0]) $active[$i] = '<div class="playing"></div>';
	if($epactive[$i][6]==1){
?>
			<li>
                <a href="<?=$playLink?>"><?=$active[$i]?><?=$epnames?> - Thuyết minh</a>
            </li>
	<?}else{?>
            <li>
                <a href="<?=$playLink?>"><?=$active[$i]?><?=$epnames?> - VietSub</a>
            </li>
	<?}}?>
</ul>
	<ul style="float: right;">
		<li>
			<div style="text-align:right;">
				<div style="padding-left:5px;padding-right:5px;" class="fb-like" data-href="<?php echo $urlfilm;?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
				<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script><span class="gplus"><g:plusone></g:plusone></span>
				<button class="hh_view">
					<div class="arr-left_bf"></div>
					<span class="number_view"><?=number_format($viewed)?></span>
				</button>
				<?if($film[0][20]){?>
      			<a class="btn-actions turnoff-light" href="<?=$film[0][20]?>" target="_blank"><span class="turndiv-light">Download</span></a>
				<?}else{?>
				<a class="btn-actions turnoff-light" href="javascript:void(0);" id="tai-phim" data-id="<?=$id?>"><span class="turndiv-light">Download</span></a>
				<?}?>
				</div>
		
		</li>
	</ul>
</div>
<div style="padding:10px;text-align:center"><div class="download-box" style="display:none"></div></div>

</div>
<center>
<script type="text/javascript">
    	var _ase  = _ase || [];
    	/* load placement for account: hayphim, site: http://hayphim.tv, zone size : 728x90 */
    	_ase.push(["1441868482","1441868635"]);
</script>
<script src="http://static.gammaplatform.com/js/ad-exchange.js" type="text/javascript"></script>
<noscript><iframe src="http://tag.gammaplatform.com/adx/noscript/zid_1441868635/wid_1441868482/" width="960" height="90" scrolling="no"  frameborder=0></iframe></noscript>
</center>
<style type="text/css"> .pos-1 { display: none; } .commentline{color:#ff4e00;border-bottom:1px solid #BEBEBE;font-size:24px;font-weight:700px;margin-top:20px;margin-bottom:10px;}
.gplus { position: relative; top: 8px; }</style>
<div class="container">
 <div class="episode-container mCustomScrollbar _mCS_1" data-custom-scrollbar="true" data-custom-scrollbar-mousewheel="true" data-custom-scrollbar-autolength="true">
            <div class="mCustomScrollBox mCS-light" id="mCSB_1" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
                <div class="mCSB_container mCS_no_scrollbar" style="position: relative; top: 0px;">
                    <h3 style="color: #f5cc2a;">Danh sách Tập</h3>
                        <div class="row">
                            <div class="col-lg-12">
                            <?php echo list_episode($filmid,$tenphim,$epid[0][0]);?> 
                            </div>
                        </div>
                </div>
            </div>
        </div>

<div id='' class="section-content fluid">
    <div class="box_details_movies">
		<div class="wap_details_movies">
			<div class="left_details_movies">
				<h2 class="name_en"><?php echo $tentienganh; ?> </h2> <h2 class="name_vn"><?php echo $tenphim; ?></h2>				 
				<div class="info_movies"> <div class="info_film-img"> <img src="<?=$thumb?>" style="width:195px;height:272px;" /> </div> <div class="info_film-show"> <p><span>Năm phát hành: </span><?php echo $year;?></p> <p><span>Thời lượng: </span> <?php echo $duration; ?></p> <p><span>Đạo diễn: </span><?php echo $daodien; ?></p> <p><span>Quốc gia: </span><?php echo $country; ?></p> <p><span>Thể loại: </span><?php echo $theloai; ?></p> <p><span>Diễn viên: </span><?php echo $dienvien2; ?></p> 	
				
				</div>
</div>
<div class='info_film-show'>
	<?
	//$content = preg_replace('#\<p>[{\w},\s\d"]+\</p>#', "", $content);
	//$output = nl2br(trim(str_replace(array("<p>","</p>"),array("","\n"),$content)));
	$output = strip_tags(nl2br($content), '<a><h1><img><b><strong><br>');
	echo $output;?>
	</div>

<div class='commentline'>Bình luận</div>
<div class="fb-comments" data-colorscheme="dark" data-href="<?php echo $urlfilm;?>" data-numposts="5" data-width="100%"></div>


			</div>
			<div class="right_details_movies">
			<div id="InPage_1441866321"> </div>
<script type="text/javascript">
var _abd = _abd || [];
/* load placement for account: hayphim, site: http://hayphim.tv, size: 300x250 - web, zone: in_page */
_abd.push(["1441866203","InPage","1441866321","InPage_1441866321"]);
</script>
<script src="http://media.adnetwork.vn/js/adnetwork.js" type="text/javascript"></script>
<noscript><a href="http://track.adnetwork.vn/247/adServerNs/zid_1441866321/wid_1441866203/" target="_blank"><img src="http://delivery.adnetwork.vn/247/noscript/zid_1441866321/wid_1441866203/" /></a></noscript>

				<script type="text/javascript">
    	var _ase  = _ase || [];
    	/* load placement for account: hayphim, site: http://hayphim.tv, zone size : 300x250 */
    	_ase.push(["1441868482","1441868583"]);
    	</script>
    	<script src="http://static.gammaplatform.com/js/ad-exchange.js" type="text/javascript"></script>
		<noscript><iframe src="http://tag.gammaplatform.com/adx/noscript/zid_1441868583/wid_1441868482/" width="300" height="250" scrolling="no"  frameborder=0></iframe></noscript>
			    <div class="fanpage" style="margin-bottom:5px">
                   <div class="fb-page" style="margin-top:5px;" data-href="https://www.facebook.com/Hayphim.TV?ref=hl data-width="300" data-height="428" data-hide-cover="false" data-show-facepile="false" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/Hayphim.TV?ref=hl"><a href="https://www.facebook.com/Hayphim.TV?ref=hl">Facebook</a></blockquote></div></div>			</div>	 
				
				<script src="https://apis.google.com/js/platform.js" async defer>
				  {lang: 'vi'}
				</script>	

				<div class="g-page" data-href="//plus.google.com/u/0/109711465014382826639" data-rel="publisher"></div>					   
			</div>
		<div class="clear"></div>
		</div>

	</div>
</div>


<div class="block-content">
    <div class="bc-header"> <img class="heading-icon" src="<?php echo SITE_URL;?>/assets/img/icon_cup.png" alt="">
        <h2 style="color: #f5cc2a;">Có thể bạn chưa xem</h2> </div>
    <div class="bc-content film-grid">
        <div class="slide-container mCustomScrollbar _mCS_4" data-custom-scrollbar="true" data-custom-scrollbar-horizontal="true">
            <div class="mCustomScrollBox mCS-light mCSB_horizontal" id="mCSB_4" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
                <div class="mCSB_container" style="left: 0px; width: 1944px; position: relative;">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12">
                            <div class="film-grid-content clearfix has-scrollbar" style="width: 1944px ">
                                    <?php echo rand2();?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>window.AppData = JSON.parse('{"ajax":{"_token":"SwOZIu1DEfYAlqIV11IQe9hbYkKY3O7nWdujGGZb"},"events":["common","common.lazyLoadingSetup","film.handleFilmAction","common.vexSetup","SearchForm","slider","common.loginHandler","common.feedbackHandler","common.requireHandler"],"film":{"status":"ok"},"url":"http:\/\/hayphim.tv\/"}');</script><link rel="stylesheet" id="vex" href="<?php echo SITE_URL;?>/assets/css/vex.css">
<?php
}else{ 
?>
<style>
    .vjs-default-skin .vjs-big-play-button {
    top: 40%;
}
.bg_player {
    background: #3b3b3c none repeat scroll 0 0;
    margin: 0 auto;
    width: 100%;
}
.hh_view{background:url(/assets/img/icon/views.png) no-repeat #F4F5F5;background-position:1px center;padding-left:25px;border:none;border:1px solid #B9B9B9;padding:0px 10px -1px 40px;margin:0px;height:29px;outline:none;color:#6F6F6F;margin-right:1px;vertical-align:0px;position:relative;padding-right:10px;border-radius:3px;}.hh_view:hover{}
.btn-actions,.btn-actions:focus{background-color:#ff2e2e;color:#fff;font-size:13px;text-decoration:none;font-family:roboto-condensed;padding:5px 6px;text-decoration:none;transition:All 0.3s ease;-webkit-transition:All 0.3s ease;-moz-transition:All 0.3s ease;-o-transition:All 0.3s ease;display:inline-block;border:1px solid #ff1515;border-radius:3px;}.btn-actions:hover,.btn-actions.active{background:rgb(135,135,135);text-decoration:none;color:#fff;border:1px solid transparent;}.fb_btn_color,.fb_btn_color:hover,.fb_btn_color:focus{background-color:#3251A1;color:#fff;border:1px solid #3251A1;}.fa-facebook{background:url(/assets/img/icon/fa-facebook.png) no-repeat;background-position:0px center;padding-left:22px;}

.box-shadow{text-align:center;padding-bottom:10px;background:#e6e6e6;padding-top:10px;}
</style>
<script>
    $(document).ready(function(){
    $("#play-trailer").click(function(even) {
        even.preventDefault(); 
        loadPopup(); 
    });

    $("#btn-close").click(function(){
        disablePopup();
    });

    $(this).keydown(function(event) {
        if (event.which == 27) { 
            disablePopup(); 
        }
    });

    $("#background-popup").click(function() {
        disablePopup(); 
        disableLoginPopup();
    });

    var popupStatus = 0; 

    function loadPopup() {
        if(popupStatus == 0) { 
            $("#to-popup").fadeIn(200); 
            $("#background-popup").css("opacity", "0.8"); 
            $("#background-popup").fadeIn(200);
            popupStatus = 1; 
        }
    }

    function disablePopup() {
        if(popupStatus == 1) {
            $("#to-popup").fadeOut(300);
            $("#background-popup").fadeOut(300);
            $('body,html').css("overflow","auto");
            popupStatus = 0; 
        }
    }
});
</script>

<div class="bg_player">
<div class="row">
    <div class="col-lg-12">
	<div class="container">
        <div id="film-content">
<div class="film-player">
<?php echo player($epwatch);?>
</div>
 </div></div>
        </div>
    </div>
<div class="box_share container">
<ul class="choose-server">
<?php
$epactive = MySql::dbselect('tb_episode.id,tb_episode.name,tb_episode.filmid,tb_episode.url,tb_episode.subtitle,tb_film.filmlb,tb_episode.present','episode JOIN tb_film ON (tb_episode.filmid = tb_film.id)',"filmid = '$filmid' AND name = '".$epname."' ORDER BY id DESC");
for($i=0;$i<count($epactive);$i++) {
	$epids		=	$epactive[$i][0];
	$epnames		=	$epactive[$i][1];
	$playLink	=	get_url($epids,$tenphim,'Xem Phim');
	if($epids == $epwatch) $active[$i] = '<div class="playing"></div>';
	if($epactive[$i][6]==1){
?>
			<li>
                <a href="<?=$playLink?>"><?=$active[$i]?><?=$epnames?> - Thuyết minh</a>
            </li>
	<?}else{?>
            <li>
                <a href="<?=$playLink?>"><?=$active[$i]?><?=$epnames?> - VietSub</a>
            </li>
	<?}}?>
</ul>
	<ul style="float: right;">
		<li>
			
				<div style="text-align:right;">
				<div style="padding-left:5px;padding-right:5px;" class="fb-like" data-href="<?php echo $urlfilm;?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
				<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script><span class="gplus"><g:plusone></g:plusone></span>
				<button class="hh_view">
					<div class="arr-left_bf"></div>
					<span class="number_view"><?=number_format($viewed)?></span>
				</button>
      			<?if($film[0][20]){?>
      			<a class="btn-actions turnoff-light" href="<?=$film[0][20]?>" target="_blank"><span class="turndiv-light">Download</span></a>
				<?}else{?>
				<a class="btn-actions turnoff-light" href="javascript:void(0);" id="tai-phim" data-id="<?=$id?>"><span class="turndiv-light">Download</span></a>
				<?}?>
				</div>
			
		</li>
	</ul>
</div>
<div style="padding:10px;text-align:center"><div class="download-box" style="display:none"></div></div>
</div>
<center>
<script type="text/javascript">
    	var _ase  = _ase || [];
    	/* load placement for account: hayphim, site: http://hayphim.tv, zone size : 728x90 */
    	_ase.push(["1441868482","1441868635"]);
</script>
<script src="http://static.gammaplatform.com/js/ad-exchange.js" type="text/javascript"></script>
<noscript><iframe src="http://tag.gammaplatform.com/adx/noscript/zid_1441868635/wid_1441868482/" width="960" height="90" scrolling="no"  frameborder=0></iframe></noscript>
</center>
<style type="text/css"> .pos-1 { display: none; } .commentline{color:#ff4e00;border-bottom:1px solid #BEBEBE;font-size:24px;font-weight:700px;margin-top:20px;margin-bottom:10px;}
.gplus { position: relative; top: 8px; }</style>
<div class="container">
 <div class="episode-container mCustomScrollbar _mCS_1" data-custom-scrollbar="true" data-custom-scrollbar-mousewheel="true" data-custom-scrollbar-autolength="true">
            <div class="mCustomScrollBox mCS-light" id="mCSB_1" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
                <div class="mCSB_container mCS_no_scrollbar" style="position: relative; top: 0px;">
                    <h3 style="color: #f5cc2a;">Danh sách Tập</h3>
                        <div class="row">
                            <div class="col-lg-12">
                            <?php echo list_episode($filmid,$tenphim,$epid[0][0]);?> 
                            </div>
                        </div>
                </div>
            </div>
        </div>

<iframe width="100%" height="273px" scrolling="no" frameborder="0" style="overflow:hidden;" src="http://hayphim.tv/wiget.php"></iframe>
<div id='' class="section-content fluid"> 
    <div class="box_details_movies">
		<div class="wap_details_movies">
			<div class="left_details_movies">
				<h2 class="name_en"><?php echo $tentienganh; ?> </h2> <h2 class="name_vn"><?php echo $tenphim; ?></h2>				 
				<div class="info_movies"> <div class="info_film-img"> <img src="<?=$thumb?>" style="width:195px;height:272px;" /> </div> <div class="info_film-show"> <p><span>Năm phát hành: </span><?php echo $year;?></p> <p><span>Thời lượng: </span> <?php echo $duration; ?></p> <p><span>Đạo diễn: </span><?php echo $daodien; ?></p> <p><span>Quốc gia: </span><?php echo $country; ?></p> <p><span>Thể loại: </span><?php echo $theloai; ?></p> <p><span>Diễn viên: </span><?php echo $dienvien2; ?></p> 	
				
				</div>
</div>
<div class='info_film-show'>
	<?
	//$content = preg_replace('#\<p>[{\w},\s\d"]+\</p>#', "", $content);
	//$content = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $content);
	//$output = nl2br(str_replace(array("<p>","</p>"),array("",""),$content));
	$output = strip_tags(nl2br($content), '<a><h1><img><b><strong><br>');
	echo $output;?>
	</div>

<div class='commentline'>Bình luận</div>
<div class="fb-comments" data-colorscheme="dark" data-href="<?php echo $urlfilm;?>" data-numposts="5" data-width="100%"></div>


			</div>
			<div class="right_details_movies">
			<script type="text/javascript">
    	var _ase  = _ase || [];
    	/* load placement for account: hayphim, site: http://hayphim.tv, zone size : 300x250 */
    	_ase.push(["1441868482","1441868583"]);
    	</script>
    	<script src="http://static.gammaplatform.com/js/ad-exchange.js" type="text/javascript"></script>
		<noscript><iframe src="http://tag.gammaplatform.com/adx/noscript/zid_1441868583/wid_1441868482/" width="300" height="250" scrolling="no"  frameborder=0></iframe></noscript>
		 

			    <div class="fanpage" style="margin-bottom:5px">
                   <div class="fb-page" style="margin-top:5px;" data-href="https://www.facebook.com/Hayphim.TV?ref=hl data-width="300" data-height="428" data-hide-cover="false" data-show-facepile="false" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/Hayphim.TV?ref=hl"><a href="https://www.facebook.com/Hayphim.TV?ref=hl">Facebook</a></blockquote></div></div>			</div>	 
				
				<script src="https://apis.google.com/js/platform.js" async defer>
				  {lang: 'vi'}
				</script>	

				<div class="g-page" data-href="//plus.google.com/u/0/109711465014382826639" data-rel="publisher"></div>
				
			</div>
		<div class="clear"></div>
		</div>

	</div>
</div>
        <div class="block-content">
    <div class="bc-header" style="color: #f5cc2a;"> <img class="heading-icon" src="<?php echo SITE_URL;?>/assets/img/icon_cup.png" alt="">
        <h2>Có thể bạn chưa xem</h2> </div>
    <div class="bc-content film-grid">
        <div class="slide-container mCustomScrollbar _mCS_4" data-custom-scrollbar="true" data-custom-scrollbar-horizontal="true">
            <div class="mCustomScrollBox mCS-light mCSB_horizontal" id="mCSB_4" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
                <div class="mCSB_container" style="left: 0px; width: 1944px; position: relative;">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12">
                            <div class="film-grid-content clearfix has-scrollbar" style="width: 1944px ">
                                    <?php echo rand2();?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>                

        <style>
        /***Trailer***/
#background-popup {z-index:85; position: fixed; display:none; height:100%; width:100%; background:#000; top:0px; left:0px;}
#to-popup {
    background: #F9F9F9;
    color: #333333;
    display: none;
    width: 88%;
    height: 80%;
    overflow: auto;
    position: fixed;
    top: 12%;
    z-index: 900;
    left: 50%;
    margin-left: -45%;
    padding: 15px;
}
#btn-close{transition:0.2s; display: block; width: 40px; height: 40px; position: absolute; top: 0; right: 0; cursor: pointer; 
    background: rgba(255, 255, 255, 0.8);}
#btn-close:before {
    content: "";
    display: block;
    position: absolute;
    top: 30%;
    left: 30%;
    width: 40%;
    height: 40%;
    background: rgba(251, 246, 246, 0) url(/content/template/img/cam_close.png) no-repeat;
}
#btn-close:hover {
    background: rgba(4, 4, 4, 0.3);
}
#popup-content{width: 100%; height: 100%; min-height: 400px; min-width: 500px;}

#loading-title{display: block; line-height: 400px; text-align: center;}
.btn-open-popup{display: inline-block; line-height: 40px; padding: 0 20px; background:#1A91B1; color: #fff; font-size: 14px; 
    border-radius: 3px; margin-top: 180px; transition: 0.3s;}
.btn-open-popup:hover{background: #EB5F60;}
</style>
<div id="to-popup">
        <span id="btn-close"></span>

        <?php 
        if(!empty($trailer)){

            ?>
                 <div id="popup-content">
            <iframe width="770" height="480" src="<?php echo $trailer;?>?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen="" style="float:left"></iframe>   

<div style="float:right;    padding-top: 20px;" ><iframe scrolling="no" title="Facebook Social Plugin" src="https://www.facebook.com/plugins/comments.php?href=<?php echo $watchurl;?>&amp;locale=vi_VN&amp;numposts=10&amp;order_by=reverse_time&amp;sdk=joey&amp;skin=dark&amp;version=v2.4&amp;width=360" style="border: none; overflow: hidden; height: 400px; width: 360px;"></iframe>
                </div>
                </div>

            <?php
            }else{
echo ' <div id="popup-content"><span style="float:left;font-size:20px">Phim này chưa có trailer.</span>

<div style="float:right;    padding-top: 20px;" ><iframe scrolling="no" title="Facebook Social Plugin" src="https://www.facebook.com/plugins/comments.php?href='.$watchurl.'&amp;locale=vi_VN&amp;numposts=10&amp;order_by=reverse_time&amp;sdk=joey&amp;skin=dark&amp;version=v2.4&amp;width=360" style="border: none; overflow: hidden; height: 400px; width: 360px;"></iframe>
                </div>


                </div>';

}
                ?>   
              <!--end #popup-content-->
    </div> <!--to-popup end-->
    <div id="background-popup"></div>


<script>window.AppData = JSON.parse('{"ajax":{"_token":"SwOZIu1DEfYAlqIV11IQe9hbYkKY3O7nWdujGGZb"},"events":["common","common.lazyLoadingSetup","film.handleFilmAction","common.vexSetup","SearchForm","slider","common.loginHandler","common.feedbackHandler","common.requireHandler"],"film":{"status":"ok"},"url":"http:\/\/hayphim.tv\/"}');</script><link rel="stylesheet" id="vex" href="<?php echo SITE_URL;?>/assets/css/vex.css">

<?php
}
include View::TemplateView('footer');

?>

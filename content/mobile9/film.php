<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
$film = MySql::dbselect("
	tb_film.title,
	tb_film.title_en,
	tb_film.category,
	tb_film.release_time,
	tb_film.timeupdate,
	tb_film.thumb,
	tb_film.country,
	tb_film.director,
	tb_film.actor,
	tb_film.year,
	tb_film.duration,
	tb_film.viewed,
	tb_film_other.content,
	tb_film_other.keywords,
	tb_film.total_votes,
	tb_film.total_value,
	tb_film.trailer,
	tb_film.big_image,
	tb_film.quality,
	tb_film.active
	",'film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"id = '$filmid'");
$tenphim = $film[0][0];
$tentienganh = $film[0][1];
$watchurl = get_url($epwatch,$tenphim,'Xem Phim');
$breadcrumb = breadcrumb_menu($film[0][2]);
$urlfilm = get_url($filmid,$tenphim,'Phim');
$phathanh = $film[0][3];
if(!$phathanh) $phathanh = GetDateT($film[0][4]);
$thumb = $film[0][5];
if(!$thumb) $thumb = TEMPLATE_URL.'images/grey.jpg';
$theloai = category_a($film[0][2]);
$quocgia = country_a($film[0][6]);
$daodien_a = CheckName($film[0][7]);
$daodien = Get_List_director($film[0][7]);
$dienvien = Get_List_actor($film[0][8]);
$year = CheckName($film[0][9]);
$duration = CheckName($film[0][10]);
$viewed = number_format($film[0][11]);
$content = RemoveHtml(UnHtmlChars($film[0][12]));
$tags = GetTag_a($film[0][13],2);
$image_r = explode("<img ",UnHtmlChars($film[0][12]));
$Astar = $film[0][15];
$Bstar = $film[0][14];
$Cstar = ($Astar/$Bstar);
$Dstar = number_format($Cstar,0);
$Cstar = number_format($Cstar,1);
for($i=1;$i<count($image_r);$i++) {
	preg_match('/src="([^"]+)"/', $image_r[$i], $image);
	$image = $image[1];
	$image_all .= "<li>
		<a href=\"$image\" rel=\"screen[s]\" title=\"\">
			<img src=\"$image\" alt=\"$tenphim\" title=\"$tenphim\" width=\"600px\"/>
		</a>
	</li>";
}
for($i=1;$i<11;$i++) {
	$votes .= "<div class=\"vote-line-hv\" data-id=\"$i\"></div>";
}
$trailer = $film[0][16];
if(!$trailer) $trailer = config_site('trailer');
$bigthumb = $film[0][17];
if(!$bigthumb) $bigthumb = $thumb;
$quality = $film[0][18];
if($quality == 'HD') $quality = 'HD';
else $quality = 'SD';
$episodeid = $epid[0][0];
$epurl = str_replace("https://","http://",$epid[0][3]);
$epsubtitle = $epid[0][4];
?>
<style>#mobile-player video{transform:none!important;width:100%!important;height:100%!important;top:0px!important;left:0px!important;}.list-episode{max-height:185px;overflow:auto;margin-bottom:10px;}</style>
<script>
var mejsFullScreen = false;
var arrScreen = [];
var currentIndexScreen = 0;
function callBuildPlayerSuccess(){
	var newWidth = $(window).width();
	var newHeight = 0.57 * newWidth;
	$("#mobile-player, .mejs-container").css('width', newWidth);
	$("#mobile-player, .mejs-container").css('height', newHeight);
	//$("#info-player").css('margin-top', ($(".mejs-container").height() + 10) + "px");
	
	$("#mobile-player").css('top', '48px');
	$("#mobile-player").css('left',  ($(window).width()- newWidth)/2);
	try {
		player.setControlsSize();
	} catch(e){};
}
function playerUpdateTime(e){
	}
function sendError(){
	console.log("erpr");
}
function openTrailer(id){
	$("body").append('<div id="trailer-popup" style="position:fixed;top:0px;left:0px;height: 100%;width: 100%;z-index:900">'+
		    '<div id="trailer_player" style="width:100%;height:100%;"><iframe src="http://www.youtube.com/embed/' + id +'?autoplay=1" frameborder="0" allowfullscreen width="100%" height="100%"></iframe></div>'+
		    '<a class="close-trailer-popup" style="position: absolute;right: 0px; top: 0px; background: #7F7C7C; padding: 7px 13px;color: #fff;"><i class="fa fa-times fa-lg"></i></a></div>');
	$('.close-trailer-popup').unbind("click");
	$('.close-trailer-popup').bind("click", function(){
		$('#trailer-popup').remove();
	});
}
function openScreenshot(url , index){
	currentIndexScreen = index;
	arrScreen = [];
	$("body").append('<div id="screenshot-popup" style="position:fixed;top:0px;left:0px;height: 100%;width: 100%;z-index:900;background: #000;">'+
		    '<div id="screenshot-list" style="width:100%;height:100%;text-align: center;"><span style="display: inline-block;height: 100%;vertical-align: middle;"></span><img class="screen-popup-show-img" style="width:100%;height:auto;max-width:700px" src="'+ url + '"/></div>'+
		    '<a class="close-screenshot-popup" style="position: absolute;right: 0px; top: 0px; background: #7F7C7C; padding: 7px 13px;color: #fff;"><i class="fa fa-times fa-lg"></i></a>' +
		    '<a class="prev-screenshot-popup" style="position: absolute;left: 0px; top: 0px; background: #7F7C7C; padding: 7px 13px;color: #fff;"><i class="fa fa-chevron-left"></i></a>' + 
		    '<a class="next-screenshot-popup" style="position: absolute;left: 40px; top: 0px; background: #7F7C7C; padding: 7px 13px;color: #fff;"><i class="fa fa-chevron-right"></i></a></div>');
	$('.close-screenshot-popup , .next-screenshot-popup , .prev-screenshot-popup').unbind("click");
	$('.close-screenshot-popup').bind("click", function(){
		$('#screenshot-popup').remove();
	});
	$('.prev-screenshot-popup').bind('click' , function(){
		if (currentIndexScreen > 0) {
			currentIndexScreen --;
			var url = arrScreen[currentIndexScreen];
			$(".screen-popup-show-img").attr('src' , url);
		}
	});
	$('.next-screenshot-popup').bind('click' , function(){
		if (currentIndexScreen < arrScreen.length - 1) {
			currentIndexScreen++;
			var url = arrScreen[currentIndexScreen];
			$(".screen-popup-show-img").attr('src' , url);
		}
	});
}
</script>
<div class="content">
<div class="content-heading">
</div>
<div class="content-inner">
<div class="container" style="margin-top: 0px;">
<div class="row">
<div id="mobile-player" style="background-color: #fff;">
									<?php echo player($epwatch);?> 
</div>

<div class="col-lg-12 col-sm-12" id="info-player">
<div class="list-episode">
<?php echo list_episode($filmid,$tenphim,$episodeid);?>
</div>
<div style="padding:10px;">
<script async defer src="//cdn.adpoints.media/production/ads/1094.js"></script>
</div>
<div class="tab-content">
<div class="card-wrap thumb-movie-title">
<div class="div-like-movie">
</div>
<div class="div-title-right">
<span class="title-movie"><h1><?php echo $tenphim;?></h1> (<?php echo $year;?>)</span>
<span class="title-category"><?php echo $duration;?> | <?php echo $theloai;?></span>
</div>
</div>
<div class="card thumb-movie-detail">
<div class="image-movie">
<img src="<?=$thumb?>">
</div>
<div class="content-movie">
<span class="description-info"><?php echo $content_s;?></span>
<div class="group-button-info">
<!--<a class="btn waves-button waves-effect btn-flat" href="javascript:openTrailer('fvVcERIPSI4')">
<i class="fa fa-play-circle"></i> Trailer
</a>-->
<a class="btn collapsed waves-button waves-effect btn-flat" data-toggle="collapse" href="#collapsible-region">
<span class="collapsed-hide"><i class="fa fa-info-circle"></i> thông tin</span>
<span class="collapsed-show"><i class="fa fa-info-circle"></i> thông tin</span>
</a>
</div>
<div style="padding-left:5px;padding-right:5px;" class="fb-like" data-href="<?php echo $urlfilm;?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
</div>
</div>
<div class="collapsible-region collapse" id="collapsible-region" style="text-align:justify;margin-bottom:20px;">
<div class="card description-info" style="padding: 5px"><?php echo $content;?>
</div>
</div>
<div id="InPage_1441867501" style="text-align:center"> </div>
<script type="text/javascript">
var _abdm = _abdm || [];
/* load placement for account: hayphim, site: http://hayphim.tv, size: 300x250 - mobile, zone: in_page */
_abdm.push(["1441866203","InPage","1441867501","InPage_1441867501"]);
</script>
<script src="http://media.m.ambientplatform.vn/js/m_adnetwork.js" type="text/javascript"></script>
<noscript><a href="http://click.m.ambientplatform.vn/247/admServerNs/zid_1441867501/wid_1441866203/" target="_blank"><img src="http://delivery.m.ambientplatform.vn/247/mnoscript/zid_1441867501/wid_1441866203/" /></a></noscript>
<div class="tile-wrap">
<div class="tile">
<div class="tile-inner">
<span><strong>Quốc gia</strong> : <?=$quocgia?></span>
</div>
</div>
<div class="tile">
<div class="tile-inner">
<span><strong>Lượt xem</strong> : <?php echo $viewed;?></span>
</div>
</div>
</div>
<div class="card thumb-screenshot thumb-cast">
<div class="card-main">
<p class="title-cast-parent">Diễn viên</p>
<div class="thumb-img-list">
<ul>
<?=$dienvien?>

</ul>
</div>
</div>
</div>
<div id="InPage_1441867470" style="text-align:center"> </div>
<script type="text/javascript">
var _abdm = _abdm || [];
/* load placement for account: hayphim, site: http://hayphim.tv, size: 320x54 - mobile, zone: in_page */
_abdm.push(["1441866203","InPage","1441867470","InPage_1441867470"]);
</script>
<script src="http://media.m.ambientplatform.vn/js/m_adnetwork.js" type="text/javascript"></script>
<noscript><a href="http://click.m.ambientplatform.vn/247/admServerNs/zid_1441867470/wid_1441866203/" target="_blank"><img src="http://delivery.m.ambientplatform.vn/247/mnoscript/zid_1441867470/wid_1441866203/" /></a></noscript>
<div class="card thumb-relate-movie">
<div class="card-main">
<p class="title-cast-parent">Phim Liên Quan</p>
<div class="thumb-img-list">
<ul>
<?php echo li_filmALL('category',12,$film[0][2]);?>
</ul>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-12 col-sm-12">
<div class="comment_facebook">
<div class="fb-comments" data-version="v2.3" data-href="<?php echo $urlfilm;?>" data-num-posts="10" data-width="100%"></div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="share-bottom" id="share-bottom">
<style>.share-bottom img{max-width:100%;height:auto;position:absolute;left:0px;bottom:-75px;}.share-bottom a.closeads{position:absolute;right:0px;bottom:-75px;background-color:red;padding:3px 5px;z-index:100;display:block;line-height:3.5vw;color:#fff;font-size:3.5vw;}</style>
<script>
	function closeADS(){
		document.getElementById('share-bottom').style.display = 'none';
	}
	<?if($film[0][19]==1){?>
    setTimeout(function () {
        updateMovieView(<?=$filmid?>)
    }, 5000);
	<?}?>
	</script>
</div>
<?php
include View::TemplateView('footer');
?>
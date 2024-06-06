<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
$title_page = $name;
// Bộ lọc
parse_str(parse_url(Url::curRequestURL(),PHP_URL_QUERY), $filter);
if($filter['bycat'] || $filter['bycountry'] || $filter['byquality'] || $filter['byyear'] || $filter['byorder']) {
	if($filter['bycat']) {
		$catid =$filter['bycat'];
		$sql .= " AND category like '%,$catid,%'";
	}if ($filter['bycountry']) {
		$couid = $filter['bycountry'];
		$sql .= " AND country = '$couid'";
	}if ($filter['byquality']) {
		$qualityid = $filter['byquality'];
		$sql .= " AND quality = '$qualityid'";
	}if ($filter['byyear']) {
		$getyear = $filter['byyear'];
		$sql .= " AND year = '$getyear'";
	}if ($filter['byorder']) {
		$byorder = $filter['byorder'];
		if($byorder == 'timeupdate') $byorder = 'timeupdate';
		else if($byorder == 'year') $byorder = 'year';
		else if($byorder == 'title') $byorder = 'title';
		else if($byorder == 'viewed') $byorder = 'viewed';
		else $byorder = 'timeupdate';
	}
}
$orderby = 'ORDER BY '.$byorder.' DESC';
if(!$byorder) $orderby = 'ORDER BY id DESC';
if($geturl[3]) {
	$page = explode('-',$geturl[3]);
}
$page		= 	$page[1];
$num		= 	20;
$num 		= 	intval($num);
$page 		= 	intval($page);
if (!$page) 	$page = 1;
$limit 		= 	($page-1)*$num;
if($limit<0) 	$limit=0;
$arr = MySql::dbselect('
	tb_film.id,
	tb_film.title,
	tb_film.title_en,
	tb_film.thumb,
	tb_film.year,
	tb_film.big_image,
	tb_film_other.content,
	tb_film.quality,
	tb_film.year,
	tb_film.viewed,
	tb_film.duration,
	tb_film.category
	','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql $orderby LIMIT $limit,$num");
$bg_thumb = TEMPLATE_URL.'images/grey.jpg';
$total = MySql::dbselect('tb_film.id','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql");
$allpage_site = get_allpage(count($total),$num,$page,$url_page.'page-');
?>
<div class="content">
<div class="content-heading"> 
</div>
<div class="content-inner">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">
<div class="tab-content videos fnRTContent">

<div class="card-wrap">
<div class="row">

									<?php if(!$arr) { ?><div class="_mbp">Không có dữ liệu</div><?php } ?>
										<?php 
												for($i=0;$i<count($arr);$i++) {
													$filmid = $arr[$i][0];
													$title = $arr[$i][1];
													$title_en = $arr[$i][2];
													$content = CutName(RemoveHtml(UnHtmlChars($arr[$i][6])),150);
													$quality = $arr[$i][7];
													$year = $arr[$i][8];
													$thumb = $arr[$i][3];
													$viewed = $arr[$i][9];
													$duration = $arr[$i][10];
													$url = get_url($arr[$i][0],$title,'Phim');
											?>
											<div class="col-lg-6 col-sm-12">
<div class="card">
<aside class="card-side card-side-img">
<a href="<?php echo $url;?>" title="Xem phim">
<img alt="alt text" src="<?php echo $thumb;?>" style="width:215px;max-width:100%">
</a>
</aside>
<div class="card-main">
<div class="card-inner">
<p class="card-heading">
<a href="<?php echo $url;?>" title="Xem phim"><?php echo $title;?></a>
<em class="subtitle"><?php echo $title_en;?></em>
</p>
<p class="card-view">
<i class="fa fa-eye"></i> <?php echo number_format($viewed);?>
</p>
<p class="card-category">
<i class="fa fa-bolt"></i> <?=category_Watch($arr[$i][11])?> </p>
<p class="card-info"> </p>
</div>
</div>
</div>
</div>
<?if($i==6){?>
<div id="InPage_1441867501" style="text-align:center"> </div>
<script type="text/javascript">
var _abdm = _abdm || [];
/* load placement for account: hayphim, site: http://hayphim.tv, size: 300x250 - mobile, zone: in_page */
_abdm.push(["1441866203","InPage","1441867501","InPage_1441867501"]);
</script>
<script src="http://media.m.ambientplatform.vn/js/m_adnetwork.js" type="text/javascript"></script>
<noscript><a href="http://click.m.ambientplatform.vn/247/admServerNs/zid_1441867501/wid_1441866203/" target="_blank"><img src="http://delivery.m.ambientplatform.vn/247/mnoscript/zid_1441867501/wid_1441866203/" /></a></noscript>
<div style="padding-top:10px;padding-bottom:10px;"><script async defer src="//cdn.adpoints.media/production/ads/1094.js"></script></div>
<?}
if($i==10){
	echo '<div style="padding:10px;"><script async defer src="//cdn.adpoints.media/production/ads/1255.js"></script></div><br/><div id="InPage_1441867470" style="text-align:center"> </div>
<script type="text/javascript">
var _abdm = _abdm || [];
/* load placement for account: hayphim, site: http://hayphim.tv, size: 320x54 - mobile, zone: in_page */
_abdm.push(["1441866203","InPage","1441867470","InPage_1441867470"]);
</script>
<script src="http://media.m.ambientplatform.vn/js/m_adnetwork.js" type="text/javascript"></script>
<noscript><a href="http://click.m.ambientplatform.vn/247/admServerNs/zid_1441867470/wid_1441866203/" target="_blank"><img src="http://delivery.m.ambientplatform.vn/247/mnoscript/zid_1441867470/wid_1441866203/" /></a></noscript>';
}
?>

							
											<?php } ?>
										</div>
</div>
										<?php echo $allpage_site;?>
									</div>
</div>
</div>
</div>
</div>
</div>
<?php
include View::TemplateView('footer');
?>
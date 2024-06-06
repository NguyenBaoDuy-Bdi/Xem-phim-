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
if(!$byorder) $orderby = 'ORDER BY timeupdate DESC';
if($geturl[3]) {
	$page = explode('-',$geturl[3]);
}
$page		= 	$page[1];
$num		= 	'30';
$num 		= 	intval($num);
$page 		= 	intval($page);
if (!$page) 	$page = 1;
$limit 		= 	($page-1)*$num;
if($limit<0) 	$limit=0;
$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.title_en,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.quality,tb_film.year,tb_film.duration,tb_film.filmlb,tb_film.thuyetminh,tb_film.category,trailer','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql AND active=1 $orderby LIMIT $limit,$num");
$total = MySql::dbselect('tb_film.id','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql");
$allpage_site = get_allpage(count($total),$num,$page,$url_page.'page-');
?>
<div class="main-slider has-dots">
    <ul class="unstyled-list list-inline">

    <?php echo slider_film("slider = '1'",5);?>


 </ul>
    <ol class="dots">
       
    </ol>
</div>
 <br> 
<center style="padding-top:10px;">
<script type="text/javascript">
    	var _ase  = _ase || [];
    	/* load placement for account: hayphim, site: http://hayphim.tv, zone size : 728x90 */
    	_ase.push(["1441868482","1441868635"]);
</script>
<script src="http://static.gammaplatform.com/js/ad-exchange.js" type="text/javascript"></script>
<noscript><iframe src="http://tag.gammaplatform.com/adx/noscript/zid_1441868635/wid_1441868482/" width="960" height="90" scrolling="no"  frameborder=0></iframe></noscript>
</center>

<div class="row">
	<div class="col-lg-12">
		<section id="main-content">
			<div class="block-content">
				<div class="bc-header"> 
					<img class="heading-icon" src="<?php echo SITE_URL;?>/assets/img/icon_cup.png" alt="">
					<h3>Danh sách phim <?php echo $title_page;?></h3>
				</div>
				<div class="bc-content film-grid">
    				<div class="film-grid-content" style="margin-left:15px">
						<div class="row">
											<?php 
			for($i=0;$i<count($arr);$i++) {
				$filmid = $arr[$i][0];
				$title = $arr[$i][1];
				$filmlb = $arr[$i][10];
				$title_en = $arr[$i][2];
				$quality = $arr[$i][7];
				$year = $arr[$i][8];
				$duration = $arr[$i][9];
				$thumb = $arr[$i][3];
				$thuyetminh = $arr[$i][11];
				$cat = $arr[$i][12];
				$content = CutName(RemoveHtml(UnHtmlChars($arr[$i][6])),220);
				$trailer = $arr[$i][13];		
				if($arr[$i][13]) {
					$ytubeid = VideoYoutubeID($trailer); 
					$trailers = '<a href="javascript:void(0)" onclick="viewYT(\''.$ytubeid .'\')" class="btn tn-btn-view pull-left">Trailer</a>';
				}
				$url = get_url($arr[$i][0],$title,'Phim');
				$episode = MySql::dbselect('id,name','episode',"filmid = '$filmid' order by id desc limit 1");
				$epname = $episode[0][1];
				if($thuyetminh == 1){
					$phude = 'Thuyết Minh';
				}else{
					$phude = 'Vietsub';
				}
				if($filmlb!=0){
					$type = 'phimbo';
				}
				if($epname && $type == 'phimbo') { $epnames = "<span class=\"film-format\">Tập $epname | $phude</span>";
				}else{ $epnames = "<span class=\"film-format\">HD | $phude</span>"; }


echo '<div class="film-grid-item">
    <div class="film-thumbnail">
        <a href="'.$url.'" class="jt bxitem-link" data-jtip="#list-'.$filmid.'"> <img class="lazy" alt="'.$title.'" title="'.$title.'" src="http://hayphim.tv/timthumb.php?src='.$thumb.'&w=150" style="display: inline-block;">
            <div class="hover-play-btn"></div>
            
        </a>
		<div id="list-'.$filmid.'">
		<p class="name-vi">'.$title.' </p>
		<p class="name-en">'.$title_en.'</p>
		<p>Số Tập: '.$epname.' </p>
		<p>Năm sản xuất: '.$year.' </p>
		<div class="clearfix tip-info-bt">
		<span class="tn-pcolor1">'.category_tip($cat,0).'</span>
		<ul class="tip-info-bottom pull-right">		
		<li><span title="Chất lượng '.$quality.'" class="tagsInfo greenTag"><strong>'.$quality.'</strong></span></li>
		</ul>
		</div>
		<div class="tn-contentdecs mb10">
		'.$content.'
		</div>
		<div class="clearfix">';
		if($arr[$i][13]) {
		$ytubeid = VideoYoutubeID($arr[$i][13]); 
		echo '<a href="javascript:void(0)" onclick="viewYT(\''.$ytubeid .'\')" class="btn tn-btn-view pull-left">Trailer</a>';
		}
		echo '<a href="'.$url.'" class="btn tn-btn-view2 btn-like-add pull-right later-for-10289">Xem ngay</a>
		</div> </div>'.$epnames.' </div>
    <div class="film-info"> <a href="'.$url.'" class="title">'.$title_en.'</a> <span class="title2">'.$title.'</span> </div>
</div>';
}
		?>
						</div>
					</div>
				</div>
				<ul class="pagination pull-right">
				<?php echo $allpage_site;?>
				</ul>
			</div>
		</section>
	</div>
</div>






<script>window.AppData = JSON.parse('{"ajax":{"_token":"2AQpt7hTUb8ccVCBxgsSHoRp758CBnHPdnW929TH"},"events":["common","common.lazyLoadingSetup","common.hotMovieSliderSetup","common.vexSetup","SearchForm","slider","common.loginHandler","common.feedbackHandler","common.requireHandler"]}');</script>

	
<?php
include View::TemplateView('footer');
?>
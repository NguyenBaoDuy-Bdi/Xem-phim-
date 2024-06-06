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
$num		= 	'30';
$num 		= 	intval($num);
$page 		= 	intval($page);
if (!$page) 	$page = 1;
$limit 		= 	($page-1)*$num;
if($limit<0) 	$limit=0;
$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.title_en,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.quality,tb_film.year,tb_film.duration,tb_film.filmlb,tb_film.thuyetminh','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"1>0 ORDER BY id DESC LIMIT 24");
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

<div class="row">
	<div class="col-lg-12">
		<section id="main-content">
			<div class="block-content">
				<div class="bc-header"> 
					<img class="heading-icon" src="<?php echo SITE_URL;?>/assets/img/icon_cup.png" alt="">
					<h3>Danh sách phim <?php echo $title_page;?></h3>
				</div>
				<div class="bc-content film-grid">
    				<div class="film-grid-content">
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
				$content = CutName(RemoveHtml(UnHtmlChars($arr[$i][6])),220);
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
        <a href="'.$url.'"  class="jt bxitem-link" data-jtip="#list-'.$filmid.'"> <img class="lazy" alt="'.$title.'" title="'.$title.'" src="'.$thumb.'">
            <div class="hover-play-btn"></div>            
        </a>
		
		<div id="list-'.$filmid.'">
<p class="name-vi">'.$title.' </p>
<p class="name-en">'.$title_en.'</p>
<p>Số Tập: '.$epname.' </p>
<p>Năm sản xuất: '.$year.' </p>
<div class="clearfix tip-info-bt">
<ul class="tip-info-bottom pull-right">
<li><span title="Phụ đề Việt" class="tagsInfo redTag">Vi</span></li>
<li><span title="Phụ đề Anh" class="tagsInfo redTag">En</span></li>
<li><span title="Chất lượng HD 720p" class="tagsInfo greenTag"><strong>HD</strong></span></li>
</ul>
</div>
<div class="tn-contentdecs mb10">
'.$content.'
</div>
<div class="clearfix">
<a href="javascript:void(0)" onclick="viewYT(\'mocutgtqWxI\')" class="btn tn-btn-view pull-left">Trailer</a>
<a href="'.$url.'" class="btn tn-btn-view2 btn-like-add pull-right later-for-10289">Xem ngay</a>
</div> </div>
		'.$epnames.' </div>
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
<script type="text/javascript" src="/assets/js/jquery.hoverIntent.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery.cluetip.min.js"></script>

<script>
$(document).ready(function(){buildTooltip();});
function buildTooltip(){$('.jt').cluetip({cluetipClass:'jtip',attribute:'data-jtip',local:true,arrows:true,dropShadow:true,hoverIntent:true,sticky:true,topOffset:10,mouseOutClose:'both',delayedClose:100,cluezIndex:499,width:280,arrowPixelAdded:200,closePosition:'title'})};
window.AppData = JSON.parse('{"ajax":{"_token":"2AQpt7hTUb8ccVCBxgsSHoRp758CBnHPdnW929TH"},"events":["common","common.lazyLoadingSetup","common.hotMovieSliderSetup","common.vexSetup","SearchForm","slider","common.loginHandler","common.feedbackHandler","common.requireHandler"]}');</script>

	
<?php
include View::TemplateView('footer');
?>
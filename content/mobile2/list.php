<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
if($mode=='search'){
	$titlepage = 'Tìm kiếm';
}else{
	$titlepage = 'Danh sách';
}
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
$num		= 	config_site('list_limit');
$num 		= 	intval($num);
$page 		= 	intval($page);
if (!$page) 	$page = 1;
$limit 		= 	($page-1)*$num;
if($limit<0) 	$limit=0;
$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.title_en,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.quality,tb_film.year,tb_film.filmlb,tb_film.thuyetminh,tb_film.category,tb_film.trailer','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql $orderby LIMIT $limit,$num");
$bg_thumb = TEMPLATE_URL.'images/grey.jpg';
$total = MySql::dbselect('tb_film.id','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql");
$allpage_site = get_allpage(count($total),$num,$page,$url_page.'page-');
?>
<div class="tn-main">
<div class="tn-breadcrumb">
<ol class="breadcrumb">
<li><h2><a href="<?php echo SITE_URL;?>">Trang Chủ</a></h2></li>
<li><h2><a href="<?php echo $url_page;?>"><?php echo $titlepage;?></a></h2></li>
<li class="active"><h2><?php echo $title_page;?></h2></li>
</ol>
<div class="social_list">
<div class="fb-like" style="line-height: 11px" data-href="https://www.facebook.com/Hayphim.TV" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
<a class="twitter-share-button" href="<?php echo SITE_URL;?>" data-count="horizontal" data-size="medium"></a>
<div class="g-follow" data-annotation="horizontal-bubble" data-height="20" data-href="//plus.google.com/103028018587298879597" data-rel="author"></div>
<div data-href="<?php echo SITE_URL;?>" class="g-plusone" data-size="medium"></div>
</div>
<a href="javascript:void(0);" id="tn-afilter" class="btn btn-link"> Lọc Phim <i class="fa fa-angle-down"></i> <i class="fa fa-angle-up"></i> </a>
<div id="filterdv" class="tn-filterdv">
<div class="tn-filterdv-wrap">
<div class="tn-filter-in">
<ul>
<li class="filter-item filter-cat"><span class="filter-title">Thể loại</span>
<ul class="filter-item-lst">
<?php echo category_a_f($catid);?>
</ul>
</li>
<li class="filter-item filter-country"> <span class="filter-title">Quốc gia</span>
<ul class="filter-item-lst">
<?php echo country_a_f($couid);?>
</ul>
</li>
<li class="filter-item filter-vol">
<span class="filter-title">ÂM THANH</span>
<ul class="filter-item-lst">
<li><a data-vol="1" href="#" title="Phụ đề">Phụ đề</a></li>
<li><a data-vol="2" href="#" title="Thuyết minh">Thuyết minh</a></li>
</ul>
<span class="filter-title" style="margin-top:10px">PHÂN LOẠI</span>
<ul class="filter-item-lst">
<li><a data-type="0" href="#" title="Phụ đề">Phim lẻ</a></li>
<li><a data-type="1" href="#" title="Thuyết minh">Phim bộ</a></li>
</ul>
</li>
<li class="filter-item filter-qual"> <span class="filter-title">CHẤT LƯỢNG</span>
<ul class="filter-item-lst">
<?php echo quality_a_f($qualityid);?>
</ul>
</li>
<li class="filter-item filter-year"> <span class="filter-title">Năm sản xuất</span>
<ul class="filter-item-lst mmyear">
<?php echo filmyear_a_f($getyear);?>
</ul>
</li>
</ul>
</div>
<div class="text-right">
<a href="#" class="btn tn-btn-default afilter-close" onclick="getFilmFilter();">LỌC PHIM</a>
</div>
</div>
</div>
<script>

function getFilmFilter(page){

	var url = "frontend/film/filter";

	if (!page){

		page = 1;

	}

	var arrayCategory = [];

	var arrayCountry = [];

	var arrayVol = [];

	var arrayQuality = [];

	var arrayYear = [];

	var arrayType = [];

	$(".filter-item ul li a.active").each(function(index, element) {

	    if ($(this).data("category") != undefined){

	    	arrayCategory.push($(this).data("category"));

		}

	 	if ($(this).data("country") != undefined){

	    	arrayCountry.push($(this).data("country"));

	 	}

		if ($(this).data("vol") != undefined){

	    	arrayVol.push($(this).data("vol"));

	 	}

		if ($(this).data("qual") != undefined){

	    	arrayQuality.push($(this).data("qual"));

	 	}

		if ($(this).data("year") != undefined){

	    	arrayYear.push($(this).data("year"));

	 	}

		if ($(this).data("type") != undefined){

			arrayType.push($(this).data("type"));

	 	}

	});

	$.ajax({

		url: url,

		type: "GET",

		data:{	arrayCountry: arrayCountry.join(','),

				arrayCategory: arrayCategory.join(','),

				arrayVol: arrayVol.join(','),

				arrayQuality: arrayQuality.join(','),

				arrayYear: arrayYear.join(','),

				arrayType: arrayType.join(','),

				page: page

			 },

		success: function(data){

			$('#namevn').html(data);

			thumb_view();

			buildTooltip();

			buildScroll();

		}

	});

}

$(document).ready(function(e) {

	if (cookieOnceDay("filtermovie") == true){

		mPopup({title: "Mẹo Sử Dụng", msg: "Sử dụng chức năng <strong>Lọc Phim</strong> trên thanh công cụ để lọc những phim bạn đang cần xem chính xác nhất.", position: "top center"});

		setVCookie("filtermovie", new Date());

	}

});

</script> </div>

<div id='ajax'>
<section class="tn-boxsty">
<div class="tn-boxsty-tt"><h2><a href="#">Tất Cả Phim <?php echo $title_page;?><i class="fa fa-angle-right"></i></a></h2></div>
<div class="tn-boxsty-dv">
<div class="tn-nolist_carousel">
<ul id="cat_tatca" class="view-thumb-res">
		<?php 
			for($i=0;$i<count($arr);$i++) {
				$filmid = $arr[$i][0];
				$title = $arr[$i][1];
				$title_en = $arr[$i][2];
				$quality = $arr[$i][7];
				$content = CutName(RemoveHtml(UnHtmlChars($arr[$i][6])),220);
				$year = $arr[$i][8];
				$thumb = $arr[$i][3];
				$filmlb = $arr[$i][9];
				$thuyetminh = $arr[$i][10];
				$cat = $arr[$i][11];
				$trailer = $arr[$i][12];		
				if($trailer!="") {
				$ytubeid = VideoYoutubeID($trailer);
				$trailers = '<a href="javascript:void(0)" onclick="viewYT(\''.$ytubeid .'\')" class="btn tn-btn-view pull-left">Trailer</a>';
				}
				$url = get_url($arr[$i][0],$title,'Phim');
				$url2 = get_url_iframe($arr[$i][0],$title,'Phim');
				//if($quality) $quality = "<i class=\"qt\">$quality $phude</i>";
				$episode = MySql::dbselect('id,name','episode',"filmid = '$filmid' order by id desc limit 1");
				$epname = $episode[0][1];
				if($filmlb!=0){
					$type = 'phimbo';
				}
				if($thuyetminh == 1){
					$phude = '<i class="fa fa-volume-up"></i>';
				}else{
					$phude = 'VI';
				}
				if($epname && $type == 'phimbo') $epnames = "<i class=\"qt\">Tập $epname | $phude</i>";
		?>
		<li>
<div class="tn-bxitem">
<a href="<?php echo $url2;?>" class="jt bxitem-link" data-jtip="#cat_all-<?php echo $filmid;?>">
<?if($type=='phimbo'){?>
			<span class="bxitem-episodes"> <span>Tập<br><font size='5'><?=CutEp($epname,3)?></font></span></span>
			<?}?>
<span class="bxitem-img">
<img src="<?php echo $thumb;?>" width="180" height="270" alt="<?php echo $title.' - '.$title_en;?>">
</span>
<h1 class="bxitem-txt"> <?php echo $title;?> </h1>
<span class="bxitem-over_play"></span>
</a>
<div id="cat_all-<?php echo $filmid;?>">
<p class="name-vi"><?php echo $title_en;?></p>
<p class="name-en"><?php echo $title;?></p>
<p>Năm sản xuất: <?php echo $year;?> </p>
<div class="clearfix tip-info-bt">
<span class="tn-pcolor1"><?=category_tip($cat,0)?></span>
<ul class="tip-info-bottom pull-right">
<li><span title="" class="tagsInfo redTag"><?=$phude?></span></li>
<li><span title="Chất lượng <?=$quality?>" class="tagsInfo greenTag"><strong><?=$quality?></strong></span></li>
</ul>
</div>
<div class="tn-contentdecs mb10">
<?=$content?>
</div>
<div class="clearfix">
<?=$trailers?>
<a href="javascript:void(0)" onclick="setLater(<?php echo $filmid;?>, '.later-for-<?php echo $filmid;?>')" class="btn tn-btn-view2 btn-like-add pull-right later-for-<?php echo $filmid;?>">Xem sau</a>
<a href="javascript:void(0)" onclick="setLike(<?php echo $filmid;?>, '.like-for-<?php echo $filmid;?>')" class="btn tn-btn-view2 pull-right mr05 btn-like-add like-for-<?php echo $filmid;?>">Yêu thích</a>
</div> </div>
</div>
</li>
		
		<?php } ?>
	</ul>
	<div class="tn-pagination">
	<?php echo $allpage_site;?>
	</div>
</div>
</div>
</div>
<?php
include View::TemplateView('footer');
?>
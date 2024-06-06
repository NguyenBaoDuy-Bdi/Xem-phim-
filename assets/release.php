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
		else $byorder = 'title ASC';
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
$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.title_en,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.quality,tb_film.year,tb_film.timeupdate,tb_film.release_time','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"release_time!='' $orderby LIMIT $limit,$num");
$bg_thumb = TEMPLATE_URL.'images/grey.jpg';
$total = MySql::dbselect('tb_film.id','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"release_time!=''");
$allpage_site = get_allpage(count($total),$num,$page,$url_page.'page-');
?>
<div class="ui page grid apply-margin">
<div class="sixteen wide column">
<h1 class="ui dividing header with-huge-letter">
<span class="border"><?php echo $title_page;?></span>
<span class="description">ESTIMATED TIME UNTIL NEXT RELEASE</span>
</h1>
<div class="ui doubling five column grid">
		<?php 
		for($i=0;$i<count($arr);$i++) {
				$filmid = $arr[$i][0];
				$title = $arr[$i][1];
				$title_en = $arr[$i][2];
				$quality = $arr[$i][7];
				$year = $arr[$i][8];
				$timeupdate = $arr[$i][9];
				$thumb = $arr[$i][3];
				$url = get_url($arr[$i][0],$title,'Phim');
				$release_time = $arr[$i][10];
		?>
		<div class="column">
		<div class="ui latest card">
		<div class="image">
		<img src="<?php echo $thumb;?>" style="height:288px">
		</div>
		<div class="overlay">
		<div class="actions">
		<a href="<?php echo $url;?>" class="ui inverted blue button">
		<i class="list icon"></i> All episodes
		</a>
		</div>
		</div>
		<div class="content top">
		<a href="<?php echo $url;?>" class="title">
		<?php echo CutName($title,25);?>
		</a>
		</div>
		<div class="content bottom">
		<div class="description">
		<?php 
		$timezone = date_default_timezone_set('Asia/Ho_Chi_Minh');
		$next_release = strtotime(date('M d Y', strtotime("next $release_time")));		
		$remaining = $next_release - time();
		$days_remaining = floor($remaining / 86400);
		$hours_remaining = floor(($remaining % 86400) / 3600);
		$remaining = $remaining % (60 * 60);
		$minutes = floor($remaining / 60);	
		if($days_remaining != 0){
			echo $days_remaining.' days '.$hours_remaining.' hrs '.$minutes.' mins';
		}else if($hours_remaining != 0){
			echo $hours_remaining.' hrs '.$minutes.' mins';
		}else{
			echo $minutes.' mins';
		}		 
		?>
		
		</div>
		</div>
		</div>
		</div>
		<?php } ?>
	</div>
<div class="ui hidden divider"></div>
	<?php echo $allpage_site;?>
</div>
</div>
</div>
</div>
</div>
<?php
include View::TemplateView('footer');
?>
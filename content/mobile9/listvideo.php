<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
if($geturl[2]) {
	$page = explode('-',$geturl[2]);
}
$page		= 	$page[1];
$num		= 	12;
$num 		= 	intval($num);
$page 		= 	intval($page);
if (!$page) 	$page = 1;
$limit 		= 	($page-1)*$num;
if($limit<0) 	$limit=0;
$arr = MySql::dbselect('id,name,url,duration,thumb','media',"id != 0 order by id desc LIMIT $limit,$num");
$total = MySql::dbselect('id','media',"id != 0");
$allpage_site = get_allpage(count($total),$num,$page,SITE_URL."/video/page-");
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
					<?php
						for($i=0;$i<count($arr);$i++) {
							$id = $arr[$i][0];
							$name = $arr[$i][1];
							$url = get_url($id,$name,'Xem Video');
							$duration = $arr[$i][3];
							$thumb = $arr[$i][4];
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
<a href="<?php echo $url;?>" title="Xem phim"><?php echo $name;?></a>
<em class="subtitle"><?php echo $duration;?></em>
</p>

<p class="card-category">
<i class="fa fa-bolt"></i> <?php echo CutName($name,30);?> </p>
<p class="card-info"> <?=$content?></p>
</div>
</div>
</div>
</div>
					
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
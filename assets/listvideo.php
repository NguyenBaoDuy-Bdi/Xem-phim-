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
<div class="main-slider has-dots" style="overflow: hidden; width: 960px; height: 320px;">
    <ul class="unstyled-list list-inline">

    <?php echo slider_film("slider = '1'",5);?>


 </ul>
    <ol class="dots">
       
    </ol></div>
<div class="row">
	<div class="col-lg-8">
		<section id="main-content">
			<div class="block-content">
				<div class="bc-header"> 
					<img class="heading-icon" src="<?php echo SITE_URL;?>/assets/img/icon_cup.png" alt="">
					<h3>Danh sách Clip</h3>
				</div>
				<div class="bc-content film-grid">
    				<div class="film-grid-content">
						<div class="row">
						<?php
						for($i=0;$i<count($arr);$i++) {
							$id = $arr[$i][0];
							$name = $arr[$i][1];
							$url = get_url($id,$name,'Xem Video');
							$duration = $arr[$i][3];
							$thumb = $arr[$i][4];
					?>

					<div class="film-grid-item">
    <div class="film-thumbnail">
        <a href="<?php echo $url;?>"> <img class="lazy" alt="<?php echo $name;?>" title="<?php echo $name;?>" style="height: 106px; display: inline-block;" src="<?php echo $thumb;?>">
            <div class="hover-play-btn"></div>
        </a>
    </div>
    <div class="film-info"> <a href="<?php echo $url;?>" class="title"><?php echo $name;?></a> </div>
</div>
		<?php } ?>


						</div>
					</div>
				</div>
				<ul class="pagination pull-right">
				<?php echo $allpage_site;?>
				</ul>
			</div>
		</section>
	</div>
	<div class="col-lg-4">
    <section id="main-sidebar">
        <div class="sidebar-block" style="border: 0;box-shadow: none;margin-top: 72px;">
            <div class="fb-page"> <img src="<?php echo SITE_URL;?>/assets/img/logo.png" alt="Phim Hay HD">
                <h5>Like fanpage để cập nhật phim mỗi ngày</h5>
                <div class="fb-like-box fb_iframe_widget" data-href="http://www.facebook.com/hayphim.TV" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false" data-width="250" fb-xfbml-state="rendered"
                fb-iframe-plugin-query="app_id=803198449807533&amp;color_scheme=light&amp;container_width=300&amp;header=false&amp;href=http%3A%2F%2Fwww.facebook.com%2Frealphim&amp;locale=en_US&amp;sdk=joey&amp;show_border=false&amp;show_faces=true&amp;stream=false&amp;width=250">
                </div>
            </div>
        </div>
    </section>
</div>
</div>
<script>window.AppData = JSON.parse('{"ajax":{"_token":"2AQpt7hTUb8ccVCBxgsSHoRp758CBnHPdnW929TH"},"events":["common","common.lazyLoadingSetup","common.hotMovieSliderSetup","common.vexSetup","SearchForm","slider","common.loginHandler","common.feedbackHandler","common.requireHandler"]}');</script>
<?php
include View::TemplateView('footer');
?>
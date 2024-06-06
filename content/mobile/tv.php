<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
if($type !== '1') {
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
					
					<h3>Danh sách kênh</h3>
				</div>
				<div class="bc-content film-grid">
    				<div class="film-grid-content">
						<div class="row">

<?php
			$livetv = MySql::dbselect('id,symbol,name,quality,speed,thumb','tv',"$sql");
			for($i=0;$i<count($livetv);$i++) {
				$id = $livetv[$i][0];
				$name = $livetv[$i][2];
				$symbol = $livetv[$i][1];
				$thumb = $livetv[$i][5];
				$url = get_url($id,$symbol,'Live TV');
				?>

<div class="film-grid-item">
    <div class="film-thumbnail">
        <a href="<?php echo $url;?>"> <img class="lazy" alt="<?php echo $symbol.' - '.$name;?>" title="<?php echo $symbol.' - '.$name;?>" style="height: 106px; display: inline-block;" src="<?php echo $thumb;?>">
            <div class="hover-play-btn"></div>
        </a>
    </div>
    <div class="film-info"> <a href="<?php echo $url;?>" class="title"><?php echo $symbol.' - '.$name;?></a> </div>
</div>





		<?php	}
		?>



</div>
					</div>
				</div>
</div>
		</section>
	</div>
	<div class="col-lg-4">
    <section id="main-sidebar">
        <div class="sidebar-block" style="border: 0;box-shadow: none;margin-top: 72px;">
            <div class="fb-page"> <img src="<?php echo SITE_URL;?>/assets/img/logo.png" alt="Phim Hay HD">
                <h5>Like fanpage để cập nhật phim mỗi ngày</h5>
                <div class="fb-like-box fb_iframe_widget" data-href="http://www.facebook.com/hayphim.TV" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false" data-width="250" fb-xfbml-state="rendered"
                fb-iframe-plugin-query="app_id=803198449807533&amp;color_scheme=light&amp;container_width=300&amp;header=false&amp;href=http%3A%2F%2Fwww.facebook.com%2Fhayphim.tv&amp;locale=en_US&amp;sdk=joey&amp;show_border=false&amp;show_faces=true&amp;stream=false&amp;width=250">
                </div>
            </div>
        </div>
    </section>
</div>
</div>
<script>window.AppData = JSON.parse('{"ajax":{"_token":"2AQpt7hTUb8ccVCBxgsSHoRp758CBnHPdnW929TH"},"events":["common","common.lazyLoadingSetup","common.hotMovieSliderSetup","common.vexSetup","SearchForm","slider","common.loginHandler","common.feedbackHandler","common.requireHandler"]}');</script>

<?php }else { 
$name = $livetv[0][2];
$linktv = $livetv[0][7];
$thumb = $livetv[0][8];
$lang = $livetv[0][9];
$quality = $livetv[0][3];
$speed = $livetv[0][4];
$viewed = $livetv[0][5];
$content = $livetv[0][6];
$urltv = get_url($id,$symbol,'Live TV');
?>
<div class="row">
    <div class="col-lg-12">
        <div id="film-content">
<iframe scrolling="no" frameborder="0" style="border: medium none; width: 900px; height: 500px;" allowtransparency="true" src="<?php echo $linktv;?>" allowfullscreen></iframe>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <span style="color: red; font-size: 24px; margin-top: 10px;"><?php echo $symbol;?> - <?php echo $name;?></span>
        <br />
        <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $urltv;?>&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=21&amp;appId=803198449807533" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowtransparency="true"></iframe>
        <h3>Bình luận</h3>
        <div class="fb-comments fb_iframe_widget fb_iframe_widget_fluid" data-href="<?php echo $urltv;?>" data-numposts="10" data-colorscheme="light" data-width="100%" fb-xfbml-state="rendered"></div>
    </div>                
</div>
        <div class="block-content">
    <div class="bc-header">
        <h2>Video Hay có thể bạn thích xem</h2> </div>
    <div class="bc-content film-grid">
        <div class="slide-container mCustomScrollbar _mCS_4" data-custom-scrollbar="true" data-custom-scrollbar-horizontal="true">
            <div class="mCustomScrollBox mCS-light mCSB_horizontal" id="mCSB_4" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
                <div class="mCSB_container" style="left: 0px; width: 1944px; position: relative;">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12">
                            <div class="film-grid-content clearfix has-scrollbar" style="width: 1944px ">
                                    <?php echo get_video('id != 0',24,'rand');?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
include View::TemplateView('footer');
?>
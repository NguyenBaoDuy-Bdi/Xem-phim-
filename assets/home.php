<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
?>
<div class="main-slider has-dots" style="overflow: hidden; width: 960px; height: 320px;">
    <ul class="unstyled-list list-inline">

    <?php echo slider_film("slider = '1'",8);?>


 </ul>
    <ol class="dots">
       
    </ol></div>

<div class="row">
	<div class="col-lg-12 col-xs-12" style="margin-top: 10px;">
		<div class="bx-wrapper" style="max-width: 2896px; margin: 0px auto;">
			<div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 145px;">
				<div id="hot-movies" class="bxslider" style="width: 815%; position: relative; transition-duration: 0s; transform: translate3d(-1935.9375px, 0px, 0px);">
				<?php echo li_video();?>
				</div>
			</div>
		</div>
			
	</div></div>
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
	<div class="col-lg-12 col-xs-12">
		<section id="main-content">

			<div class="block-content">
				<div class="bc-header"> <img class="heading-icon" src="<?php echo SITE_URL;?>/assets/img/icon_cup.png" alt="">
    				<h2>
    					<a href="">Phim Đề Cử</a>
    				</h2></div>
    			<div class="bc-content film-grid">
    				<div class="slide-container mCustomScrollbar _mCS_1" data-custom-scrollbar="true" data-custom-scrollbar-horizontal="true">
    					<div class="mCustomScrollBox mCS-light mCSB_horizontal" id="mCSB_1" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
    							<div class="mCSB_container" style="left: 0px; width: 1944px; position: relative;">
									<div class="row">
										<div class="col-lg-12 col-xs-12">
											<div class="film-grid-content clearfix has-scrollbar" style="width: 1944px ">
											<?php echo decu1();?>
											</div>
										</div>
									</div>
								</div>
    					</div>
    				</div>
    			</div>
				
    		
               </div>


			<div class="block-content">
				<div class="bc-header"> <img class="heading-icon" src="<?php echo SITE_URL;?>/assets/img/icon_cup.png" alt="">
    				<h2>
    					<a href="/danh-sach/phim-le/">Phim lẻ mới</a>
    				</h2>
					
					</div>
    			<div class="bc-content film-grid">
    				<div class="slide-container mCustomScrollbar _mCS_1" data-custom-scrollbar="true" data-custom-scrollbar-horizontal="true">
    					<div class="mCustomScrollBox mCS-light mCSB_horizontal" id="mCSB_1" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
    							<div class="mCSB_container" style="left: 0px; width: 1944px; position: relative;">
									<div class="row">
										<div class="col-lg-12 col-xs-12">
											<div class="film-grid-content clearfix has-scrollbar" style="width: 1944px ">
											<?php echo li_film1('phimle','12');?>
											</div>
										 </div>
									</div>
								</div>
    					</div>
    				</div>
    			</div>
    			<a href="/danh-sach/phim-le/" class="view-all">Xem tất cả</a>
			</div>
			 <br> 

			<div class="block-content">
				<div class="bc-header"> <img class="heading-icon" src="<?php echo SITE_URL;?>/assets/img/icon_cup.png" alt="">
    				<h2>
					 <a href="/danh-sach/phim-bo/">Phim bộ mới</a>
    				</h2></div>
    			<div class="bc-content film-grid">
    				<div class="slide-container mCustomScrollbar _mCS_1" data-custom-scrollbar="true" data-custom-scrollbar-horizontal="true">
    					<div class="mCustomScrollBox mCS-light mCSB_horizontal" id="mCSB_1" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
    							<div class="mCSB_container" style="left: 0px; width: 1944px; position: relative;">
									<div class="row">
										<div class="col-lg-12 col-xs-12">
											<div class="film-grid-content clearfix has-scrollbar" style="width: 1944px ">
											<?php echo li_film1('phimbo','12');?>
											</div>
										</div>
									</div>
								</div>
    					</div>
    				</div>
    			</div>
    			<a href="/danh-sach/phim-bo/" class="view-all">Xem tất cả</a>
			</div>



                        <div class="block-content">
				<div class="bc-header"> <img class="heading-icon" src="<?php echo SITE_URL;?>/assets/img/icon_cup.png" alt="">
    				<h2>
    					<a href="/the-loai/phim-hanh-dong/">Phim Hành Động</a>
    				</h2></div>
    			<div class="bc-content film-grid">
    				<div class="slide-container mCustomScrollbar _mCS_1" data-custom-scrollbar="true" data-custom-scrollbar-horizontal="true">
    					<div class="mCustomScrollBox mCS-light mCSB_horizontal" id="mCSB_1" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
    							<div class="mCSB_container" style="left: 0px; width: 1944px; position: relative;">
									<div class="row">
										<div class="col-lg-12 col-xs-12">
											<div class="film-grid-content clearfix has-scrollbar" style="width: 1944px ">
											<?php echo li_film1('category',12,',1,');?>
											</div>
										</div>
									</div>
								</div>
    					</div>
    				</div>
    			</div>
    			<a href="/the-loai/phim-hanh-dong/" class="view-all">Xem tất cả</a>
			</div>

                        <div class="block-content">
				<div class="bc-header"> <img class="heading-icon" src="<?php echo SITE_URL;?>/assets/img/icon_cup.png" alt="">
    				<h2>
    					<a href="/the-loai/phim-ma-kinh-di/">Phim Kinh Dị</a>
    				</h2></div>
    			<div class="bc-content film-grid">
    				<div class="slide-container mCustomScrollbar _mCS_1" data-custom-scrollbar="true" data-custom-scrollbar-horizontal="true">
    					<div class="mCustomScrollBox mCS-light mCSB_horizontal" id="mCSB_1" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
    							<div class="mCSB_container" style="left: 0px; width: 1944px; position: relative;">
									<div class="row">
										<div class="col-lg-12 col-xs-12">
											<div class="film-grid-content clearfix has-scrollbar" style="width: 1944px ">
											<?php echo li_film1('category',12,',21,');?>
											</div>
										</div>
									</div>
								</div>
    					</div>
    				</div>
    			</div>
    			<a href="/the-loai/phim-ma-kinh-di/" class="view-all">Xem tất cả</a>
			</div>
			<br> 

                        <div class="block-content">
				<div class="bc-header"> <img class="heading-icon" src="<?php echo SITE_URL;?>/assets/img/icon_cup.png" alt="">
    				<h2>
    					<a href="/the-loai/game-show/">TV Show</a>
    				</h2></div>
    			<div class="bc-content film-grid">
    				<div class="slide-container mCustomScrollbar _mCS_1" data-custom-scrollbar="true" data-custom-scrollbar-horizontal="true">
    					<div class="mCustomScrollBox mCS-light mCSB_horizontal" id="mCSB_1" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
    							<div class="mCSB_container" style="left: 0px; width: 1944px; position: relative;">
									<div class="row">
										<div class="col-lg-12 col-xs-12">
											<div class="film-grid-content clearfix has-scrollbar" style="width: 1944px ">
											<?php echo li_film1('category',12,',31,');?>
											</div>
										</div>
									</div>
								</div>
    					</div>
    				</div>
    			</div>
    			<a href="/the-loai/game-show/" class="view-all">Xem tất cả</a>
			</div>


                        <div class="block-content">
				<div class="bc-header"> <img class="heading-icon" src="<?php echo SITE_URL;?>/assets/img/icon_cup.png" alt="">
    				<h2>
    					<a href="/the-loai/phim-hoat-hinh/">Phim Hoạt Hình</a>
    				</h2></div>
    			<div class="bc-content film-grid">
    				<div class="slide-container mCustomScrollbar _mCS_1" data-custom-scrollbar="true" data-custom-scrollbar-horizontal="true">
    					<div class="mCustomScrollBox mCS-light mCSB_horizontal" id="mCSB_1" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
    							<div class="mCSB_container" style="left: 0px; width: 1944px; position: relative;">
									<div class="row">
										<div class="col-lg-12 col-xs-12">
											<div class="film-grid-content clearfix has-scrollbar" style="width: 1944px ">
											<?php echo li_film1('category',12,',4,');?>
											</div>
										</div>
									</div>
								</div>
    					</div>
    				</div>
    			</div>
    			<a href="/the-loai/phim-hoat-hinh/" class="view-all">Xem tất cả</a>
			</div>


			<div class="block-content">
				<div class="bc-header"> <img class="heading-icon" src="<?php echo SITE_URL;?>/assets/img/icon_cup.png" alt="">
    				<h2>
    					<a href="/the-loai/trailer-phim-moi/">Phim Sắp Chiếu</a>
    				</h2></div>
    			<div class="bc-content film-grid">
    				<div class="slide-container mCustomScrollbar _mCS_1" data-custom-scrollbar="true" data-custom-scrollbar-horizontal="true">
    					<div class="mCustomScrollBox mCS-light mCSB_horizontal" id="mCSB_1" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
    							<div class="mCSB_container" style="left: 0px; width: 1944px; position: relative;">
									<div class="row">
										<div class="col-lg-12 col-xs-12">
											<div class="film-grid-content clearfix has-scrollbar" style="width: 1944px ">
											<?php echo li_film1('category',12,',42,');?>
											</div>
										</div>
									</div>
								</div>
    					</div>
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
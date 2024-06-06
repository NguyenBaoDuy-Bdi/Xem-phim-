<div class="main">
	<div class="container">
		<div class="row">
			<div class="widget stacked">
				<div class="widget-header">
					<i class="icon-bookmark"></i>
					<h3>Menu nhanh</h3>
				</div>
				<!-- /widget-header -->
				<div class="widget-content">
					<div class="shortcuts">
						<a href="?action=film" class="shortcut"><i class="shortcut-icon icon-film"></i><span class="shortcut-label">Phim</span></a>
						<a href="<?=SITE_URL?>/post/huong-dan-kiem-tien/" target="_blank" class="shortcut"><i class="shortcut-icon icon-money"></i><span class="shortcut-label">Hướng dẫn</span></a>
					</div>
					
					<!-- /shortcuts -->
				</div>
				<!-- /widget-content -->
			</div>
			<div class="widget">
				<div class="widget-header">
					<i class="icon-file"></i>
					<h3>Member Upload</h3>
				</div>
				<div class="widget-content">
					<p>
						Bản quyền thuộc về HayPhimTV
					</p>
                    <p>
                    Timezone on server: <?php date_default_timezone_set('Asia/Bangkok'); echo date_default_timezone_get();echo " ".date('Y-m-d H:i:s');;?>
                    </p>
				</div>
			</div>
		</div>
	</div>
</div>
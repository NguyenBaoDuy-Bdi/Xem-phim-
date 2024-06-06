<div class="main">
	<div class="container">
	<?php if($Admingroup == '1') echo '<pre>Lưu ý: Bạn đang nằm trong nhóm <b>hợp tác viên</b>, bạn sẽ bị hạn chế một số chức năng thêm/sửa/xóa thông tin trên website.</pre>';?>
		<div class="widget stacked">
			<div class="widget-header">
				<i class="icon-check"></i>
				<h3>Xóa cache</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
			<?php
				if($Admingroup == '2') {
					$path = CACHE_PATH;
					$actor	= 	TEMPLATE_PATH."js/actor.js";
					$search	= 	TEMPLATE_PATH."js/search.js";
					array_map('unlink', glob($path."config/*"));
					array_map('unlink', glob($path."xml/*"));
					unlink($actor);
					unlink($search);
					echo 'Đã tạo lại Cache. Nhấn để tạo lại <a href="/sitemap.xml" target="_blank">Sitemap</a> và <a href="/rss/" target="_blank">RSS</a>';
				} else {
					echo 'Chức năng này chỉ dảnh cho Quản trị viên';
				}
			?>
			</div>
		</div>
	</div>
</div>
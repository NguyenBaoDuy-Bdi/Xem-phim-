<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
?>

<footer class="footer">
<div class="container">
<p>Copyright © 2016 GLAphim.TV All Rights Reserved</p>
<p>Hiện tại chúng tôi chỉ hỗ trợ một số dòng máy Android 4.x (trình duyệt Chrome), iOS 7.x trở lên.</p>
</div>
</footer>
<script>
function updateMovieView(e){$.ajax({url:base_url+"ajax/movie_update_view",type:"POST",dataType:"json",data:{id:e},success:function(){}})}
</script>
<style>.tab-content .tab-pane{position:relative;}.tab-content{position:relative;overflow:hidden;}</style>
<script src="<?php echo TEMPLATE_M_URL;?>skin/material/js/base.js?v=002"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_M_URL;?>skin/material/js/lib.vp.js?v=002"></script>

		

					
</body>
</html>

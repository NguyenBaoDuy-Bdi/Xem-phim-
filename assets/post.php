<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
?>
<div style="margin-top:60px" class="none-space-top"></div>
<div class="p-profile clearfix" style="color:#fff">
	<div class="user-info" style="width:90%">
		<label class="tit" style="font-size:25px"><?php echo $title;?></label>
		<div class="stat" style="color:#fff">
			<?php echo $content;?>
		</div>
	</div>
</div>
<?php
include View::TemplateView('footer');
?>
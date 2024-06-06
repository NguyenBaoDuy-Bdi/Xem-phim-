<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
?>
<div class="content">
<div class="content-heading">
</div>
<div class="content-inner">
<div class="container" style="margin-top: 0px;">
<div class="row">
<div id="mobile-player" style="background-color: #fff;">
			<?php echo player($url,'video');?>
			</div>
<div class="col-lg-12 col-sm-12" id="info-player">

<div class="card thumb-relate-movie">
<div class="card-main">
<p class="title-cast-parent">Video khác</p>
<div class="thumb-img-list">
<ul>
<?php echo get_video('id != 0',8,'rand');?>
</ul>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-12 col-sm-12">
<div class="comment_facebook">
<div class="fb-comments" data-version="v2.3" data-href="<?php echo $urlvideo;?>" data-num-posts="10" data-width="100%"></div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
include View::TemplateView('footer');
?>
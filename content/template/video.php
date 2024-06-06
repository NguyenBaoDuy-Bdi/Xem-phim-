<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
?>
 <div class="watch-title">
	<div class="wap-tile">
		<h2><a href="<?php echo $urlvideo;?>" title="<?php echo $name;?>"><?php echo $name;?></a></h2>
	</div>
</div>
<div class="watch-title" style="padding: 0 5% 0px 5%;">
	<div class="watch-now" style="position:relative">
		<div class="player" style="position:relative;width: 900px; height: 500px;z-index:501">
			<?php echo player($url,'video');?>
			<div id="rkplayer">
			</div>
		</div>
				<script> 
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1626760094296436',
      xfbml      : true,
      version    : 'v2.8'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>
				
				 </div>
 <div id="commentfb">
                <div class="fb-comments"
                     data-href="<?php echo $urlvideo;?>"
                     data-width="100%"
                     data-numposts="5"></div>
            </div>
       <div class="movies-list-wrap mlw-related">
                    <div class="ml-title ml-title-page">
                        <span>Video Hay Khác</span>
                    </div>
                    <div class="video-list video-list-full">       
                                    <?php echo get_video('id != 0',12,'rand');?>
                         <script type="text/javascript">
        
    $("img.lazy").lazyload({
        effect: "fadeIn"
    });
</script>
                    </div>
                </div>
                <!--/related-->
            </div>

          

        </div>
    </div>
</div>

<?php
include View::TemplateView('footer');
?>
<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
?>
 <div class="pad"></div>
        <div class="main-content main-detail">
            <div class="main-content main-category">
			<div id="bread">
                    <ol class="breadcrumb">
                        <li><a href="<?=SITE_URL?>/">Home</a></li>
                        <li><a href="#">Xem Video</a></li>
                        <li class="active"><?=$name?></li>
                    </ol>
                </div>
<style> 
  .overlay {
      position : absolute;
      top : 0;
      left : 0;
      right : 0;
      bottom : 0;
      cursor : pointer;
  }
  </style>


                <div id="mv-info">
<script type="text/javascript" src="/jwplayer/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key="vmAEdu5OJSCiJfE3aWibJZ6338lN/A7tybduu0fdEfxYgi7AkWpjckRUFeI=";</script>
<div id="mediaplayer"></div>
<div class="overlay">&nbsp;</div>
<script type="text/javascript">jwplayer("mediaplayer").setup({
		file: "<?=$url?>",
		logo: {
		file: "http://hayphim.com/content/mobile/images/logo.png",
		link: "http://hayphim.com",
		position: "top-left",
		opacity: ""
		},
        autostart: "true",
		height: "600",
        width: "100%",
        primary: "html5",
        title: "hayphim.com",
        abouttext:"hayphim.com",
        aboutlink:"http://hayphim.com",
		advertising: {
        client: "/jwplayer/vast.js",
        skipoffset:5,
        skiptext : 'Bỏ qua',
        skipmessage : 'Bỏ qua sau xxs',
        admessage: 'Nhấn Bỏ Qua để xem VIDEO ngay. Quảng cáo hết sau XX giây',
		tag: 'http://delivery.adnetwork.vn/247/xmlvideoad/zid_1441866290/wid_1441866203/type_inline/cb_[timestamp]'
		},
		tracks: [{file: "'.$subtitle.'",
    						label: "Vie",
            				kind: "captions",
            				"default": true	}],
            			    captions: {
							        color: "#FFFFFF",
							        backgroundOpacity: 70
							    	   }});
		$('.overlay').click(function() {
                 jwplayer("mediaplayer").play(true);
                 $(this).hide();
        });
		 </script>
  </div>

   <div id="commentfb">
                <div class="fb-comments"
                     data-href="<?php echo $urlvideo;?>"
                     data-width="100%"
                     data-numposts="5"></div>
            </div>
       <div class="movies-list-wrap mlw-related">
                    <div class="ml-title ml-title-page">
                        <span>You May Also Like</span>
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
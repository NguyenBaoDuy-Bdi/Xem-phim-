<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
?>



<div class="row">
    <div class="col-lg-12">
        <div id="film-content">


<div class="film-player">
    <div class="jwplayer playlist-none" id="the-player" style="width: 100%; height: 540px; opacity: 1; background-color: rgb(0, 0, 0);">

<script src="/jwplayer-7.2.4/jwplayer.js" type="text/javascript"></script>
<script type="text/javascript">jwplayer.key = "E2WUGXWIStlAq431BdAdiHQAbAetgIqw+io+UQ==";</script>
<div id="myElement">HAYPHIM.TV Loading...</div>
<script type="text/javascript">
var playerInstance = jwplayer("myElement");
playerInstance.setup({
     
    file: "<?php echo $url;?>",
    autostart: true,
    type: 'hls',
    width: '100%',
    height: '100%',
    title: 'HayPhim.TV',
    description: 'A video with a basic title and description!',
	advertising: {
    client: '/jw/vast.js',
    admessage: 'Ad: your video resumes in XX seconds...',
    schedule: {
      preroll: {
        offset: 'pre',
        tag: 'http://delivery.adnetwork.vn/247/xmlvideoad/zid_1441866290/wid_1441866203/type_inline/cb_[timestamp]'
      }
    }
  }
});
</script>
    
    </div>
</div>
        </div>
    </div>
</div>
<style type="text/css"> .pos-1 { display: none; } </style>


<div class="row">
    <div class="col-lg-12">
        <span style="color: #f5cc2a; font-size: 24px; margin-top: 10px;"><?php echo $name;?></span>
        <br />
        <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $urlvideo;?>&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=21&amp;appId=803198449807533" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowtransparency="true"></iframe>
        <h3 style="color: #f5cc2a;">Bình luận phim</h3>
        <div class="fb-comments fb_iframe_widget fb_iframe_widget_fluid" data-href="<?php echo $urlvideo;?>" data-numposts="10" data-colorscheme="dark" data-width="100%" fb-xfbml-state="rendered"></div>
    </div>                
</div>
        <div class="block-content">
    <div class="bc-header">
        <h2 style="color: #f5cc2a;">Video Khác</h2> </div>
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

			
			
		<script>window.AppData = JSON.parse('{"ajax":{"_token":"SwOZIu1DEfYAlqIV11IQe9hbYkKY3O7nWdujGGZb"},"events":["common","common.lazyLoadingSetup","film.handleFilmAction","common.vexSetup","SearchForm","slider","common.loginHandler","common.feedbackHandler","common.requireHandler"],"film":{"status":"ok","is_picasa_link":"yes","url":[<?php echo youtube('xao9tRqBd0w');?>],"image":"<?php echo $big_thumb; ?>","type":"picasa"},"jw":{"k":"tu7opZnevAcg1JzkZD50DyvVUBxusDrrQ+PxMQ=="},"url":"http:\/\/hayphim.tv\/"}');</script><link rel="stylesheet" id="vex" href="<?php echo SITE_URL;?>/assets/css/vex.css">

<?php
include View::TemplateView('footer');
?>
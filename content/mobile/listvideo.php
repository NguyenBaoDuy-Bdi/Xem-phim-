<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
if($geturl[2]) {
	$page = explode('-',$geturl[2]);
}
$page		= 	$page[1];
$num		= 	40;
$num 		= 	intval($num);
$page 		= 	intval($page);
if (!$page) 	$page = 1;
$limit 		= 	($page-1)*$num;
if($limit<0) 	$limit=0;
$arr = MySql::dbselect('id,name,url,duration,thumb','media',"id != 0 order by id desc LIMIT $limit,$num");
$total = MySql::dbselect('id','media',"id != 0");
$allpage_site = get_allpage(count($total),$num,$page,SITE_URL."/video/page-");
?>
  <div class="top-content">
    <!-- slider -->
	 <div id="slider">
                <div class="swiper-wrapper">
    <?php echo slider_film("slider = '1'",5);?>
				</div>
		</div>
<!--/slider -->
<!--top news-->
            <div id="top-news">
                <div class="top-news">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#tn-news" role="tab" data-toggle="tab">LATEST NEWS</a></li>
                        <li><a href="#tn-notice" role="tab" data-toggle="tab">NOTICE</a></li>
                    </ul>
                    <div class="top-news-content">
                        <div class="tab-content">
						</div>
					</div>
				</div>
			</div>
</div>
 <!--social home-->
        <div class="social-home">
            <div class="sh-like"><div class="fb-like" data-href="https://www.facebook.com/Hayphim.TV?ref=hl" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div></div>
            <div class="addthis_native_toolbox"></div><span class="sh-text">Like and Share our website to support us.</span>
            <div class="clearfix"></div>
        </div>
        <!--/social home-->
<div class="main-content main-category">

            <!--category-->
            <div class="movies-list-wrap mlw-category">
                <div class="ml-title ml-title-page">
                    <span>Danh sách Video</span>

                    <div class="clearfix"></div>
                </div>
<div class="video-list video-list-full">
						<?php
						for($i=0;$i<count($arr);$i++) {
							$id = $arr[$i][0];
							$name = $arr[$i][1];
							$url = get_url($id,$name,'Xem Video');
							$duration = $arr[$i][3];
							$thumb = $arr[$i][4];
							echo '<div class="ml-item">
            <a href="'.$url.'"              
               class="ml-mask jt"
               title="'.$name.'">
                            
                
                <img data-original="'.$thumb.'" class="lazy thumb mli-thumb"
                     alt="'.$name.'">
                <span class="mli-info"><h2>'.$name.'</h2></span>
            </a>
        </div>';
					?>

					
		<?php } ?>
<script type="text/javascript">
   
    $("img.lazy").lazyload({
        effect: "fadeIn"
    });
</script>

					<div class="clearfix"></div>
                </div>
                <div id="pagination">
                    <nav>
					<?=$allpage_site?>
                    </nav>
                </div>
            </div>
            <!--/category-->

            

        </div>

<?php
include View::TemplateView('footer');
?>
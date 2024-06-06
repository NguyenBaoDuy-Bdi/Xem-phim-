<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
$film = MySql::dbselect("tb_film.title,tb_film.title_en,tb_film.category,tb_film.release_time,tb_film.timeupdate,tb_film.thumb,tb_film.country,tb_film.director,tb_film.actor,tb_film.year,tb_film.duration,tb_film.viewed,tb_film_other.content,tb_film_other.keywords,tb_film.total_votes,tb_film.total_value,tb_film.trailer,tb_film.big_image,tb_film.quality,tb_film.filmlb",'film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"id = '$filmid'");
$tenphim = $film[0][0];
$tentienganh = $film[0][1];
$watchurl = get_url($epwatch,$tenphim,'Xem Phim');
$breadcrumb = breadcrumb_menu($film[0][2]);
$urlfilm = get_url($filmid,$tenphim,'Phim');
$phathanh = $film[0][3];
if(!$phathanh) $phathanh = GetDateT($film[0][4]);
$thumb = $film[0][5];
if(!$thumb) $thumb = TEMPLATE_URL.'images/grey.jpg';
$theloai = category_a($film[0][2]);
$quocgia = country_a($film[0][6]);
$genre = category_ad($film[0][2]);
$country = country_ad($film[0][6]);
$daodien_a = CheckName($film[0][7]);
$daodien = Get_List_director($film[0][7]);
$dienvien = Get_List_actor($film[0][8]);
$year = CheckName($film[0][9]);
$duration = CheckName($film[0][10]);
$viewed = $film[0][11];
$loaiphim = $film[0][19];
$content = str_replace(array('<section></section>','<p>&nbsp;</p>','<div>','</div>'),array('','','',''),$film[0][12]);
$tags = GetTag_a_iframe($film[0][13],2);
$image_r = explode("<img ",UnHtmlChars($film[0][12]));
$Astar = $film[0][15];
$Bstar = $film[0][14];
$Cstar = ($Astar/$Bstar);
$Dstar = number_format($Cstar,0);
$Cstar = number_format($Cstar,1);
for($i=1;$i<count($image_r);$i++) {
	preg_match('/src="([^"]+)"/', $image_r[$i], $image);
	$image = $image[1];
	$image_all .= "<li><a href=\"$image\" rel=\"screen[s]\" title=\"$tenphim - $tentienganh\"><img src=\"$image\" alt=\"$tenphim - $tentienganh\" width=\"600px\"/></a></li>";
}
for($i=1;$i<11;$i++) {
	$votes .= "<div class=\"vote-line-hv\" data-id=\"$i\"></div>";
}
$trailer = $film[0][16];
$bigthumb = $film[0][17];
if(!$bigthumb) $bigthumb = TEMPLATE_URL.'images/cover.jpg';
$quality = $film[0][18];
if($quality == 'HD') $quality = '<a title="Chất lượng HD" class="hd"></a>';
else $quality = '<a title="Chất lượng SD" class="sd"></a>';
$episodeid = $epid[0][3];
$epurl = $epid[0][3];
$epsubtitle = $epid[0][4];
?>
    <?php date_default_timezone_set('Europe/London'); if (intval( strtotime(date('Y-m-d H:i:s')) - strtotime($epid[0][6]) /3600) > 3) {global $datetime_post; echo "<script>
			function notification() {
    alertvc('Tập phim mới được update, server trong quá trình xử lý, bạn có thể quay lại sau nếu chưa xem được! ".$epid."');
}
		</script>";} ?>
<script type="text/javascript">
var PlayFilm = "<?=$filmid?>";
var PlayEp = "";
var NowPage = 0;
var isTrailer = false;
var youIP = "";
</script>
<div class="tn-playerdv">
<div class="tn-wrapfix playerdv-in">
<div class="tn-lockup-title">
<h1 class="tn-lockup-title" style="width: 925px;">
<?php echo $tenphim;?> (<?php echo $year;?>) <br><i><?php echo $tentienganh;?></i>
</h1>
</div>
<style>#hdoplayer{margin:0px auto;}</style>
<div class="player-container" style="margin: 0px auto 5px auto;position: relative;width: 925px;height:520px;position: relative;">
	
			<?php echo player($epwatch);?>	
                
			</div>
</div>
</div>
<div class="tn-main2 clearfix" style="position: relative;padding-top: 0px;width: 925px;">
<div class="tn-sentiment-actions" style="max-height: 45px;">
<a rel="nofollow" href="javascript:void(0);" class="btn-actions switch"><i class="fa fa-lightbulb-o"></i> Tắt đèn</a>
<a rel="nofollow" href="javascript:void(0)" onclick="setLike(<?php echo $id?>, this)" class="btn-actions btn-likes-movie "><i class="fa fa-bookmark"></i> Yêu thích</a>
<a rel="nofollow" href="javascript:void(0)" onclick="setLater(<?php echo $id?>, this)" class="btn-actions "><i class="fa fa-plus"></i> Xem sau</a>
<a rel="nofollow" href="javascript:void(0)" onclick="showBroken()" class="btn-actions"><i class="fa fa-warning"></i> Báo lỗi</a>
<div class="pull-right" style="margin-top: 4px;">
<div style="display: inline-block;position: relative;top: -2px;margin-right: 10px;">
<i class="fa fa-bolt"></i> <div class="film_view_count" style="font-size: 25px;display: inline-block;  color: #A0C7A8;" title="Số lượt xem phim này" style="display: inline-block;position: relative;"></div>
</div>
<div class="fb-like" style="top: -6px;display: inline-block;z-index: 100000;" data-href="<?php echo $urlfilm;?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
<div data-href="<?php echo $urlfilm;?>" class="g-plusone" data-size="medium"></div>
</div>
</div>
<div class="tn-main-r" style="float: left">
 
<div class="block-movie">
<div class="header-block-title">Thông tin</div>
<div class="block-child">
<div class="media media-filminfo">
<div class="media-body">
<ul class="filminfo-fields">
<li>Tên Phim: <h1 style="font-size: 14px;margin: 0px;display: inline;"><strong><?php echo $tenphim;?></strong></h1></li>
<li>Tên Tiếng Anh: <h2 style="font-size: 14px;margin: 0px;display: inline;"><strong><?php echo $tentienganh;?></strong></h2></li>
<li>Năm sản xuất: <a href="/danh-sach/phim-theo-nam/2011.html" title="Phim sản xuất năm <?php echo $year;?>"><?php echo $year;?></a></li>
<li>Thể loại: <strong><?php echo $theloai;?></strong></li>
<li>Quốc gia: <strong><?php echo $quocgia;?></strong></li>
<li>Thời lượng: <?php echo $duration?></li>
<li>Đạo diễn: <?=$daodien?></li>
<li><img src="http://hdonline.vn/template/frontend/images/imdb.png" style="margin-right: 10px;margin-top: -3px;"> 5.5</li>
</ul>
<div class="rating" itemscope itemtype="http://data-vocabulary.org/Review-aggregate">
<div class="rate-star" itemprop="rating" itemscope itemtype="http://data-vocabulary.org/Rating">
<span itemprop="average">10</span>
<meta itemprop="best" content="10"/><meta itemprop="worst" content="1"/>
</div>
<div class="rate-vote" style="padding-left: 0px;">
<div class="your-rate">
<div id="jRate-vote" style="display: inline-block;font-size: 11px;">Của bạn:</div>
<div class="rate-vote-hover">
<div id="jRate" style="display: inline-block;"></div>
<div id="jrate-change" style="display: inline-block;font-size: 11px;">0/10</div>
</div>
</div>
<div class="rate-people">
Đánh giá <strong>10</strong> từ <span itemprop="votes" style="display: inline-block;">11</span> thành viên
</div>
</div>
</div>
<div class="tn-contentmt maxheightline-6">
<p><?php echo $content;?> </p>
</div>
<div class="line-bottom"></div>
<div class="tn-tagfin" style=" margin-bottom: 10px;">
<h3 class="tn-texth3" style="display: inline;text-transform: none;">Từ khóa:</h3>
<?php echo $tags;?>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="line-bottom"></div>
<div class="group-filminfo">
<h3 class="tn-texth3">Diễn Viên</h3>
<div class="actor-movie-list maxheightline-6">
<ul class="group-filminfo-ul clearfix">
<?php echo $dienvien;?>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="block-movie" style="padding-bottom: 0px;background: none;margin-bottom: 7px;">
<div class="header-block-title" style="margin-bottom: 0px;border: none">Trailer</div>
<iframe src="http://api.hdonline.vn/iframeplay.php?file=http://www.youtube.com/watch?v=O2-hiHUh4UQ" width="100%" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" height="200px"></iframe>
</div>			
<div class="block-movie">
<div class="header-block-title">Phim liên quan</div>
<div class="block-child">
<div class="tn-nolist_carousel">
<ul id="similar_other" class="right-similar">
<?php echo li_filmALL('category',9,$film[0][2]);?>
</ul>
<script type="text/javascript">
                    $(document).ready(function(){
                        var arrSimilar = {};
						$('.key_similar_id').each(function(index, value){
							if (arrSimilar[$(this).data('id')]){
								$(this).remove();
							}
							arrSimilar[$(this).data('id')] = true;
						});
                    });</script>
</div>
</div>
</div>
<div id="facebook_framepage">
</div>
</div>
<div class="tn-main-l" style="float: right;width: 593px;">
<div class="block-movie">
<div class="block-child">
<div class="fb-comments" data-version="v2.3" data-href="<?php echo $urlfilm;?>" data-num-posts="10" data-width="100%" style="text-align: center">Đang tải bình luận...</div>
</div>		
</div>
<div>
</div>
<div class="clearfix"></div>
</div>
<div class="filminfo-social">
<a href="<?php echo $urlfilm;?>" data-sharelink="https://www.facebook.com/sharer/sharer.php?app_id=138449339641932&display=popup&u=" class="facebookshare">
<i class="fa fa-facebook fa-lg"></i>
</a>
<a href="<?php echo $urlfilm;?>" data-sharelink="https://plus.google.com/share?url=" class="googleshare">
<i class="fa fa-google-plus fa-lg"></i>
 
</a>
</div>
</div>
<style>.media-body span{display:block;}.image-screenshot li{width:49%;margin:0.5%;display:inline-block;}.image-screenshot li img{cursor:pointer;}.filminfo-fields>li{list-style-type:square;}.filminfo-fields{margin:0 0 10px;padding:0px 10px 0px 20px;}.line-bottom{clear:both;border-bottom:1px solid #ccc;margin-top:5px;}.tn-tagfin h4{display:inline;}.tn-main-l{padding-bottom:0px;}</style>	
<script type="text/javascript">
$(document).ready(function(){
jwplayer('hdoplayer').on('ready' , function(){
		$("#hdoplayer").allofthelights();
	});

	
});

        URL_FANPAGE = "https://www.facebook.com/HDOHanhDong";
 
function resize_player (player,resize)
{
	var jw5 = "";
	if ($("#"+player+"_wrapper").length > 0){
		jw5 = "_wrapper";
	} 
	if(resize == "min" || resize == "_min")	{
		$(".player-container #"+player+jw5).animate({width: "925px"}, 200);
		$(".player-container #player, .player-container #player #"+player+jw5).animate({height: "520px"}, 200);
	} else {
		$(".player-container #"+player+jw5).animate({width: "1200px"}, 200);
		$(".player-container #player, .player-container #player #"+player+jw5).animate({height: "675px"}, 200);
	}; 
}
function sendToFriend(){FB.ui({method: 'send',link: '<?php echo $urlfilm;?>'});}
function playerSendContact(){showBroken();}
var preSlotOneImp = true;
var preSlotOneStr = true;
function vpluginadstracking($event, $id){}
$(window).load(function () {
	setViewFilm(PlayFilm);
	var filmView = 115446;
	var startPlus = filmView - 2000;
	if (startPlus > 0){
		var startPlay = filmView - 5000;
		if (startPlay < 0){startPlay = 0;}
		var filmPlus = setInterval(function(){
			startPlay += Math.round(28);
			$(".film_view_count").html(numberWithCommas(startPlay));
			if (startPlay >= startPlus){
    			 clearInterval(filmPlus);
    			 $(".film_view_count").html(numberWithCommas(startPlus));
    			 filmPlus = setInterval(function(){
    		    		startPlus++;
    		    		if (startPlus > filmView){
    		    			 clearInterval(filmPlus);
    		    		} else {
    					  $(".film_view_count").html(numberWithCommas(startPlus));
    					}
    		    	  }, 200);
    		}
    	  }, 50); 
	} else {
		$(".film_view_count").html(numberWithCommas(filmView));
	}
});

function callScroll(){
	try {
		if ($(".tn-main-r").height() > $(".tn-main-l").height()){
			var objScroll = $(".tn-main-l");
			var leftPad = $('.tn-main2').offset().left + $('.tn-main-r').outerWidth() + 12;
			var leftBottom = $('.tn-main-r').outerWidth() + 10;
			$(".tn-main-r").css({
				position: "relative",
				top: "0px",
				bottom: "auto",
				left: "auto"
			});
		} else {
			var objScroll = $(".tn-main-r");
			var leftPad = leftBottom = "auto";
			$(".tn-main-l").css({
				position: "relative",
				top: "0px",
				bottom: "auto",
				left: "auto"
			});
		}
		if ($(window).scrollTop() > objScroll.height() && $(window).scrollTop() > $('.tn-main2').offset().top) {
			if ( $(window).height()  < objScroll.height()){
				objScroll.css({
					position: "fixed",
					top: "auto",
					bottom: "0px",
					left: leftPad
				});
			} else if ($(window).scrollTop() > $('.tn-main2').offset().top){
				objScroll.css({
					position: "fixed",
					top: "0px",
					bottom: "auto",
					left: leftPad
				});
			}
			if ($(window).scrollTop() + $(window).height() >= $(document).height() - $('.tn-footer-full').height() ){
				if ( $(window).height()  < objScroll.height()){
					objScroll.css({
						position: "absolute",
						top: "auto",
						bottom: "0px",
						left: leftBottom
					});
				} else if ($(window).scrollTop() + $(window).height() + objScroll.height()>= $(document).height() - $('.tn-footer-full').height()){
					objScroll.css({
						position: "absolute",
						top: "auto",
						bottom: "0px",
						left: leftBottom
					});
				} else {
					objScroll.css({
						position: "fixed",
						top: "0px",
						bottom: "auto",
						left: leftPad
					});
				}
			}
		} else {
			objScroll.css({
				position: "relative",
				top: "0px",
				bottom: "auto",
				left: "auto"
			});
		}
	} catch(e){}
}
function callResize(){
	if ($( window ).width() > $(".player-container").width() + $(".filminfo-social").width()){
      $(".filminfo-social").show();
    } else {
      $(".filminfo-social").hide();
    }
}
var jRateConfig = {
		startColor: 'yellow', endColor: 'yellow',
    	precision: 1,
    	min: 0,
		max: 10,
		count: 10,
		width: 15,
		height: 15,
		rating: 0,
		backgroundColor: '#ccc'
};
function callAjaxCheck(url, callback){
	$.ajax({
	  	  dataType: "jsonp",
	  	  url: url,
	  	  timeout: 5000,
	  	  success: function(e){
		  	  var newIP = "";
	      	  if (e && e.ip){
	          	  if (e.country_code = "VN"){
		          		newIP = e.ip;
	          	  }
	          } else if (e && e.query){
	        	  newIP = e.query;
	          }
	          if (newIP !=  ""){
		          if (newIP != youIP){
		        	  youIP = newIP;
		        	  if (typeof(Storage) !== "undefined") {
			          		localStorage.setItem("UserIPDetect" , youIP);
			          	} else {
			          		setVCookie("UserIPDetect");
			          	}
		          }
		      	 callback(true);
	          } else {
	        	  callback(false);
	          }
	  	  },
	  	  error: function (){
		  		callback(false);
	  	  }
	  });
}

$( window ).resize(function() {
	callResize();
});
$(window).scroll(function(){callScroll();});

$(document).ready(function(){
	$('.tn-contentmt').readmore({
  	  speed: 75,
  	  lessLink: '<a href="javascript:void(0);" class="center-block text-right">Thu gọn</a>',
  	  moreLink: '<a href="javascript:void(0);" class="center-block text-right">Xem thêm..</a>',
	  collapsedHeight : 60 
 	});
	$('.actor-movie-list').readmore({
  	  speed: 75,
  	  lessLink: '<a href="javascript:void(0);" class="center-block text-right">Thu gọn</a>',
  	  moreLink: '<a href="javascript:void(0);" class="center-block text-right">Xem thêm..</a>'
 	});
	$("#closeFeedback").click(function(e) {
		e.preventDefault();
	    $(".feedbackMovie").fadeOut();
	});
	
	$(".sendFeedback").click(function(e) {
		e.preventDefault();
	    sendFeedBack();
	});

	$('.hideall').hide();

	$.lockfixed(".float-left",{offset: {
		top: 10, 
		bottom: $(document).height() - $('.tn-footer-full').offset().top + 10
		}
	});	
	$.lockfixed(".float-right",{offset: {
		top: 10, 
		bottom: $(document).height() - $('.tn-footer-full').offset().top + 10
		}
	});	 
	

		callScroll();
	callResize();
});
</script>

<style>.filminfo-view{z-index:0!important;}.filmlist-tab li:last-child{border-left:1px solid #ccc;padding-left:10px;}.filmlist-tab>li{margin:0 0px 0 0;}.filmlist-tab>li a{font-size:15px;}#lichcapnhat .filmlist-lichphatsong{border:none;}</style>

<?php
include View::TemplateView('footer');
?>
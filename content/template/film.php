<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
$film = MySql::dbselect("tb_film.title,tb_film.title_en,tb_film.category,tb_film.release_time,tb_film.timeupdate,tb_film.thumb,tb_film.country,tb_film.director,tb_film.actor,tb_film.year,tb_film.duration,tb_film.viewed,tb_film_other.content,tb_film_other.keywords,tb_film.total_votes,tb_film.total_value,tb_film.trailer,tb_film.big_image,tb_film.quality,tb_film.filmlb,tb_film.link_down,tb_film.userpost,tb_film.active,tb_film.title_search",'film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"id = '$filmid'");
$tenphim = $film[0][0];
$tentienganh = $film[0][1];
$watchurl = get_url($epwatch,$tenphim,'Xem Phim');
$breadcrumb = breadcrumb_menu($film[0][2]);
$urlfilm = get_url($filmid,$tenphim,'Phim');
$big_thumb = $film[0][17];
if(!$big_thumb) $big_thumb = SITE_URL.'/assets/images/cover.jpg';
$phathanh = $film[0][3];
$thumb = $film[0][5];
if(!$thumb) $thumb = TEMPLATE_URL.'images/grey.jpg';
$theloai = category_a($film[0][2]);
$quocgia = country_a($film[0][6]);
$genre = category_ad($film[0][2]);
$country = country_a($film[0][6]);
$daodien_a = CheckName($film[0][7]);	
$urldaodien = get_url('',$daodien_a,'search');
$daodien = Get_List_director($film[0][7]);
$dienvien = Get_List_actor($film[0][8]);
$dienvien2 = Get_List_actor2($film[0][8]);
$year = CheckName($film[0][9]);
$duration = CheckName($film[0][10]);
$viewed = $film[0][11];
$loaiphim = $film[0][19];
$content = $film[0][12];
$tags = GetTag_a($film[0][13],5);
$image_r = explode("<img ",UnHtmlChars($film[0][12]));
$Astar = $film[0][15];
$Bstar = $film[0][14];
$Cstar = ($Astar/$Bstar);
$Dstar = number_format($Cstar,0);
$Cstar = number_format($Cstar,1);
for($i=1;$i<count($image_r);$i++) {
	preg_match('/src="([^"]+)"/', $image_r[$i], $image);
	$image = $image[1];
	$image_all .= "<img src=\"$image\" alt=\"$tenphim - $tentienganh\" width=\"600px\"/>";
}
for($i=1;$i<11;$i++) {
	$votes .= "<div class=\"vote-line-hv\" data-id=\"$i\"></div>";
}
$tl = $film[0][16];
$tl1 = explode('watch?v=',$tl);
$trailer = $tl1[1];
$quality = $film[0][18];
$episodeid = $epid[0][3];
$epurl = $epid[0][3];
$epsubtitle = $epid[0][4];
?>
 <div class="pad"></div>
        <div class="main-content main-detail">
            <div class="main-content main-category">
			<div id="bread">
                    <ol class="breadcrumb">
                        <li><a href="<?=SITE_URL?>/">Home</a></li>
                        <li><a href="#">Xem Phim</a></li>
                        <li class="active"><?=$tenphim?></li>
                    </ol>
                </div>


<div id="mv-info">
<script>
var	download_video = false;
function load_datadownload(epid) {
	if(download_video == false) {
		$('.download-box').show().html("<img src='/assets/img/loadings.gif'> Đang tải, vui lòng chờ trong giây lát ...");
		$.post('/index.php', {
			RK_Download: 1,
			epid: epid
		}, function (data) {
			if(data) {
				$('.download-box').html('<center><span style="color:#fff">Chọn chất lượng phim sau đó nhấn chuột phải để lưu phim về máy</span><br />'+data+'</center>');
				download_video = true;
			}			
		});
	}
	return false;
}
function error(filmid,epid) {
		$.post(base_url+"ajax/error/", {
			filmid: filmid,
			epid: epid
		}, function (data) {
			if(data) {
				alert("Báo lỗi thành công!");
				$(".bp-btn-error").addClass("active");
				$(".bp-btn-error").text("Đã báo lỗi");
			}			
		});	
	return false;
}
$(document).ready(function () {
$("#tai-phim").click(function () {
		var epid = $(this).attr('data-id');
		load_datadownload(epid);
		return false;
	});
	var showChar = 650;  
    var ellipsestext = "...";
    var moretext = "Xem thêm";
    var lesstext = "Thu gọn";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
$(function(){
    $('#list-eps').slimScroll({
        height: '200px'
    });
});
</script>
<style>
.morecontent span {
    display: none;
}
.morelink {
    display: block;
	color: red;
}
.jwplayer.jw-state-paused .jw-display-icon-container {
    display: table;
}
.jw-skin-seven .jw-display-icon-container  {
	border-width: 2px;
	border-color: #fff;
	 border-style: solid;
    border-width: medium;
    border-radius: 50%;
    padding:1em;
}

</style>
<?php if($mode == 'xem-phim') { ?>
<div player-token="<?=$id?>" style="height: 600px;" id="media-player" movie-id="<?=$filmid?>">
<?php echo player($id);?>
</div>
 <div id="bar-player">
                    <a href="#mv-info" class="btn bp-btn-light"><i class="fa fa-lightbulb-o"></i> <span></span></a>

                    <span id="button-favorite">
                        <a onclick="favorite(<?=$filmid?>,1)"
                           class="btn bp-btn-like"><i class="fa fa-heart"></i>
                            Favorite</a>
                    </span>
					<a href="#commentfb" class="btn bp-btn-review"><i class="fa fa-comments"></i>
                        <span>Comment (<span id="comment-count">0</span>)</span></a>
					<span id="button-favorite">
                        <a onclick="error(<?=$filmid?>,<?=$epid?>)"
                           class="btn bp-btn-error"><i class="fa fa-warning"></i>
                            Báo lỗi</a> 
                    </span>
					<a href="/post/huong-dan-kiem-tien/" target="_blank" class="btn bp-btn-review"><i class="fa fa-dollar"></i>
                        <span>Hướng dẫn kiếm tiền</span></a>
					
                    <span class="bp-view"><i class="fa fa-eye mr10"></i><?=number_format($viewed)?></span>
					<div style="width:100%;float:left;margin:10px;">
							<b style="color: white; font-size:14px;">Hãy dành 1 s Like & Share để ủng hộ Subteam và Website . Cảm ơn các bạn !</b>
							<br/>
							<b style="color: #FF00AF; font-size:14px;">NẾU KHÔNG XEM ĐƯỢC HOẶC GIẬT, LAG - XÓA CACHE CỦA TRÌNH DUYỆT (<a href="https://support.google.com/chrome/answer/95582?hl=vi" target="_blank"> Hướng dẫn Google Chrome</a>)	</b>
														
							<br/>
							<b style="color: yellow; font-size:18px;">BÁO LỖI VÀ ĐỔI SERVER KHÁC KHI KHÔNG XEM ĐƯỢC! </b>
							
							</div>
                    <div class="clearfix"></div>
                </div>

	

             <div id="list-eps">
                </div>
<?php
}else{ 
?>

<a href="<?=$watchurl?>"
                       title="Xem phim <?=$tenphim."-".$tentienganh?>" class="thumb mvi-cover"
                       style="background-image: url(<?=$big_thumb?>)"><span
                            class="mvi-view"><i
                                class="fa fa-eye mr10"></i><?=number_format($viewed)?></span></a>

<?}?>
                <div class="mvi-content" style="min-height:500px">
    <div class="mvic-btn">
        <div class="mv-rating">

        </div>
        <div class="clearfix"></div>
		<a href="<?=$watchurl?>" target="_blank" class="btn btn-block btn-lg btn-success btn-01"><i
                class="fa fa-play mr10"></i>
            Xem Phim HD</a>
		<?if($film[0][20]){?>      			
				<a href="<?=$film[0][20]?>"  target="_blank"
						class="btn btn-block btn-lg btn-success btn-02"><i class="fa fa-download mr10"></i>
					Download in HD</a>
				<?}else{?>
				<a href="javascript:void(0);" id="tai-phim" data-id="<?=$id?>"
						class="btn btn-block btn-lg btn-success btn-02"><i class="fa fa-download mr10"></i>
					Download in HD</a>
				<?}?>
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
				<div class="fb-page" style="margin-top:5px;" data-href="https://www.facebook.com/GLAPHIMTV?ref=hl data-width="300" data-height="300" data-hide-cover="false" data-show-facepile="false" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/GLAPHIMTV?ref=hl"><a href="https://www.facebook.com/GLAPHIMTV?ref=hl">Facebook</a></blockquote></div></div>

				 </div>
    <div class="thumb mvic-thumb" style="background-image: url(<?=$thumb?>);"></div>
    <div class="mvic-desc">
	<h3 class="name_vn"><?php echo $tenphim; ?><?php if($tentienganh){?> - <?php echo $tentienganh; }?></h3>
        
		<?if($tl){?>
                    <div class="block-trailer">
                <a data-target="#pop-trailer" data-toggle="modal" class="btn btn-primary">
                    <i class="fa fa-video-camera mr5"></i>Trailer
                </a>
            </div>
		<?}?>

        <div class="desc more">
            <?
	//$content = preg_replace('#\<p>[{\w},\s\d"]+\</p>#', "", $content);
	//$output = nl2br(trim(str_replace(array("<p>","</p>"),array("","\n"),$content)));
	$output = strip_tags(nl2br($content), '<a><h1><img><b><strong><br>');
	echo $output;?>
	</div>
<div class="mvic-info">
            <div class="mvici-left">
                                    <p>
                        <strong>Thể loại: </strong>
                        <?php echo $theloai; ?>                   </p>
                                                    <p>
                        <strong>Diễn viên: </strong>
                        <?php echo $dienvien2; ?>                </p>
                                                    <p>
                        <strong>Đạo diễn: </strong>
                        <?php echo $daodien; ?>             </p>
                                                    <p>
                        <strong>Quốc gia: </strong>
                        <?php echo $country; ?>                   </p>
                            </div>
            <div class="mvici-right">
                <p><strong>Thời lượng:</strong> <?php echo $duration; ?></p>
                <p><strong>Chất lượng:</strong> <span class="quality"><?php echo $quality;?></span></p>
                <p><strong>Đăng bởi:</strong> <?php echo username($film[0][21]);?></p>
				<p><strong>Năm phát hành:</strong> <?php echo $year;?></p>
                
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>


    </div>
    <div class="clearfix"></div>

</div>
<script type="text/javascript">
    $(document).ready(function () {
        $.get(base_url + 'ajax/movie_rate_info/' + '<?=$filmid?>/', function (data) {
            $('.mv-rating').html(data);
		})
    })
</script>

                </div>
 <!-- keywords -->
                                    <div id="mv-keywords">
                        <strong class="mr10">Keywords:</strong>
                       <?=$tags?>                   
					   </div>
					   

</div>
	
	<!-- Star quảng cáo trang info 
	<div class="content-kus" style="text-align: center; margin: 0px 0; padding: 15px;">

	</div>-->
	
   <!--related-->
   <div id="commentfb">
                <div class="fb-comments"
                     data-href="<?php echo $urlfilm;?>"
                     data-width="100%"
                     data-numposts="5"></div>
					
            </div>
                <div class="movies-list-wrap mlw-related">
                    <div class="ml-title ml-title-page">
                        <span>Có Thể Bạn Muốn Xem</span>
                    </div>
                    <div class="movies-list movies-list-full">               

                                    <?php echo rand2($tenphim,$filmid);?>
<script type="text/javascript">
        $('.jt').qtip({
            content: {
                text: function (event, api) {
                    $.ajax({
                        url: api.elements.target.attr('data-url'),
                        type: 'GET',
                        success: function (data, status) {                         
                            api.set('content.text', data);
                        }
                    });
                },
                title: function (event, api) {
                    return $(this).attr('title');
                }
            },
            position: {
                my: 'top left', 
                at: 'top right', 
                viewport: $(window),
                effect: false,
                target: 'mouse',
                adjust: {
                    mouse: false 
                },
                show: {
                    effect: false
                }
            },
            hide: {
                fixed: true
            },
            style: {
                classes: 'qtip-light qtip-bootstrap'
            }
        });
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
<div id="overlay"></div>
<div class="modal fade modal-cuz modal-trailer" id="pop-trailer" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                        class="fa fa-close"></i>
                </button>
                <h4 class="modal-title" id="myModalLabel">Trailer: <?=$tenphim?></h4>
            </div>
            <div class="modal-body">
                <div class="modal-body-trailer">
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?=$trailer?>" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.bp-btn-light, .bp-btn-review').smoothScroll();
        $('#comment-area #comment .content').perfectScrollbar();
        getCommentCount();
        if (is_login) {
            $.get(base_url + 'ajax/movie_check_favorite/' + '<?=$filmid?>/', function (data) {
                $('#button-favorite').html(data);
            });
        }
        $("#toggle-schedule").click(function (e) {
            $("#toggle-schedule").toggleClass("active");
            $(".se-list").toggle();
        });
    });

    setTimeout(function () {
        updateMovieView(<?=$filmid?>)
    }, 5000);

    function getCommentCount() {
        $.ajax({
            url: 'http://graph.facebook.com/?id=<?php echo $urlfilm;?>',
            dataType: 'jsonp',
            success: function (data) {
                if (data.comments) {
                    $("#comment-count").text(data.comments);
                }
            }
        });
    }
</script>



 

<?php
include View::TemplateView('footer');

?>

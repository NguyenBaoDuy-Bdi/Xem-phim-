<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
?>
  <div class="top-content">
    <!-- slider -->
	 <div id="slider">
                <div class="swiper-wrapper">
    <?php echo slider_film("slider = '1'",8);?>
				</div>
		</div>
<!--/slider -->
<!--top news-->
            <div id="top-news">
                <div class="top-news">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#tn-news" role="tab" data-toggle="tab">VIDEO TỔNG HỢP</a></li>
                        <li><a href="#tn-notice" role="tab" data-toggle="tab">THÔNG BÁO</a></li>
                    </ul>
                    <div class="top-news-content">
                        <div class="tab-content">
						 <div role="tabpanel" class="tab-pane in fade active" id="tn-news">
                                <ul class="tn-news"><?php echo li_video();?>
								<li class="view-more">
                                            <a href="<?=SITE_URL?>/video"> Xem thêm <i
                                                    class="fa fa-chevron-circle-right"></i></a>
                                        </li>
																	</ul>
																	</div>
						<div role="tabpanel" class="tab-pane fade" id="tn-notice">
						<div style="padding:10px">
						<?php echo config_site('site_notice');?>
						</div>
                                <div class="tnc-apps">
								
                                    <a href="#" class="tnca-block ios"><i class="fa fa-apple"></i><span>GLAPhim.TV</span>
                                        for Apple iOs</a>
                                    <a href="#" class="tnca-block android"><i
                                            class="fa fa-android"></i><span>GLAPhim.TV</span> for Android</a>
                                </div>
                                                            </div>											
						</div>
					</div>
				</div>
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
				
  

 <!--social home-->
        <div class="social-home">
            <div class="sh-like"><div class="fb-like" data-href="https://www.facebook.com/glaphimtv?ref=hl" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div></div>
            <div class="addthis_native_toolbox"></div><span class="sh-text">Like và Share nhiệt tình để website phục vụ các bạn tốt nhất.</span>
            <div class="clearfix"></div>
        </div>
        <!--/social home-->

<div class="content-kus" style="margin: 20px 0; padding: 15px;">
<center>
<a href="/phim/4286-running-man-vietsub/"><img src="images/04.jpg?v2" /></a>
</center>
</div>

<div class="main-content">
            <div class="movies-list-wrap mlw-topview">
                <div class="ml-title">
                    <span class="pull-left">Top GLAphim<i class="fa fa-chevron-right ml10"></i></span>
                    <a href="<?=SITE_URL?>/danh-sach/phim-moi/" class="pull-right cat-more">Xem tiếp »</a>
                    <ul role="tablist" class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" role="tab" href="#movie-featured"
                                              aria-expanded="false">Đặc sắc</a></li>
                        <li><a onclick="ajaxContentBox('topview-today')" data-toggle="tab" role="tab"
                               href="#topview-today" aria-expanded="false">Xem nhiều trong ngày</a></li>
						<li><a onclick="ajaxContentBox('topview-week')" data-toggle="tab" role="tab"
                               href="#topview-week" aria-expanded="false">Top tuần này</a></li>
						<li><a onclick="ajaxContentBox('topview-month')" data-toggle="tab" role="tab"
                               href="#topview-month" aria-expanded="false">Top tháng này</a></li>
                        <li><a onclick="ajaxContentBox('topview')" data-toggle="tab" role="tab"
                               href="#topview" aria-expanded="false">Bảng xếp hạng</a>
                        </li>
                       
                    </ul>
                    <div class="clearfix"></div>
                </div>
		<div class="tab-content">
			<div id="movie-featured" class="movies-list movies-list-full tab-pane in fade active">
			<?php echo decu1();?>
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
                        <div class="clearfix"></div>
                    </div>
                    <div id="topview-today" class="movies-list movies-list-full tab-pane in fade">
                        <div id="content-box"></div>
                          <div class="clearfix"></div>
                    </div>
					<div id="topview-week" class="movies-list movies-list-full tab-pane in fade">
                        <div id="content-box"></div>
                          <div class="clearfix"></div>
                    </div>
					<div id="topview-month" class="movies-list movies-list-full tab-pane in fade">
                        <div id="content-box"></div>
                          <div class="clearfix"></div>
                    </div>
                    <div id="topview" class="movies-list movies-list-full tab-pane in fade">
                        <div id="content-box"></div>
                        <!--                        -->                        <div class="clearfix"></div>
                    </div>
                    
                </div>
            
	</div></div>

<div class="content-kus" style="margin: 5px 0; padding: 15px;">
<center>
<a href="/phim/4516-bay-tinh-yeu/"><img src="images/02.jpg" /></a>
</center>
</div>

 <!--Phim lẻ-->
            <div class="movies-list-wrap mlw-latestmovie">
                <div class="ml-title">
                    <span class="pull-left">PHIM LE<i class="fa fa-chevron-right ml10"></i></span>
                    <a href="/danh-sach/phim-le/" class="pull-right cat-more">Xem tất cả »</a>
					<ul role="tablist" class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" role="tab" href="#phimle"
                                              aria-expanded="false">Tất cả</a></li>
                        <li><select name="cat" id="cat" class="filter">
						<option value="">Thể loại</option>
						<?php
						$arr = MySql::dbselect('id,name','category','id != 0');
						for($i=0;$i<count($arr);$i++) {
							$name = $arr[$i][1];						
							echo "<option value='".$arr[$i][0]."'>$name</option>";
						}
						?>
						</select>
						</li>
                        <li>
						<select name="country" id="country" class="filter">
						<option value="">Quốc gia</option>
						<?php
						$arr = MySql::dbselect('id,name','country','id != 0');
						for($i=0;$i<count($arr);$i++) {
							$name = $arr[$i][1];						
							echo "<option value='".$arr[$i][0]."'>$name</option>";
						}
						?>
						</select>
                        </li>
						 <li>
						<select name="year" id="year" class="filter">
						<option value="">Năm sản xuất</option>
						<?php
						for($i=0;$i<14;$i++) {
							$name = (2016-$i);
							
							echo "<option value='$name'>$name</option>";
						}
						?>
						</select>
                        </li>
						<li><button id="login-submit" type="submit" class="filters btn btn-block btn-success btn-approve" style="height:40px;margin-left:5px"> Lọc </button>
                        </li>
                       
                    </ul>
                    <div class="clearfix"></div>
                </div>
			<div class="tab-content">	
                <div id="phimle" class="movies-list movies-list-full tab-pane in fade active">
				<?php echo li_film1('phimle','16');?>
				  <script type="text/javascript">
				$(function() {
				$(".filters").click(function() {
				var cat = $("#cat").val();
				var country = $("#country").val();
				var year = $("#year").val();			
				var dataString = 'cat='+ cat + '&country=' + country + '&year=' + year + '&filmlb=0';
				$.ajax({
				type:"GET",				
				url: base_url+"ajax/get_filter_box/",
				data: dataString,
					success: function(e){
						$("#phimle").html(e);
					}
				});
				});
			});
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
				 <div class="clearfix"></div>
                </div>
					 <div id="list-bo" class="movies-list movies-list-full tab-pane in fade">
                        <div id="content-box"></div>
                          <div class="clearfix"></div>
                    </div>          
			
				 </div>
            </div>
            <!--/Phim lẻ-->

<div class="content-kus" style="margin: 5px 0; padding: 15px;">
<center>
<a href="/phim/4972-khoai-lac-ban-doanh/"><img src="images/05.jpg" /></a>
</center>
</div>

<!--Phim bộ-->
            <div class="movies-list-wrap mlw-latestmovie">
                <div class="ml-title">
                    <span class="pull-left">PHIM BÔ<i class="fa fa-chevron-right ml10"></i></span>
                    <a href="/danh-sach/phim-bo/" class="pull-right cat-more">Xem tất cả »</a>
					<ul role="tablist" class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" role="tab" href="#phimbo"
                                              aria-expanded="false">Tất cả</a></li>
                        <li><select id="cats" class="filter">
						<option value="">Thể loại</option>
						<?php
						$arr = MySql::dbselect('id,name','category','id != 0');
						for($i=0;$i<count($arr);$i++) {
							$name = $arr[$i][1];						
							echo "<option value='".$arr[$i][0]."'>$name</option>";
						}
						?>
						</select>
						</li>
                        <li>
						<select id="countrys" name="country" class="filter">
						<option value="">Quốc gia</option>
						<?php
						$arr = MySql::dbselect('id,name','country','id != 0');
						for($i=0;$i<count($arr);$i++) {
							$name = $arr[$i][1];						
							echo "<option value='".$arr[$i][0]."'>$name</option>";
						}
						?>
						</select>
                        </li>
						 <li>
						<select id="years" name="year" class="filter">
						<option value="">Năm sản xuất</option>
						<?php
						for($i=0;$i<14;$i++) {
							$name = (2016-$i);
							
							echo "<option value='$name'>$name</option>";
						}
						?>
						</select>
                        </li>
						<li><button id="login-submit" type="submit" class="submit btn btn-block btn-success btn-approve" style="height:40px;margin-left:5px"> Lọc </button>
                        </li>
                       
                    </ul>
                    <div class="clearfix"></div>
                </div>
			<div class="tab-content">	
                <div id="phimbo" class="movies-list movies-list-full tab-pane in fade active">
				<?php echo li_film1('phimbo','16');?>
		<script type="text/javascript">
				$(function() {
				$(".submit").click(function() {
				var cat = $('#cats').val();
				var country = $("#countrys").val();
				var year = $("#years").val();			
				var dataString = 'cat='+ cat + '&country=' + country + '&year=' + year + '&filmlb=1';
				$.ajax({
				type: "GET",
				url: base_url+"ajax/get_filter_box/",
				data: dataString,
					success: function(e){
						$("#phimbo").html(e);
					}
				});				
				});
			});
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
				<div class="clearfix"></div>
                </div>
				
					
				 </div>
            </div>
            <!--/Phim bộ-->

<div class="content-kus" style="margin: 5px 0; padding: 15px;">
<center>
<a href="/phim/4751-luc-long-tranh-ba/"><img src="images/03.jpg" /></a>

</center>
</div>


<!--Game Show-->
            <div class="movies-list-wrap mlw-latestmovie">
                <div class="ml-title">
                    <span class="pull-left">GAME SHOW<i class="fa fa-chevron-right ml10"></i></span>
                    <a href="/the-loai/game-show/" class="pull-right cat-more">Xem tất cả »</a>
					<ul role="tablist" class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" role="tab" href="#gameshow"
                                              aria-expanded="false">Tất cả</a></li>
                        <li><a onclick="ajaxContentBox('gs-han-quoc')" data-toggle="tab" role="tab"
                               href="#gs-han-quoc" aria-expanded="false">Hàn Quốc</a></li>
                        <li><a onclick="ajaxContentBox('gs-trung-quoc')" data-toggle="tab" role="tab"
                               href="#gs-trung-quoc" aria-expanded="false">Trung Quốc</a>
                        </li>
						 <li><a onclick="ajaxContentBox('gs-viet-nam')" data-toggle="tab" role="tab"
                               href="#gs-viet-nam" aria-expanded="false">Việt Nam</a>
                        </li>
						<li><a onclick="ajaxContentBox('gs-au-my')" data-toggle="tab" role="tab"
                               href="#gs-au-my" aria-expanded="false">Âu Mỹ</a>
                        </li>
                       
                    </ul>
                    <div class="clearfix"></div>
                </div>
			<div class="tab-content">	
                <div id="gameshow" class="movies-list movies-list-full tab-pane in fade active">
				<?php echo li_film1('category',16,',31,');?>
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
				<div class="clearfix"></div>
                </div>
				<div id="gs-han-quoc" class="movies-list movies-list-full tab-pane in fade">
                        <div id="content-box"></div>
                          <div class="clearfix"></div>
                    </div>
                    <div id="gs-trung-quoc" class="movies-list movies-list-full tab-pane in fade">
                        <div id="content-box"></div>
                        <!--                        -->                        <div class="clearfix"></div>
                    </div>
                    <div id="gs-viet-nam" class="movies-list movies-list-full tab-pane in fade">
                        <div id="content-box"></div>
                        <!--                        -->                        <div class="clearfix"></div>
                    </div>
					<div id="gs-au-my" class="movies-list movies-list-full tab-pane in fade">
                        <div id="content-box"></div>
                        <!--                        -->                        <div class="clearfix"></div>
                    </div>
					
				 </div>
            </div>
            <!--/Phim bộ-->

			
<div class="content-kus" style="margin: 20px 0; padding: 15px;">
<center>
<a href="/tin-tuc/tuyen-dung/"><img src="images/tuyen-ctv.jpg?v2" /></a>
</center>
</div>
			
<!--Phim thành viên-->
            <div class="movies-list-wrap mlw-latestmovie">
                <div class="ml-title">
                    <span class="pull-left">Film's Member<i class="fa fa-chevron-right ml10"></i></span>
                    <a href="<?=SITE_URL?>/danh-sach/phim-thanh-vien/" class="pull-right cat-more">Xem tất cả »</a>
					
                    <div class="clearfix"></div>
                </div>
			<div class="tab-content">	
                <div id="gameshow" class="movies-list movies-list-full tab-pane in fade active">
				<?php echo rand1();?>
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
				<div class="clearfix"></div>
                </div>
				
					
				 </div>
            </div>
            <!--/Phim Thành viên-->

<div class="content-kus" style="margin: 5px 0; padding: 15px;">
<center>
<a href="/phim/4517-truong-hoc-moorim/"><img src="images/01.jpg" /></a>
</center>
</div>

<?php
include View::TemplateView('footer');
//include_once './SafeGuardPro/protect.php';
?>
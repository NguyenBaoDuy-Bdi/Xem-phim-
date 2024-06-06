<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
?>
 </div>
<script type="text/javascript">
function ajaxMovie(object, category, category_id, selected){
	var idLoading =  mLoading("Hệ thống đang lấy thông tin. Xin chờ trong giây lát.", object + " .tn-boxsty-dv");
	var url = "frontend/index/ajaxnotes";
	var data = {'category': category,'category_id': category_id};
	$.get(url , data , function(e){
		$(object).find(".showMovie").html(e);
		buildTooltip();
		buildScroll();
		$(idLoading).remove();
	});
	$(object).find(".tabMovie a").removeClass("active");
	$(selected).addClass("active");
	$(object).find(".boxsty-tt-all").attr("href",$(selected).attr("href"));
	return false;
}
function ajaxMovieTop(object, type, year, selected){
	var idLoading =  mLoading("Hệ thống đang lấy thông tin. Xin chờ trong giây lát.", object + " .tn-boxsty-dv");
	var url = "frontend/index/ajaxtop";
	var data = {'top': type, year: year};
	$.get(url , data , function(e){
		$(object).find(".showMovie").html(e);
		buildTooltip();
		buildScroll();
		$(idLoading).remove();
	});
	$(object).find(".tabMovie a").removeClass("active");
	$(selected).addClass("active");
	$(object).find(".boxsty-tt-all").attr("href",$(selected).attr("href"));
	return false;
}

</script>

<footer class="tn-footer-full">
<div class="tn-tagf">
<div class="tn-wrapfix clearfix">
<div class="tn-tagfin"> TAGS:&nbsp;&nbsp;
<h5><a href="http://hdonline.vn/phim-qua-nhanh-qua-nguy-hiem-7-7454.html" rel="tag" class="tn-atag">Quá Nhanh Quá Nguy Hiểm 7</a></h5>
<h5><a href="http://hdonline.vn/phim-tan-than-dieu-dai-hiep-thuyet-minh-7725.html" rel="tag" class="tn-atag">Tân Thần Điêu Đại Hiệp</a></h5>
<h5><a href="/tag/disney" title="Xem Phim Disney" rel="tag" class="tn-atag">Disney</a></h5>
<h5><a href="/tag/phim-dc" title="Xem Phim Phim DC" rel="tag" class="tn-atag">Phim DC</a></h5>
<h5><a href="/tag/phim-anime" title="Xem Phim Phim Anime" rel="tag" class="tn-atag">Phim Anime</a></h5>
<h5><a href="/tag/cong-vien-khung-long" title="Xem Phim Công Viên Khủng Long" rel="tag" class="tn-atag">Công Viên Khủng Long</a></h5>
<h5><a href="/tag/ke-huy-diet" title="Xem Phim Kẻ Hủy Diệt" rel="tag" class="tn-atag">Kẻ Hủy Diệt</a></h5>
<h5><a href="/tag/nhiem-vu-bat-kha-thi" title="Xem Phim Nhiệm vụ bất khả thi" rel="tag" class="tn-atag">Nhiệm vụ bất khả thi</a></h5>
<h5><a href="/tag/phim-marvel" title="Xem Phim Phim Marvel" rel="tag" class="tn-atag">Phim Marvel</a></h5>
<h5><a href="/tag/doraemon" title="Xem Phim Doraemon" rel="tag" class="tn-atag">Doraemon</a></h5>
<h5><a href="/tag/phim-rap" title="Xem Phim Phim rạp" rel="tag" class="tn-atag">Phim rạp</a></h5>
<h5><a href="/tag/hong-kim-bao" title="Xem Phim Hồng Kim Bảo" rel="tag" class="tn-atag">Hồng Kim Bảo</a></h5>
<h5><a href="/tag/jackie-chan" title="Xem Phim Jackie Chan" rel="tag" class="tn-atag">Jackie Chan</a></h5>
<h5><a href="/tag/chung-tu-don" title="Xem Phim Chung Tử Đơn" rel="tag" class="tn-atag">Chung Tử Đơn</a></h5>
<h5><a href="/tag/jacky-wu" title="Xem Phim Jacky Wu" rel="tag" class="tn-atag">Jacky Wu</a></h5>
<h5><a href="/tag/ngo-kinh" title="Xem Phim Ngô Kinh" rel="tag" class="tn-atag">Ngô Kinh</a></h5>
<h5><a href="/tag/chau-nhuan-phat" title="Xem Phim Châu Nhuận Phát" rel="tag" class="tn-atag">Châu Nhuận Phát</a></h5>
<h5><a href="/tag/jason-staham" title="Xem Phim Jason Staham" rel="tag" class="tn-atag">Jason Staham</a></h5>
</div>
</div>
</div>
<div class="footer_two">
<div class="main-width clearfix">
<div class="spec_footer first">
<p class="title">HDONLINE</p>
<ul>
<li><a rel="nofollow" href="/tin-tuc/gioi-thieu.html">Giới thiệu</a></li>
<li><a rel="nofollow" href="http://m.hdonline.vn">Phiên bản Mobile</a></li>
<li><a rel="nofollow" href="http://fb.com/phimhdo">Facebook HDO</a></li>
<li><a rel="nofollow" href="https://www.youtube.com/user/hdochanels">Youtube Channel</a></li>
</ul>
</div>
<div class="spec_footer year_footer">
<p class="title">ĐÓNG GÓP</p>
<ul>
<li><a rel="nofollow" href="http://id.hdonline.vn">Thành viên VIP</a></li>
<li><a rel="nofollow" href="http://hdonline.vn/tin-tuc/huong-dan-su-dung.html">Hướng dẫn sử dụng</a></li>
                <li><a rel="nofollow" href="javascript:void(0)" onclick="showContactAds()">Liên hệ quảng cáo</a></li>
            </ul>
        </div>
        <div class="spec_footer">
            <p class="title">QUY ĐỊNH</p>
            <ul>
                <li><a rel="nofollow" href="/tin-tuc/dieu-khoan-su-dung.html">Điều khoản sử dụng</a></li>
                <li><a rel="nofollow" href="/tin-tuc/chinh-sach-rieng-tu.html">Chính sách riêng tư</a></li>
                <li><a rel="nofollow" href="/tin-tuc/nguyen-tac-cong-dong.html">Nguyên tắc cộng đồng</a></li>
                <li><a rel="nofollow" href="/tin-tuc/quy-trinh-bao-cao-vi-pham-ban-quyen.html">Khiếu nại bản quyền</a></li>
            </ul>
        </div>
        <div class="spec_footer last">
            <p class="title">TRỢ GIÚP</p>
            <ul>
            	<li><a rel="nofollow" href="http://id.hdonline.vn/hoi-dap.html" target="_blank">Hỏi đáp</a></li>
                <li><a rel="nofollow" href="javascript:void(0)" onclick="showContact()">Liên hệ</a></li>
                <li><a rel="nofollow" href="https://docs.google.com/forms/d/1F3b75HS7ypGXuMwcdcOrhjDxwL-PWBgSqaX7wo6omPs/viewform" target="_blank">Góp ý</a></li>
                <li><a rel="nofollow" href="javascript:void(0)">Báo lỗi</a></li>
            </ul>
        </div>
    </div>
</div>
    <div class="tn-footer clearfix">
      <div class="tn-footer-r">Copyright ©2015 HDONLINE.VN. All Rights Reserved. Phiên bản thử nghiệm đang chờ xin giấy phép bộ TT & TT.</div>
    </div>
  </footer>
  </div>
 <!-- Popup đăng nhập -->
  <div id="show_pp_logreg" class="tn-popup-in pp-medium box-logreg box-logreg-popup-new" style="display: none;z-index: 9015;">
    <div class="tn-popup-head">đăng nhập</div>
    <div class="tn-popup-txt clearfix">
      <div class="col-sm-6">
            <form class="form-horizontal" onsubmit="submitLogin();return false;" role="form">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-12 control-label">Tên Đăng Nhập</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" value="" id="inputEmail3" placeholder="Username Hoặc Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-12 control-label">Mật Khẩu</label>
                  <div class="col-sm-12">
                    <input type="password" class="form-control" value="" id="inputPassword3" placeholder="Mật Khẩu">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <div class="col-sm-6">
                        <label><input type="checkbox" name="expire" id="expire" value="1">Ghi nhớ </label>
                    </div>
                    <div class="col-sm-6">
                        <div class="checkbox text-right"> <a href="http://id.hdonline.vn/quen-mat-khau.html" rel="nofollow">Quên mật khẩu</a>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <button type="submit" class="btn tn-btn-default btn-block">Đăng nhập</button>
                  </div>
                </div>
              </form>
      </div>
      <div class="col-sm-6">
          <div class="socialLogin row">
            <div class="col-sm-10 socialLogin-div">
                <a class="btn btn-link btn-block facebookLogin" href="http://id.hdonline.vn/dang-nhap-facebook.html" rel="nofollow" onclick="buildLoginLink(this.href); return false;"><i class="fa fa-facebook"></i> ĐĂNG NHẬP FACEBOOK</a>
            </div>
            <div class="col-sm-10 socialLogin-div">
                <a class="btn btn-link btn-block googleLogin" href="http://id.hdonline.vn/dang-nhap-google.html" rel="nofollow" onclick="buildLoginLink(this.href); return false;"><i class="fa fa-google-plus"></i> ĐĂNG NHẬP GOOGLE</a>
            </div>
            <div class="col-sm-10 socialLogin-div">
                <a class="btn tn-btn-default2 btn-block" href="http://id.hdonline.vn/dang-ky.html" onclick="showPoupRegister(this); return false;" rel="nofollow">Đăng ký</a>
            </div>
            <div class="col-sm-10 socialLogin-div">
                <a class="btn btn-block btn-socialLogin-close" href="javascript:void(0)" rel="nofollow">Đóng</a>
            </div>
          </div>
      </div>
    </div>
  </div>
  
  <!-- Popup đăng ký -->
  <div id="show_pp_logregister" class="tn-popup-in pp-medium box-logreg box-logreg-popup-new" style="display: none;z-index: 9015;">
    <div class="tn-popup-head">đăng ký</div>
    <div class="tn-popup-txt clearfix">
      <div class="col-sm-6">
            <form class="form-horizontal" onsubmit="submitRegister();return false;" role="form">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-12 control-label">Tên Đăng Nhập</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" value="" id="register_username" placeholder="Chỉ cho phép ký tự và số">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-12 control-label">Email</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" value="" id="register_email" placeholder="Nhập địa chỉ email của bạn">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-12 control-label">Mật Khẩu</label>
                  <div class="col-sm-12">
                    <input type="password" class="form-control" value="" id="register_password" placeholder="Mật Khẩu">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-12 control-label">Nhập lại mật Khẩu</label>
                  <div class="col-sm-12">
                    <input type="password" class="form-control" value="" id="register_comfirm" placeholder="Nhập lại mật Khẩu">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <button type="submit" class="btn tn-btn-default btn-block">Đăng ký tài khoản</button>
                  </div>
                </div>
              </form>
      </div>
      <div class="col-sm-6">
          <div class="socialLogin row">
            <div class="col-sm-10 socialLogin-div">
                <a class="btn btn-link btn-block facebookLogin" href="http://id.hdonline.vn/dang-nhap-facebook.html" rel="nofollow" onclick="buildLoginLink(this.href); return false;"><i class="fa fa-facebook"></i> ĐĂNG NHẬP FACEBOOK</a>
            </div>
            <div class="col-sm-10 socialLogin-div">
                <a class="btn btn-link btn-block googleLogin" href="http://id.hdonline.vn/dang-nhap-google.html" rel="nofollow" onclick="buildLoginLink(this.href); return false;"><i class="fa fa-google-plus"></i> ĐĂNG NHẬP GOOGLE</a>
            </div>
            <div class="col-sm-10 socialLogin-div">
                <a class="btn btn-block btn-socialLogin-close" href="javascript:void(0)" rel="nofollow">Đóng</a>
            </div>
          </div>
      </div>
    </div>
  </div>
    <div class="tn-bg-popup" id="loginSpace" style="display: none;"></div>
  <div class="movie-bg-popup" style="display: none;"></div>
  <div id="msgSpace" style="display: none;"></div>
  <div class="malert-bg-popup" style="display: none;"></div>
  <div id="error-popup" class="feedbackMovie tn-popup-in pp-medium box-logreg" style="display:none">
    <div class="tn-popup-head">Báo lỗi</div>
    <div class="tn-popup-txt clearfix">
      <div class="row">
      	<label class="forn-control col-xs-4">Chủ đề</label>
      	<div class="form-group col-xs-8">
            <select class="form-control" id="typeError" onchange="changeError()">
				  <option value="">Chọn chủ đề</option>
				  <option value="1">Báo lỗi phim</option>
				  <!--<option value="2">Báo lỗi video</option>-->
				  <option value="3">Báo lỗi hệ thống</option>
				  <option value="4">Báo lỗi khác</option>
				  <option value="5">Yêu cầu tính năng</option>
				</select>
          </div>
      </div>
      <div class="row hideall filmShow">
      	<label class="forn-control col-xs-4">Nguyên nhân</label>
      	<div class="form-group col-xs-8">
            <select class="form-control" id="reasonError" onchange="changeError()">
				  <option value="">Chọn nguyên nhân</option>
				  <option value="1">Không xem được phim</option>
				  <option value="2">Không hiện phụ đề</option>
				  <option value="3">Phụ dề không khớp</option>
				  <option value="4">Khác</option>
			</select>
          </div>
      </div>
      
      <div class="row hideall filmShow">
      	<label class="forn-control col-xs-4">Thời gian gặp lỗi</label>
      	<div class="form-group col-xs-8">
            <input type="text" class="form-control" id="timeError" placeholder="Số phút xem phim gặp lỗi">
          </div>
      </div>
      
      <div class="row hideall allShow">
      	<label class="forn-control col-xs-4">Email</label>
      	<div class="form-group col-xs-8">
            <input type="text" class="form-control" id="emailError" placeholder="Nhập email của bạn">
          </div>
      </div>
      
      <div class="form-group allShow">
        <textarea class="form-control" id="contentError" name="contentError" rows="3"></textarea>
      </div>
      <div class="text-right">
        <button class="btn tn-btn-default" type="submit" onclick="sendFeedBack()">Gửi</button>
      </div>
    </div>
    <div class="tn-popup-bot"><a href="javascript:void(0);" id="closeError" class="tn-popup-close tn-popup-in-close">ĐÓNG CỬA SỔ</a></div>
  </div>
  <div id="contact-popup" class="tn-popup-in pp-medium box-logreg" style="display:none">
    <div class="tn-popup-head">Contact Us</div>
    <div class="tn-popup-txt clearfix">
      
      <div class="row">
      	<label class="forn-control col-xs-4">Full name</label>
      	<div class="form-group col-xs-8">
            <input type="text" class="form-control" id="contactName" placeholder="Please type your name.">
          </div>
      </div>
      
      <div class="row">
      	<label class="forn-control col-xs-4">Email</label>
      	<div class="form-group col-xs-8">
            <input type="text" class="form-control" id="contactEmail" placeholder="Please type your email.">
          </div>
      </div>
      <div class="row">
      	<label class="forn-control col-xs-4">Phone</label>
      	<div class="form-group col-xs-8">
            <input type="text" class="form-control" id="contactPhone" placeholder="Please type your phone.">
          </div>
      </div>
      
      <div class="form-group">
        <textarea class="form-control" id="contactContent" name="contactContent" rows="3"></textarea>
      </div>
      <div class="text-right">
        <button class="btn tn-btn-default" type="submit" onclick="sendContact()">Gửi</button>
      </div>
    </div>
    <div class="tn-popup-bot"><a href="javascript:void(0);" id="closeContact" class="tn-popup-close tn-popup-in-close">ĐÓNG CỬA SỔ</a></div>
  </div>

</div>

<style>
#survey-popup{
	display: block;
    border-radius: 5px;
    box-shadow: 2px 2px 10px 5px #ccc;
}
.survey-button{
	padding: 5px 10px;
    border: 1px solid #73d32d;
    border-radius: 5px;
    margin: 5px 5px;
	
	-webkit-transition: background-color 100ms ease-out 0.1s;
    -moz-transition: background-color 100ms ease-out 0.1s;
    -o-transition: background-color 100ms ease-out 0.1s;
    transition: background-color 100ms ease-out 0.1s;	
}
.survey-button:hover {
	background-color: #73d32d;
	text-decoration: none !important;
	color: #fff;
}
</style>
<div id="survey-popup" class="tn-popup-in pp-medium box-logreg" style="display:none">
    <div class="tn-popup-head">Khảo sát ý kiến</div>
    <div class="tn-popup-txt clearfix" style="padding: 20px 40px;">
      <div class="row">
      	<label class="forn-control" style="text-align: justify;">
      	 Với mong muốn luôn luôn tiếp tục cải thiện và phát triển tốt hơn nữa dịch vụ của mình, chúng tôi muốn mời người dùng của HDOnline tham gia một cuộc khảo sát nhỏ (khoảng 15 phút). Mọi người tham gia sẽ được HDOnline tặng 1 tháng VIP miễn phí (phần thưởng sẽ được gửi vào tin nhắn điện thoại)
      	</label>
      </div>
      <div class="form-group col-xs-12" style="text-align: center;margin-top: 20px;">
         <a href="javascript:void(0)" id="disable-survey"  class="survey-button">Để sau</a>
      	 <a href="javascript:void(0)" id="survey-link" class="survey-button" target="_blank">Tham gia</a>
      	 
      </div>
    </div>
</div>

<div id="fb-root"></div>
<script src="<?php echo TEMPLATE_URL;?>frontend/js/ttn.min.js?v=003"></script>
<script type="text/javascript">
String.prototype.score=function(e,f){'use strict';if(this===e)return 1;if(""===e)return 0;var c=0,a,g=this.toLowerCase(),n=this.length,h=e.toLowerCase(),k=e.length,b;a=0;var l=1,m;f&&(m=1-f);if(f)for(var d=0;d<k;++d)b=g.indexOf(h[d],a),-1===b?l+=m:(a===b?a=.7:(a=.1," "===this[b-1]&&(a+=.8)),this[b]===e[d]&&(a+=.1),c+=a,a=b+1);else for(d=0;d<k;++d){b=g.indexOf(h[d],a);if(-1===b)return 0;a===b?a=.7:(a=.1," "===this[b-1]&&(a+=.8));this[b]===e[d]&&(a+=.1);c+=a;a=b+1}c=.5*(c/n+c/k)/l;h[0]===g[0]&&.85>c&&(c+=.15);return c};
var arrFilm = new Array();
var arrPeople = new Array();
var oldPath = "";
var oldTitle = "";
var hasCtrlBtn = false;
function checkRememberMe(){
	var user = unescape(getVCookie('UserName'));
	var pass = unescape(getVCookie('UserPass'));
	if (user != null && pass != null && user != "null" && pass != "null"){ 
	  	$('#inputEmail3').val(user);
	  	$('#inputPassword3').val("datacookie_" + pass);
	  	$('#expire').attr('checked', 'checked');
	}
}
function detectiOS(){
	if ( navigator.userAgent.match(/iPhone/i)
		 || navigator.userAgent.match(/iPad/i)
		 || navigator.userAgent.match(/iPod/i) ){
		  return true; 
	}
	return false;
}
function detectAndroid(){
	if ( navigator.userAgent.match(/Android/i)){
		  return true; 
	}
	return false;
}
function detectwebOS(){
	if ( navigator.userAgent.match(/webOS/i)){
		  return true; 
	}
	return false;
}

function closeNoelMinion(){
	$("#minion_noel").hide();
	setVCookie("minionNoel", new Date());
}
function closeNoelPopup(){
	$(".noel_event_alert").hide();
		var popopShow = 0 ;
	popopShow = getVCookie("popupTimes");
	if (popopShow == null || popopShow == 0){
		setVCookie("popupTimes", 1);
	} else {
		setVCookie("alertError", new Date());
		setVCookie("popupTimes", 0);
	}
	}

function viewMovie(id){
	if (oldPath == ""){
		oldPath = window.location.href;
		oldTitle = document.title;
	}
	if (id){
		$("body").append('<div id="trailer-popup" class="tn-popup-in movieview box-logreg" style="display:none;background-color: transparent;">'+
			    '<div class="tn-popup-txt clearfix" style="padding: 0px;"><div id="trailer_player" style="width:100%;"></div></div>'+
			    '</div>');
		$(".movieview #trailer_player").load( "<?php echo SITE_URL; ?>/frontend/episode/iframe?slug=" + id );
		$(".movieview").css({
			top:($(window).height() - $("#trailer-popup").height())/2,
			left:($(window).width() - 0.9 *$(window).width())/2,
			width:  0.9 *$(window).width()
			}).fadeIn("fast");
		$('.movie-bg-popup').css('background-color', 'rgba(0, 0, 0, 0.95)').fadeIn();
		try{
			if (FB){
				FB.Event.unsubscribe('edge.create', callSaveLike);
				FB.Event.subscribe('edge.create', callSaveLike);
			}
		}catch(e){}
    }
};

function callCloseMovieView(){
	$('.movieview').remove();
	$('.movie-bg-popup').fadeOut();
	$('.screenshotview, .movie-screens-bg').fadeOut();
	if (oldPath != ""){
		sendURL(oldPath);
		document.title = oldTitle;
	}
	try {
		jwplayer('hdoplayer').remove();
	} catch (e){}
}

function callSaveLike(response){
	if (PlayFilm != undefined){
		setLikeCount(PlayFilm, true);
		setLike(PlayFilm, ".btn-likes-movie", true);
	}
}
$(window).resize(function(){
	$(".tn-main-r .tab-content").height($(".tn-main2").height());
	$(".movieview").css({
		top:($(window).height() - $(".tn-main2").height())/2,
		left:($(window).width() - 0.9 *$(window).width())/2,
		
	});

});

	
function HDOkeyHandler (event) {
	if(event.keyCode == 27 ) 	{
		callCloseMovieView();
		event.preventDefault();
	} else if ( event.keyCode == 17){
		hasCtrlBtn = true;
	}
	
}
function showPoupRegister(){
	$(".box-logreg-popup-new").hide();
	$("#show_pp_logregister").fadeIn();
	return false;
}
$(document). ready(function(e){
	if (navigator.userAgent.search(/arora/i) != -1)
		window.onkeydown = HDOkeyHandler;
	else if (navigator.userAgent.search(/opera/i) != -1)
		window.onkeypress = HDOkeyHandler;
	else
		window.onkeydown = HDOkeyHandler;

	window.onkeyup = function(){
		hasCtrlBtn = false;
	};
		$(".tn-bxitem a.bxitem-link").click(function(){
		var href = $(this).attr('href');
		
		if (href && href.indexOf(".html")){
			if (hasCtrlBtn == false){
    			href = href.substring(6);
    			var arrLink = href.split("-");
    			arrLink.splice(arrLink.length - 1, 1);
    			var slug = arrLink.join("-");
    			viewMovie(slug);
    			return false;
			}
		}
	});

	$(".tn-bxitem a.bxitem-link .bxitem-txt").click(function(){
		var href = $(this).parents('a.bxitem-link').attr('href');
		
		if (href && href.indexOf(".html")){
			window.location.href = href;
    		return false;
		}
	});
	
	$("#loginSpace, .btn-socialLogin-close").on('click', function(){
		$(".box-logreg-popup-new").hide();
		$("#loginSpace").fadeOut();
	});
		$.scrollUp({
        animation: 'fade',
        activeOverlay: '#00FFFF',
        scrollImg: {
            active: true
        }
    });
	if (detectiOS() == true){
		
	}
		if (typeof(PlayFilm) != "undefined" && Math.round(PlayFilm) > 0){
    	$.ajax({
    		url: "https://graph.facebook.com/v2.3/me?method=get&pretty=0&sdk=joey",
    		dataType:"json",
    		type:"GET",
    		timeout: 5000
    	}).done(function(e){
    		$("#facebook_framepage").html('<iframe  width="300px" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:page Facebook Social Plugin" src="https://www.facebook.com/v2.3/plugins/page.php?app_id=138449339641932&channel=https%3A%2F%2Fs-static.ak.facebook.com%2Fconnect%2Fxd_arbiter%2FKTWTb9MY5lw.js%3Fversion%3D41%23cb%3Df15a4bfa2%26domain%3Ddevelopers.facebook.com%26origin%3Dhttps%253A%252F%252Fdevelopers.facebook.com%252Ff345a6a80%26relation%3Dparent.parent&container_width=588&hide_cover=false&href=' + escape(URL_FANPAGE)+ '&locale=vi_VN&sdk=joey&show_facepile=true&show_posts=true&width=300" style="border: none; visibility: visible; width: 300px; height: 500px;" class=""></iframe>');
    	}).fail(function(e){
        	if (e && e.status > 0){
        		$("#facebook_framepage").html('<iframe  width="300px" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:page Facebook Social Plugin" src="https://www.facebook.com/v2.3/plugins/page.php?app_id=138449339641932&channel=https%3A%2F%2Fs-static.ak.facebook.com%2Fconnect%2Fxd_arbiter%2FKTWTb9MY5lw.js%3Fversion%3D41%23cb%3Df15a4bfa2%26domain%3Ddevelopers.facebook.com%26origin%3Dhttps%253A%252F%252Fdevelopers.facebook.com%252Ff345a6a80%26relation%3Dparent.parent&container_width=588&hide_cover=false&href=' + escape(URL_FANPAGE)+ '&locale=vi_VN&sdk=joey&show_facepile=true&show_posts=true&width=300" style="border: none; visibility: visible; width: 300px; height: 500px;" class=""></iframe>');
            }
    	});
	}
	
	checkRememberMe();
	
	if (cookieOnceDay("userLoginTracking") == true){
		if (isLogin){
						setVCookie("userLoginTracking", new Date());
		}
	}
});

var oldScrollTop = 0;
$(window).on("scroll", function(){
	if ($(window).scrollTop() < oldScrollTop){
		if ($("header.tn-header-full").css("position") != "fixed"){
    		$("header.tn-header-full").css({
    			position: "fixed",
    			top: - $("header.tn-header-full").outerHeight(),
    			backgroundColor : "#fff"
    		});
    		$("header.tn-header-full").animate({top: "0px"}, 500);
    		$(".tn-main-full").css("margin-top", $("header.tn-header-full").outerHeight());
		}
	} else {
		$("header.tn-header-full").css({
			position: "relative",
			top: "0px"
		});
		$(".tn-main-full").css("margin-top", "0px");
	}
	oldScrollTop = $(window).scrollTop();
});

window.fbAsyncInit = function() {
    FB.init({
	appId      : '138449339641932',
	status     : true,
    xfbml      : true,
	version    : 'v2.1'
	});
    FB.Event.subscribe('edge.create',function(response)
	{
		/* SET LIKE PLUS */
		if (PlayFilm != undefined){
			setLikeCount(PlayFilm, true);
			setLike(PlayFilm, ".btn-likes-movie", true);
		}
	});
	FB.Event.subscribe('edge.remove',function(response) {
		/* SET DISLIKE PLUS */
		if (PlayFilm != undefined){
			setLikeCount(PlayFilm, false);
		}
	});
	FB.Event.subscribe('comment.create',	function(response) {
		
		if (PlayFilm != undefined){
			setCommentCount(PlayFilm, true);
		}
	});
	FB.Event.subscribe('comment.remove',function(response) {});
  };  
</script>

<style>
#minion_noel a:hover{
    -webkit-animation: donate-a 1s infinite linear;
    -moz-animation: donate-a 1s infinite linear;
    -o-animation: donate-a 1s infinite linear;
    animation: donate-a 1s infinite linear;
}
@-webkit-keyframes donate-a {
 0% {-webkit-transform: translate(0px, 0px);}
 25% {-webkit-transform: translate(0px, 5px);}
 50% {-webkit-transform: translate(0px, 10px);}
 75% {-webkit-transform: translate(0px, 5px);}
 100% {-webkit-transform: translate(0px, 0px);}
}
 @-moz-keyframes donate-a {
 0% {-moz-transform: translate(0px, 0px);}
 25% {-moz-transform: translate(0px, 5px);}
 50% {-moz-transform: translate(0px, 10px);}
 75% {-moz-transform: translate(0px, 5px);}
 100% {-moz-transform: translate(0px, 0px);}
}
 @-o-keyframes donate-a {
 0% {-o-transform: translate(0px, 0px);}
 25% {-o-transform: translate(0px, 5px);}
 50% {-o-transform: translate(0px, 10px);}
 75% {-o-transform: translate(0px, 5px);}
 100% {-o-transform: translate(0px, 0px);}
}
 @keyframes donate-a {
 0% {transform: translate(0px, 0px);}
 25% {transform: translate(0px, 5px);}
 50% {transform: translate(0px, 10px);}
 75% {transform: translate(0px, 5px);}
 100% {transform: translate(0px, 0px);}
}
.noel {
	width: 100px !important;
}
.noel_event_alert{
	display: none;
	text-align: center;
    position: fixed;
    width: 500px;
    height: 500px;
    top: 10px;
	z-index: 500;
	left: 30%;
}
.btn-close-noel{
	position: absolute;
    background: rgba(237, 28, 36, 0.33);
    margin: 5px;
    color: #fff;
    border-radius: 0px;
}
</style>
</body>
</html>


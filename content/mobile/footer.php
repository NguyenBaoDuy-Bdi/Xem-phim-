</div>
</div>

<!--/main -->
<!--footer-->
<center><h2>Xem Phim Hd Hay | Phim Hành Động Hay</h2></center>
<footer>
    <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="footer-link">
						<h3 class="footer-link-head">Phim Hay</h3>                            
                            <p><a href="<?php echo SITE_URL;?>/post/gioi-thieu/">Giới thiệu chung</a>
                            </p>
                            <p><a href="<?php echo SITE_URL;?>/post/tuyen-dung/">Tuyển dụng</a>
							</p>
                            <p><a href="<?php echo SITE_URL;?>/danh-sach/phim-moi/">Tất cả phim</a>
                            </p>
                           
                    </div>
					 <div class="footer-link">
                        <h3 class="footer-link-head">Chương trình</h3>
                       
                            <p><a href="<?php echo SITE_URL;?>/post/quang-cao/">Quảng cáo</a>
                            </p>
                          <p><a href="<?php echo SITE_URL;?>/post/huong-dan-kiem-tien/">Hướng dấn kiếm tiền</a>
                            </p>
                    </div>
					<div class="footer-link">
                        <h3 class="footer-link-head">Hỗ trợ</h3>
                       
                            <p><a href="<?php echo SITE_URL;?>/post/tro-giup/">Trung tâm trợ giúp</a>
                            </p>
							 <p><a href="<?php echo SITE_URL;?>/post/lien-he/">Liên hệ</a>
                            </p>
                         
                    </div>
                    <div class="footer-link">
                        <h3 class="footer-link-head">Điều khoản pháp lý</h3>

                        <p><a href="<?php echo SITE_URL;?>/post/dieu-khoan-su-dung/">Điều khoản sử dụng</a>
                            </p>
                            <p><a href="<?php echo SITE_URL;?>/post/bao-mat-thong-tin/">Bảo mật thông tin</a>
                            </p>
                            <p><a href="<?php echo SITE_URL;?>/post/noi-dung-cam/">Nội dung cấm</a>
                            </p>
                            <p><a href="<?php echo SITE_URL;?>/post/ban-quyen/">Bản quyền</a></p>
							
                    </div>                   
					
                    <div class="clearfix"></div>
                </div>
                
                <div class="col-lg-4 footer-copyright">
                    <p><img border="0" src="<?=SITE_URL?>/assets/images/logo-light.png" height="50px" class="mv-ft-logo"></p>

                    <p>Copyright &copy; GLAphimv.tv All Rights Reserved</p>

                    <p style="font-size: 11px; line-height: 14px; color: rgba(255,255,255,0.4)">Cảnh báo: Trang web này không lưu trữ bất kỳ phim nào trên máy chủ. Tất cả nội dung được cung cấp bởi các thành viên.</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</footer>

    <!-- Modal -->
    <div class="modal fade modal-cuz" id="pop-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                            class="fa fa-close"></i>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">ĐĂNG NHẬP</h4>
                </div>
                <div class="modal-body">
                    <p class="desc">Xem phim HD trực tuyến miễn phí và tải những bộ phim mới nhất. Đối với tất cả mọi người, ở mọi nơi, mọi thiết bị, và tất cả mọi thứ ;)</p>

                    <form id="login-form" method="POST" action="<?=SITE_URL?>/ajax/user_login/">
                        <div class="block">
                            <input required type="text" class="form-control" name="username" id="username"
                                   placeholder="Tài khoản hoặc Email">
                        </div>
                        <div class="block mt10">
                            <input required type="password" class="form-control" name="password" id="password"
                                   placeholder="Mật khẩu">
                        </div>
                        <div style="display: none;" id="error-message" class="alert alert-danger"></div>
                        <div class="block mt10 small">
                            <label><input type="checkbox" style="vertical-align: sub; margin-right: 3px;">Ghi nhớ</label>

                            <div class="pull-right">
                                <a id="open-forgot" data-dismiss="modal" data-target="#pop-forgot"
                                   data-toggle="modal" title="Forgot password?">Quên mật khẩu?</a>
                            </div>
                        </div>
                        <button id="login-submit" type="submit" class="btn btn-block btn-success btn-approve mt10">
                            Đăng nhập
                        </button>
                       
                        <p id="login-loading" style="display: none; text-align: center;">
                            <img class="mt10"
                                 height="35px"
                                 src="<?=SITE_URL?>/assets/images/ajax-loading.gif">
                        </p>
                    </form>
                </div>
                <div class="modal-footer text-center">
                    Bạn chưa có tài khoản? <a id="open-register" data-dismiss="modal" data-target="#pop-register" data-toggle="modal" title="">Đăng ký ngay!</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-cuz" id="pop-register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                            class="fa fa-close"></i>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Đăng ký thành viên</h4>
                </div>
                <div class="modal-body">
                    <p class="desc">Khi trở thành thành viên của trang web, bạn có thể sử dụng đầy đủ các chức năng, thưởng thức những bộ phim thú vị nhất và có thể upload phim kiếm tiền.</p>

                    <form id="register-form" method="POST" action="<?=SITE_URL?>/ajax/user_register/">
                        
                        <div id="error-full_name" class="alert alert-danger error-block"></div>
                        <div class="block mt10">
                            <input required type="text" class="form-control" name="username" id="username"
                                   placeholder="Tên tài khoản">
                        </div>
                        <div id="error-username" class="alert alert-danger error-block"></div>
                        <div class="block mt10">
                            <input required type="email" class="form-control" name="email" id="email"
                                   placeholder="Email">
                        </div>
                        <div id="error-email" class="alert alert-danger error-block"></div>
                        <div class="block mt10">
                            <input required type="password" class="form-control" name="password" id="password"
                                   placeholder="Mật khẩu">
                        </div>
                        <div id="error-password" class="alert alert-danger error-block"></div>
                        <div class="block mt10">
                            <input required type="password" class="form-control" name="confirm_password"
                                   id="confirm_password"
                                   placeholder="Gõ lại mật khẩu">
                        </div>
                        <div id="error-confirm_password" class="alert alert-danger error-block"></div>
                        <button type="submit" class="btn btn-block btn-success btn-approve mt20">Đăng ký</button>
                        <!--                        <button type="button" class="btn btn-block btn-facebook mt10"><i-->
                        <!--                                class="fa fa-facebook mr10"></i>Register-->
                        <!--                            via facebook-->
                        <!--                        </button>-->
                        <p id="register-loading" style="display: none; text-align: center;">
                            <img class="mt10"
                                 height="35px"
                                 src="<?=SITE_URL?>/assets/images/ajax-loading.gif">
                        </p>
                    </form>
                </div>
                <div class="modal-footer text-center">
                    <a id="open-register" style="color: #888" data-dismiss="modal" data-target="#pop-login"
                       data-toggle="modal" title=""><i class="fa fa-chevron-left mr10"></i>Trở lại trang đăng nhập</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-cuz" id="pop-forgot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                            class="fa fa-close"></i>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Quên mật khẩu</h4>
                </div>
                <div class="modal-body">
                    <p class="desc">Chúng tôi sẽ gửi mật khẩu mới tới email của bạn. Xin vui lòng điền email của bạn vào khung phía dưới.</p>

                    <form id="forgot-form">
                        <div class="block mt10">
                            <input type="email" class="form-control" name="email" id="email"
                                   placeholder="Email của bạn"
                                   required>
                        </div>
                        <div style="display: none;" id="forgot-success-message" class="alert alert-success"></div>
                        <div style="display: none;" id="forgot-error-message" class="alert alert-danger"></div>
                        <button type="submit" class="btn btn-block btn-success btn-approve mt20">Submit</button>
                    </form>
                </div>
                <div class="modal-footer text-center">
                    <a id="open-register" style="color: #888" data-dismiss="modal" data-target="#pop-login"
                       data-toggle="modal" title=""><i class="fa fa-chevron-left mr10"></i>Trở lại trang đăng nhập</a>
                </div>
            </div>
        </div>
    </div>
    <!--/ modal -->
	<script type="text/javascript" src="<?=SITE_URL?>/assets/js/bootstrap.min.js?v=0.1"></script>
<script type="text/javascript" src="<?=SITE_URL?>/assets/js/bootstrap-select.js?v=0.1"></script>
<script type="text/javascript" src="<?=SITE_URL?>/assets/js/user.min.js?v=0.5"></script>
<script type="text/javascript" src="<?=SITE_URL?>/assets/js/auth.min.js?v=0.2"></script>
<?php if($mode=='phim' || $mode=='xem-phim'){?>
<script type="text/javascript" src="<?=SITE_URL?>/assets/js/player.123movies.v2.min.js?v=1.4"></script>
<?}?>
<?php if($mode!='xem-phim'){?>
<script type="text/javascript" src="<?=SITE_URL?>/assets/js/slide.min.js"></script>
<script type="text/javascript" src="<?=SITE_URL?>/assets/js/psbar.jquery.min.js"></script>
<script type="text/javascript" src="<?=SITE_URL?>/assets/js/jquery.lazyload.js"></script>
    <script>
        var swiper = new Swiper('#slider', {
            pagination: '.swiper-pagination',
            paginationClickable: true,
            loop: true,
            autoplay: 4000
        });

        $(function () {
            $('.tn-news, .tn-notice').perfectScrollbar();
        });
    </script>
<?}?>

</body>
</html>
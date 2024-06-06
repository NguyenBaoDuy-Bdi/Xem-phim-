<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
$page = $geturl[2];
$user = MySql::dbselect('username,email,lastlogin,lastreg,facebookid,fullname,ugroup,fav_feature,fav_playlist','user',"id = '".$_SESSION["RK_Userid"]."'");
$fullname = $user[0][5];
$username = $user[0][0];
$email = $user[0][1];
$lastlogin = GetDateT($user[0][2]);
$lastreg = GetDateT($user[0][3]);
$ugroup = LoginAuth::GroupUser($user[0][6]);
$facebookurl = $user[0][4];
if(!$image) $image = SITE_URL.'/assets/images/default_avatars.jpg';
if(!$_SESSION["RK_Userid"]){
	header("Location: ".SITE_URL);
	exit;
}
?>
<div class="pad"></div>
        <div class="main-content main-detail">
            <div id="bread">
                <ol class="breadcrumb">
                    <li><a href="<?=SITE_URL?>/">Home</a></li>
                    <li>User</li>
                    <li class="active"><?if($page=='profile'){ echo 'Thông tin';}elseif($page=='update'){ echo 'Cập nhật thông tin';}elseif($page=='notify'){ echo 'Thông báo';}elseif($page=='billing'){ echo 'Thông tin thanh toán';}elseif($page=='payment'){ echo 'Yêu cầu thanh toán';}elseif($geturl[3]=='favorite'){ echo 'Phim yêu thích';}?></li>
                </ol>
            </div>
<div class="profiles-wrap">
   <div class="sidebar">
    <div class="sidebar-menu">
        <div class="sb-title"><i class="fa fa-navicon mr5"></i> Menu</div>
        <ul>
            <li class="<?if($page=='profile'){ echo 'active';}?>">
                <a href="<?=SITE_URL?>/user/profile">
                    <i class="fa fa-user mr5"></i> Thông tin
                </a>
            </li>
            <li class="<?if($page=='movies'){ echo 'active';}?>">
                <a href="<?=SITE_URL?>/user/movies/favorite">
                    <i class="fa fa-heart mr5"></i> Phim yêu thích
                </a>
            </li>
            <li class="<?if($page=='notify'){ echo 'active';}?>">
                <a href="<?=SITE_URL?>/user/notify">
                    <i class="fa fa-bell mr5"> </i>
                    Thông báo
                </a>
            </li>
            <li class="<?if($page=='update'){ echo 'active';}?>">
                <a href="<?=SITE_URL?>/user/update">
                    <i class="fa fa-pencil mr5"></i> Cập nhật thông tin
                </a>
            </li>
			<li class="<?if($page=='billing'){ echo 'active';}?>">
				<a href="<?=SITE_URL?>/user/billing">
					<i class="fa fa-money mr5"></i> 
					Thông tin thanh toán
				</a>
			</li>
			<li class="<?if($page=='payment'){ echo 'active';}?>">
				<a href="<?=SITE_URL?>/user/payment">
					<i class="fa fa-dollar mr5"></i> 
					Yêu cầu thanh toán
				</a>
			</li>
            <li><a href="<?=SITE_URL?>/uploads/?action=film"><i class="fa fa-list mr5"></i> Phim đã Up</a></li>
			<li class="<?if($page=='addfilm'){ echo 'active';}?>">
				<a href="<?=SITE_URL?>/uploads/?action=film&mode=add">
					<i class="fa fa-plus mr5"></i> 
					Đăng phim
				</a>
			</li>
        </ul>
    </div>
</div>
<div class="pp-main">
<?php
if($page == 'profile') {
?>
<div class="ppm-head">
                        <div class="ppmh-title"><i class="fa fa-user mr5"></i> Thông tin</div>
                    </div>
                    <div class="ppm-content user-content">
                        <div class="uct-avatar">
                            <img class="avatar"
                                 src="<?=$image?>"
                                 title="<?php echo $fullname;?>" alt="<?php echo $fullname;?>">
                        </div>
                        <div class="uct-info">
						<?php
						$views = one_data("SUM(viewed) views","film","userpost = '".$_SESSION["RK_Userid"]."'");
						?>
						<div class="block">
                                <label>Hiện có:</label> <?php echo number_format($views*(3000/1000));?> <font color="red">đ </font><i>(Hiện tại 3000đ/1000 lượt xem)    </i>                       </div>
							<div class="block">
                                <label>Tổng phim:</label> <?php echo one_data("COUNT(id)","film","userpost = '".$_SESSION["RK_Userid"]."'");?>  phim                          </div>
							<div class="block">
                                <label>Tổng lượt xem:</label> <?php echo number_format($views);?>                            </div>
                            <div class="block">
                                <label>Full name:</label> <?php echo $fullname;?>                            </div>
                            <div class="block">
                                <label>Username:</label> <?=$username?>                            </div>
                            <div class="block">
                                <label>Account ID:</label> <?=$_SESSION["RK_Userid"]?>                            </div>
							
                            <div class="block">
                                <label>Email:</label> <?=$email?>                           </div>
						
                            <div class="block">
                                <label>Facebook:</label> <?php echo $facebookurl;?>         </div>
							<div class="block">
                                <label>Join date:</label> <?php echo $lastreg;?>                          </div>
                            <div class="block">
                                <label>Last login:</label> <?php echo $lastlogin;?>                       </div>
                            <div class="mt20">
                                <a href="<?=SITE_URL?>/user/update" class="btn btn-success" title="">Edit
                                    account info</a>
                            </div>
							
                        </div>
                        <div class="clearfix"></div>
                    </div>
                
<?php } else if($page == 'facebook') { 
require_once(RK_ROOT . '/include/lib/facebook/facebook.php');
$facebook = new Facebook(array(
  "appId"  => "776430565729625",
  "secret" => "417127c83a295734e754a8fd275a3e40",
  'cookie' => true,
));
$user = $facebook->getUser();
if ($user) {
  try {
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}
$loginUrl = $facebook->getLoginUrl(array(
	'scope'	 => 'email,user_birthday,user_location', // Permissions to request from the user
));
if ($user) {
	//print_r($user_profile);
	//LoginAuth::loginUser($user_profile["username"],$_POST['password'],$_POST['remember']);
	$username = $user_profile["username"];
	$user = MySql::dbselect("id,username,password,codesecurity","user","username = '$username' OR email = '$username'");
	if($user) {
		$userid = $user[0][0];
		$lastlogin = time();
		MySql::dbupdate('user',"lastlogin = '$lastlogin'","id = '$userid'");
		$_SESSION["RK_Userid"] 	= $userid;
	}else {
		$username = $user_profile["username"];
		$fullname = $user_profile["name"];
		$email = $user_profile["email"];
		$facebookurl = 'https://www.facebook.com/'.$user_profile["id"];
		$codesecurity = rand(1000,9999);
		$lastreg = time();
		MySql::dbinsert("user","username,email,codesecurity,lastreg,facebookid,fullname","'$username','$email','$codesecurity','$lastreg','$facebookurl','$fullname'");
		$userid = mysql_insert_id();
		$_SESSION["RK_Userid"] 	= $userid;
	}
	header("Location: ".SITE_URL);
} else header("Location: ".$loginUrl);
?>
<?php } elseif($page == 'quen-mat-khau') { ?>
<div style="margin-top:70px"></div>
<div class="p-profile clearfix" id="lost_pass">
	<div class="user-info">
		<div class="middle_left" style="width:65%">
			<label class="tit">Quên mật khẩu</label>
			<div class="stat">
				<ul>
					<li><label>Email</label><span><input type="text" id="email" class="text"/></span></li>
					<li><label>Mã xác nhận</label><span style="position:relative"><input type="text" class="text" name="security" id="security"/><img src='<?php echo SITE_URL; ?>/include/lib/security.php?<?php echo time();?>' border=0 style="position: absolute;right: 5px;top: -1px;height: 20px;"/></span></li>
					<li><label></label><span><input type="submit" value="Quên mật khẩu" class="button"/></span></li>
				</ul>
			</div>
		</div>
		<div class="middle_right" style="width:35%">
			<label class="tit">Lưu ý</label>
			<div class="stat" style="color:#414141">
				 Trường hợp nếu bạn không nhớ mật khẩu của mình thì hãy cung cấp thông tin cá nhân và lịch sử nạp card và gửi về mail để hdonline hỗ trợ cho bạn.
			</div>
		</div>
	</div>
</div>
<?php } elseif($page == 'notify') { 
$arr = MySql::dbselect('nt_content,timeupdate','notice JOIN tb_user ON (tb_user.id = tb_notice.userid)',"userid='".$_SESSION["RK_Userid"]."'");
$total_mes = count($arr);
MySql::dbupdate('notice',"n_read=1","userid='".$_SESSION["RK_Userid"]."'");
?>
                    <div class="ppm-head">
                        <div class="ppmh-title">
                            <i class="fa fa-bell-o mr5"></i> Thông báo
                                                    </div>
                    </div>
                    <div class="ppm-content noti-content">
                        <ul>
					<?php
					if($total_mes){
						for($i=0;$i<count($arr);$i++) {
					?>
					<li class=""><a href="<?=SITE_URL?>/user/notify" title=""><?=$arr[$i][0]?></a><a class="time">Vào lúc <?=date('g:h:i d/m/Y',$arr[$i][1])?></a></li>
						<?}
					}else{?>
					  <li class="more">Bạn chưa có thông báo nào.</li>
					<?}?>
                                                          
                       </ul>
                    </div>
                    <div id="pagination">
                        <nav>
                                                    </nav>
                    </div>
                </div>
             
<?php }elseif($page == 'movies'){
$viewurl = $geturl[3];	
?>
 <div class="ppm-head">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="<?php if($viewurl=='favorite'){?>active<?}?>"><a
                                    href="<?=SITE_URL?>/user/movies/favorite"><i class="fa fa-bookmark mr5"></i>
                                    Favourites</a></li>
                            <li class="<?php if($viewurl=='rated'){?>active<?}?>"><a
                                    href="<?=SITE_URL?>/user/movies/rated"><i class="fa fa-star mr5"></i>
                                    Rated</a></li>
                        </ul>
                    </div>
			 <div class="ppm-content">
			 <?php if($viewurl == 'favorite'){?>
			 <div class="movies-list-wrap mlw-profiles">
                            <div class="movies-list movies-list-full">
                            <?php echo li_filmMEM(12,$user[0][7],'fav_feature');?>        
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
			 <?}else{?>
			 <?}?>
<?php } elseif($page == 'update') { 
if(!$_SESSION["RK_Userid"]){
	header("Location: ".SITE_URL);
	exit;
}
?>
 <div class="ppm-head">
                        <div class="ppmh-title"><i class="fa fa-pencil-square-o mr5"></i> Update Profile</div>
                    </div>
                    <div class="ppm-content update-content">
                        <div class="uc-form">
                            <form id="profile-form" action="<?=SITE_URL?>/user/update" method="POST"
                                  class="form-horizontal" enctype="multipart/form-data">
                               
                               
                                <div class="form-group">
                                    <label for="full_name" class="col-sm-4 control-label">Full name</label>

                                    <div class="col-sm-8">
                                        <input name="fullname" type="text" class="form-control" id="full_name"
                                               value="<?=$fullname?>">

                                        <span id="error-full_name"
                                              class="help-block error-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="col-sm-4 control-label">Username</label>

                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control" id="username"
                                               value="<?=$username?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-4 control-label">Email</label>

                                    <div class="col-sm-8">
                                        <input readonly type="email" class="form-control" id="email"
                                               value="<?=$email?>">
                                    </div>
                                </div>                                
                               
                                <div class="form-group">
                                    <label for="facebook" class="col-sm-4 control-label">Facebook</label>

                                    <div class="col-sm-8">
                                        <input type="url" class="form-control" id="facebook"
                                               name="facebook" value="<?=$facebookurl?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="old_password" class="col-sm-4 control-label">Old Password</label>

                                    <div class="col-sm-8">
                                        <input name="old_password" type="password" class="form-control"
                                               id="old_password">

                                        <span id="error-old_password"
                                              class="help-block error-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="new_password" class="col-sm-4 control-label">New password</label>

                                    <div class="col-sm-8">
                                        <input name="new_password" type="password" class="form-control"
                                               id="new_password">

                                        <span id="error-new_password"
                                              class="help-block error-block"></span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="username" class="col-sm-4 control-label"></label>

                                    <div class="col-sm-8">
                                        <button id="btn-update" type="submit" name="submit" class="btn btn-success btn-approve mt10">
                                            Save
                                        </button>
                                        <img id="submit-loading" style="display: none;" class="ml10 mt10" height="35px"
                                             src="<?=SITE_URL?>/assets/images/ajax-loading.gif">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
<script>
    $("#profile-form").submit(function (e) {
        $("#btn-update").prop("disabled", true);
        $("#submit-loading").show();
        var postData = new FormData(this);
        var formURL = $(this).attr("action");
        $.ajax({
            url: formURL,
            type: "POST",
            data: postData,
            dataType: "json",
            mimeType: "multipart/form-data",
            contentType: false,
            processData: false,
            cache: false,
            success: function (data) {
                $('.error-block').hide();
                if (data.status == 0) {
                    for (var message in data.messages) {
                        $('#error-' + message).show();
                        $('#error-' + message).text(data.messages[message]);
                    }
                    $('.csrf-token').html(data.csrf_token);
                    $("#btn-update").removeAttr("disabled");
                    $("#submit-loading").hide();
                }
                if (data.status == 1) {
                    window.location.reload();
                }
            }
        });
        e.preventDefault();
    });
</script>
<?php
}elseif($page=='billing'){
$u_billing = MySql::dbselect('bank,fullname,bankid,bank_brand,diachi,phone','user_billing',"userid = '".$_SESSION["RK_Userid"]."'");	
?>
<div class="ppm-head">
                        <div class="ppmh-title"><i class="fa fa-pencil-square-o mr5"></i> Thông tin thanh toán</div>
                    </div>
                    <div class="ppm-content update-content">
                        <div class="uc-form">
                            <form id="profile-form" action="<?=SITE_URL?>/user/billing" method="POST"
                                  class="form-horizontal" enctype="multipart/form-data">
                               
								<div class="form-group">
                                    <label for="bank" class="col-sm-4 control-label">Tên ngân hàng</label>

                                    <div class="col-sm-8">
                                        <input name="bank" type="text" class="form-control" id="full_name"
                                               value="<?=$u_billing[0][0]?>">

                                        <span id="error-full_name"
                                              class="help-block error-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="full_name" class="col-sm-4 control-label">Tên tài khoản</label>

                                    <div class="col-sm-8">
                                        <input name="fullname" type="text" class="form-control" id="full_name"
                                               value="<?=$u_billing[0][1]?>">

                                        <span id="error-full_name"
                                              class="help-block error-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bankid" class="col-sm-4 control-label">Số tài khoản</label>

                                    <div class="col-sm-8">
                                        <input type="text" name="bankid" class="form-control" id="bankid"
                                               value="<?=$u_billing[0][2]?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="diachi" class="col-sm-4 control-label">Địa chỉ</label>

                                    <div class="col-sm-8">
                                        <input name="diachi" type="text" class="form-control" id="diachi"
                                               value="<?=$u_billing[0][4]?>">
                                    </div>
                                </div>                                
                               
                                <div class="form-group">
                                    <label for="phone" class="col-sm-4 control-label">Số điện thoại</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="phone"
                                               name="phone" value="<?=$u_billing[0][5]?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bank_brand" class="col-sm-4 control-label">Chi nhánh</label>

                                    <div class="col-sm-8">
                                        <input name="bank_brand" type="text" class="form-control"
                                               id="bank_brand" value="<?=$u_billing[0][3]?>">

                                        
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="username" class="col-sm-4 control-label"></label>

                                    <div class="col-sm-8">
                                        <button id="btn-update" type="submit" name="submit" class="btn btn-success btn-approve mt10">
                                            Cập nhật
                                        </button>
                                        <img id="submit-loading" style="display: none;" class="ml10 mt10" height="35px"
                                             src="<?=SITE_URL?>/assets/images/ajax-loading.gif">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
<script>
    $("#profile-form").submit(function (e) {
        $("#btn-update").prop("disabled", true);
        $("#submit-loading").show();
        var postData = new FormData(this);
        var formURL = $(this).attr("action");
        $.ajax({
            url: formURL,
            type: "POST",
            data: postData,
            dataType: "json",
            mimeType: "multipart/form-data",
            contentType: false,
            processData: false,
            cache: false,
            success: function (data) {
                $('.error-block').hide();
                if (data.status == 0) {
                    for (var message in data.messages) {
                        $('#error-' + message).show();
                        $('#error-' + message).text(data.messages[message]);
                    }
                    $('.csrf-token').html(data.csrf_token);
                    $("#btn-update").removeAttr("disabled");
                    $("#submit-loading").hide();
                }
                if (data.status == 1) {
                    window.location.reload();
                }
            }
        });
        e.preventDefault();
    });
</script>
<?}elseif($page == 'payment'){?>
<div class="ppm-head">
                        <div class="ppmh-title"><i class="fa fa-dollar mr5"></i> Yêu cầu thanh toán</div>
                    </div>
                    <div class="ppm-content update-content">
					<div class="alert alert-info" role="alert">
					<i>- Số tiền tối thiểu để yêu cầu thanh toán là 100.000 vnđ</i><br/>
					<i>- Bạn có thể yêu cầu thanh toán bằng 2 cách:<br/>
						1. Chuyển khoản ngân hàng<br/>
						2. Nhận thẻ điện thoại, mã thẻ sẽ được gửi qua tin nhắn vào số điện thoại mà bạn cung cấp trong phần thông tin thanh toán.</i><br/>
					<i>- Thời gian thực hiện thanh toán trong vòng 24 - 48h kể từ khi yêu cầu.</i>
					</div>
                        <div class="uc-form">
                            <form id="profile-form" action="<?=SITE_URL?>/user/payment" method="POST"
                                  class="form-horizontal" enctype="multipart/form-data">
								<div class="form-group">
                                    <label for="bank_brand" class="col-sm-4 control-label">Số tiền thanh toán</label>

                                    <div class="col-sm-8">
                                      <input name="amount" type="text" class="form-control"
                                               id="amount" value="<?=$amount?>">                                        
                                    </div>
                                </div>
								<div class="form-group">
                                    <label for="bank_brand" class="col-sm-4 control-label">Chọn hình thức thanh toán</label>

                                    <div class="col-sm-8">
                                        <input name="payment" type="radio" id="payment" value="1"> Chuyển khoản <br/>
										<input name="payment" type="radio" id="payment" value="2"> Nhận thẻ điện thoại

                                        
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="username" class="col-sm-4 control-label"></label>

                                    <div class="col-sm-8">
									<?php
									$views = one_data("SUM(viewed) views","film","userpost = '".$_SESSION["RK_Userid"]."'");
									$tien = $views*(3000/1000);
									if($tien >=10000000){
									?>
                                        <button id="btn-update" type="submit" name="submit" class="btn btn-success btn-approve mt10">
                                            Yêu cầu thanh toán
                                        </button>
									<?}else{?>
									<button disabled class="btn btn-success btn-approve mt10">
                                            Bạn chưa đủ tiền để yêu cầu
                                        </button>
									<?}?>
                                        <img id="submit-loading" style="display: none;" class="ml10 mt10" height="35px"
                                             src="<?=SITE_URL?>/assets/images/ajax-loading.gif">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
<script>
    $("#profile-form").submit(function (e) {
        $("#btn-update").prop("disabled", true);
        $("#submit-loading").show();
        var postData = new FormData(this);
        var formURL = $(this).attr("action");
        $.ajax({
            url: formURL,
            type: "POST",
            data: postData,
            dataType: "json",
            mimeType: "multipart/form-data",
            contentType: false,
            processData: false,
            cache: false,
            success: function (data) {
                $('.error-block').hide();
                if (data.status == 0) {
                    for (var message in data.messages) {
                        $('#error-' + message).show();
                        $('#error-' + message).text(data.messages[message]);
                    }
                    $('.csrf-token').html(data.csrf_token);
                    $("#btn-update").removeAttr("disabled");
                    $("#submit-loading").hide();
                }
                if (data.status == 1) {
					alert('Yêu cầu thành công!');
                    window.location.reload();
                }
            }
        });
        e.preventDefault();
    });
</script>
<?	
}
echo '</div>
                <div class="clearfix"></div>
			</div>
        </div>
	<div class="clearfix"></div>
  </div>
</div>
';
include View::TemplateView('footer');
?>

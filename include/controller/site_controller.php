<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
class Site_Controller {
	public static function display($params) {
		$cururl = Url::curRequestURL();
		# Cache actor và phim
		//Film_Model::CacheActorSeatch();
		# Reset lượt xem
		Film_Model::ResetViewed();
		# Get info url
		$geturl = explode('/',$cururl);
		$mode = $geturl[1];
		// Phim và xem phim
		if(in_array($mode,array('phim','xem-phim'))) {
			$id = $geturl[2];
			$id = explode('-',$id);
			$id = $id[0];
			if($mode == 'phim') {
				$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film_other.keywords','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"id = '$id'");
				$site_title = 'Xem Phim '.$arr[0][1].' | '.$arr[0][6].' full HD';
				$site_description = str_replace('"', '',CutName(RemoveHtml(UnHtmlChars($arr[0][5])),200));
				$site_keywords = FixTags($arr[0][7]);
				$filmid = intval($arr[0][0]);
				
				$epwatch = MySql::dbselect('id,name','episode',"filmid = '$filmid' AND active=1 order by id asc limit 1");
				$epname = $epwatch[0][1];
				$epwatch = $epwatch[0][0];
			}else if($mode == 'xem-phim') {
				$epid = MySql::dbselect('id,name,filmid,url,subtitle','episode',"id = '$id' AND active=1");
				$epwatch = intval($epid[0][0]);
				$filmid = intval($epid[0][2]);
				//MySql::dbupdate('film',"viewed = viewed+1, viewed_day = viewed_day+1, viewed_week = viewed_week+1, viewed_month = viewed_month+1","id = '$filmid'");
				$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film_other.keywords','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"id = '$filmid'");
				$site_title = 'Xem Phim '.$arr[0][1].' Tập '.$epid[0][1].' - Phim '.$arr[0][6];
				$site_description = 'Xem Phim '.$arr[0][1].' Tập '.$epid[0][1].' | '.$arr[0][6].'  Ep '.$epid[0][1].'. Phim '.$arr[0][1].' Tập '.$epid[0][1].' HD chất lượng cao.';
				$site_keywords = FixTags('Xem Phim '.$arr[0][1].' Tập '.$epid[0][1].', '.$arr[0][1].' Tập '.$epid[0][1].', '.$arr[0][6].' Ep '.$epid[0][1].', '.$arr[0][7]);
			}
			if(!$arr) header('Location: '.SITE_URL);
			$other_meta = '<meta property="og:image" content="'.$arr[0][2].'">';
			$other_meta2 = '<link href="'.SITE_URL.$cururl.'" rel="canonical">';
			include View::TemplateView('film');
		}
		// Trang danh sách
		else if(in_array($mode,array('danh-sach','the-loai','quoc-gia','search','tag'))) {
			if($mode == 'the-loai') {
				$id = $geturl[2];
				$arr = MySql::dbselect('id,name','category',"name_seo = '$id'");
				$id = $arr[0][0];
				$catid = $id;
				$name = $arr[0][1];
				$url_page = Url::get(0,$name,'Thể loại');
				$site_title = head_site($name,'category_title');
				$site_description = head_site($name,'category_description');
				$site_keywords = head_site($name,'category_keywords');
				$sql = "tb_film.category like '%,$id,%' AND active=1";
			}else if($mode == 'quoc-gia') {
				$id = $geturl[2];
				$arr = MySql::dbselect('id,name','country',"name_seo = '$id'");
				$id = $arr[0][0];
				$couid = $id;
				$name = $arr[0][1];
				$url_page = Url::get(0,$name,'Quốc gia');
				$site_title = head_site($name,'country_title');
				$site_description = head_site($name,'country_description');
				$site_keywords = head_site($name,'country_keywords');
				$sql = "tb_film.country = '$id' AND active=1";
			}else if(in_array($mode,array('search','tag'))) {
				$id = str_replace('-',' ',urldecode($geturl[2]));
				$name = $id;
				$url_page = Url::get(0,$name,'Search');
				$site_title = head_site($name,'search_title');
				$site_description = head_site($name,'search_description');
				$site_keywords = head_site($name,'search_keywords');
				$sql = "(tb_film.title like '%$id%' OR tb_film.title_en like '%$id%' OR tb_film_other.searchs like '%$id%' OR tb_film_other.keywords like '%$id%' OR tb_film.actor like '%$id%' OR tb_film.director like '%$id%' OR tb_film.title_search like '%$id%' OR strcmp(soundex(title_search), soundex('$id')) = 0) AND active=1";
			}else if($mode == 'danh-sach') {
				$id = $geturl[2];
				if($id == 'phim-moi') {
					$name = 'Phim Mới';
					$url_page = Url::get(0,$name,'Danh sách');
					$sql = "id != '0' AND active=1";
					$byorder = 'id';
					$site_title = "Phim mới hay năm 2014, danh sách phim mới hay nhiều thể loại";
					$site_description = "Danh sách phim mới được cập nhập liên tục, xem thỏa thích và không giới hạn, phim mới hay 2014.";
					$site_keywords = "Phim mới 2014, phim mới hay, phim mới tuyển chọn";
				}
				else if($id == 'phim-chieu-rap') {
					$name = 'Phim Chiếu Rạp';
					$url_page = Url::get(0,$name,'Danh sách');
					$sql = "decu = '1' AND active=1";
					$site_title = "Phim hay được tuyển chọn với chất lượng cao, mới nhất 2014";
					$site_description = "Những bộ phim hay đề cử hot nhất năm 2014, được tuyển chọn và đánh giá chất lượng cao nhất.";
					$site_keywords = "phim hot, phim hay nhất, phim hay 2014";
				}
				else if($id == 'phim-thanh-vien') {
					$name = 'Phim Thành Viên';
					$url_page = Url::get(0,$name,'Danh sách');
					$sql = "active=2";
					$site_title = "Phim thành viên đóng góp";
					$site_description = "Những bộ phim hay đề cử hot nhất năm 2014, được tuyển chọn và đánh giá chất lượng cao nhất.";
					$site_keywords = "phim hot, phim hay nhất, phim hay 2014";
				}
				else if($id == 'phim-le') {
					$filmlb = $id;
					$name = 'Phim Lẻ';
					$url_page = Url::get(0,$name,'Danh sách');
					$sql = "filmlb = '0' AND active=1";
					$site_title = "Phim lẻ hay, thuyết minh, phụ đề tuyển chọn mới nhất 2014";
					$site_description = "Danh sách phim lẻ hay nhiều thể loại, cập nhập liên tục tuyển chọn phim lẻ mới và hấp dẫn nhất năm 2016.";
					$site_keywords = "Phim lẻ hay, phim lẻ tuyển chọn, phim lẻ 2014, phim lẻ mới";
				}
				else if($id == 'phim-xem-nhieu') {
					$filmlb = $id;
					$name = 'Phim Xem Nhiều';
					$url_page = Url::get(0,$name,'Danh sách');
					$sql = "viewed > 0 AND active=1";
					$byorder = 'viewed';
					$site_title = "Phim xem nhiều nhất, thuyết minh, phụ đề tuyển chọn mới nhất 2014";
					$site_description = "Danh sách phim xem nhiều nhất, hay nhiều thể loại, cập nhập liên tục tuyển chọn xem nhiều nhất và hấp dẫn nhất năm 2016.";
					$site_keywords = "Phim xem nhiều nhất hay, xem nhiều nhất tuyển chọn, xem nhiều nhất 2014, xem nhiều nhất mới";
				}
				else if($id == 'phim-bo') {
					$filmlb = $id;
					$name = 'Phim Bộ';
					$url_page = Url::get(0,$name,'Danh sách');
					$sql = "filmlb IN (1,2) AND active=1";
					$site_title = "Phim bộ hay chất lượng hd tuyển chọn, phim bộ mới năm 2014";
					$site_description = "Danh sách phim bộ hay, liên tục cập nhập và tuyển chọn phim bộ mới và hấp dẫn nhất năm 2014.";
					$site_keywords = "Phim bộ hay, phim bộ tuyển chọn, phim bộ mới, phim bộ 2014";
				}
				else if(preg_match("#phim-nam-([0-9]+)#", $id, $yearurl)) {
					$getyear = $yearurl[1];
					$name = 'Năm '.$getyear;
					$url_page = Url::get(0,'Phim '.$name,'Danh sách');
					$sql = "year = '$getyear' AND active=1";
					$site_title = "Phim $name mới nhất, Phim $name hay, Phim $name hot nhất";
					$site_description = "Danh sách phim $name mới nhất, phim $name hay chọn lọc, phim $name.";
					$site_keywords = "Phim $name, xem phim $name, phim hot $name, download phim $getyear";
				}
			}
			include View::TemplateView('list');
		}
		else if($mode == 'ajax') {
			$id = $geturl[2];
			$filmid = $geturl[3];
				if($id == 'movie_load_info') {				
				echo Film_Model::Tooltip($filmid);
				}
				else if($id == 'movie_rate_info') {
				echo Film_Model::LoadVotes($filmid);
				}
				else if($id == 'movie_update_view') {
					$filmid = $_POST['id'];
					MySql::dbupdate('film',"viewed = viewed+1, viewed_day = viewed_day+1, viewed_week = viewed_week+1, viewed_month = viewed_month+1","id = '$filmid'");
				}
				else if($id == 'user_rating') {
					$star = $_POST['mark'];
					$filmid = $_POST['movie_id'];
					echo Film_Model::Votes($filmid,$star);
				}
				else if($id == 'error') {
					$filmid = $_POST['filmid'];
					$epid = $_POST['epid'];
					echo Film_Model::Fav_Error($filmid,$epid);
				}
				else if($id == 'user_load_notify') {
					header("Content-type: application/json");
					$userid = $_SESSION["RK_Userid"];
					$arr = MySql::dbselect('nt_content,timeupdate','notice JOIN tb_user ON (tb_user.id = tb_notice.userid)',"userid='".$userid."' AND n_read=0 LIMIT 10");
					$total_mes = count($arr);
					if($total_mes){
						for($i=0;$i<count($arr);$i++) {
							$html .= '<li class="list"><a href="'.SITE_URL.'/user/notify" title="">'.$arr[$i][0].'</a></li>';
						}
					}else{
						$html .= '<li class="more"><a href="#" title="">Bạn không có thông báo nào.</a></li>';
					}
					$jsons = array('status'=>1,'message'=>'Success','notify_unread'=>$total_mes,'html'=>$html);
					echo json_encode($jsons);
				}
				else if($id == 'user_favorite') {
					header("Content-type: application/json");
					$filmid = $_POST['movie_id'];
					echo Film_Model::Fav_Feature($filmid);
				}
				else if($id == 'suggest_search') {
					header("Content-type: application/json");
					include View::TemplateView('functions');
					$id = $_POST['keyword'];					
					$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.title_en,tb_film.thumb,tb_film.category','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"(tb_film.title like '%$id%' OR tb_film.title_en like '%$id%' OR tb_film_other.searchs like '%$id%' OR tb_film_other.keywords like '%$id%' OR tb_film.actor like '%$id%' OR tb_film.director like '%$id%' OR tb_film.title_search like '%$id%' OR strcmp(soundex(title_search), soundex('$id')) = 0) AND active=1");
					$html .= '<ul style="margin-bottom: 0;">';
					for($i=0;$i<count($arr);$i++) {
						$id = $arr[$i][0];
						$name = $arr[$i][1];
						$name_en = $arr[$i][2];
						$thumb = $arr[$i][3];
						$cat = $arr[$i][4];
						
						$url = Url::get($arr[$i][0],$name,'Phim');
						$html .= '<li>
								<a style="background-image: url('.SITE_URL.'/timthumb.php?src='.$thumb.'&w=150)" class="thumb" href="'.$url.'"></a>

								<div class="ss-info">
									<a href="'.$url.'" class="ss-title">'.$name.'</a>

									<p>'.$name_en.'</p>

									'.category_search($cat).'            </div>
								<div class="clearfix"></div>
							</li>';
					}
					$html .= '</ul>';
					$jsons = array('status'=>1,'message'=>'Success','content'=>$html);
					echo json_encode($jsons);
				}
				else if($id == 'load_login_status') { 
				header("Content-type: application/json");
				if($_SESSION["RK_Userid"]!=""){
					echo '{"status":1,"message":"Success","content":"    <div class=\"top-user-content logged\">\n        <div class=\"logged-feed\">\n                        <a onclick=\"loadNotify()\" href=\"#\" class=\"btn btn-logged btn-feed\" data-toggle=\"dropdown\"\n               aria-haspopup=\"true\"\n               aria-expanded=\"false\"><i class=\"fa fa-bell-o\"><\/i><span\n                    class=\"feed-number\"><\/span><\/a>\n            <ul class=\"dropdown-menu\" id=\"list-notify\">\n                <li id=\"loading-notify\" class=\"more\">\n                    <a href=\"#\" title=\"\">\n                        <img src=\"http:\/\/123movies.to\/assets\/images\/ajax-loading.gif\"\/>\n                    <\/a>\n                <\/li>\n            <\/ul>\n        <\/div>\n        <div class=\"logged-user\">\n            <a href=\"#\" class=\"avatar user-menu\" data-toggle=\"dropdown\" aria-haspopup=\"true\"\n               aria-expanded=\"false\">\n                                    <img src=\"http:\/\/123movies.to\/assets\/images\/default_avatar.jpg\">\n                                <i class=\"fa fa-chevron-down\"><\/i><\/a>\n            <ul class=\"dropdown-menu\">\n                <li>\n                    <a href=\"http:\/\/hayphim.tv\/user\/profile\"><i class=\"fa fa-user mr5\"><\/i> Profile<\/a>\n                <\/li>\n                <li><a href=\"http:\/\//hayphim.tv\/user\/movies\/favorite\"><i class=\"fa fa-heart mr5\"><\/i> My\n                        movies<\/a><\/li>\n                <li>\n                    <a href=\"http:\/\//hayphim.tv\/site\/donate\"><i class=\"fa fa-gift mr5\"><\/i> Donate<\/a>\n                <\/li>\n                <li>\n                    <a href=\"http:\/\//hayphim.tv\/user\/update\"><i class=\"fa fa-pencil mr5\"><\/i> Update\n                        profile<\/a>\n                <\/li>\n                <li><a href=\"http:\/\/hayphim.tv\/logout\"><i class=\"fa fa-power-off mr5\"><\/i>\n                        Logout<\/a><\/li>\n            <\/ul>\n        <\/div>\n    <\/div>\n","is_login":1}';
				}else{
					echo '{"status":1,"message":"Success","content":"    <div class=\"top-user-content guest\">\n        <a href=\"#\" class=\"btn btn-success btn-login\" title=\"Login\" data-target=\"#pop-login\"\n           data-toggle=\"modal\">LOGIN<\/a>\n    <\/div>\n","is_login":0}';
				}
				}
				else if($id == 'user_login') {
				header("Content-type: application/json");
				echo LoginAuth::loginUser($_POST['username'],$_POST['password']);
				}
				else if($id == 'user_register') {
				header("Content-type: application/json");
				echo LoginAuth::addUser($_POST['username'],$_POST['password'],$_POST['confirm_password'],$_POST['email']);
				}
				elseif($id == 'get_content_box'){
					header("Content-type: application/json");
					$action = $geturl[3];
					if($action == 'topview-today'){
						$sql = 'viewed_day!=0';
						$order = 'ORDER BY viewed_day DESC';
					}elseif($action == 'topview'){
						$sql = 'viewed!=0';
						$order = 'ORDER BY viewed DESC';
					}elseif($action == 'topview-week'){
						$sql = 'viewed_week!=0';
						$order = 'ORDER BY viewed_week DESC';
					}elseif($action == 'topview-month'){
						$sql = 'viewed_month!=0';
						$order = 'ORDER BY viewed_month DESC';
					}elseif($action == 'hanh-dong'){
						$sql = "tb_film.category like '%,1,%' AND tb_film.filmlb=0";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'kinh-di'){
						$sql = "tb_film.category like '%,21,%' AND tb_film.filmlb=0";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'tv-show'){
						$sql = "tb_film.category like '%,40,%'";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'viet-naml'){
						$sql = "tb_film.country = '1' AND filmlb=0";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'han-quoc'){
						$sql = "tb_film.country = '3' AND filmlb!=0";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'phim-my'){
						$sql = "tb_film.country = '5' AND filmlb!=0";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'viet-nam'){
						$sql = "tb_film.country = '6' AND filmlb!=0";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'trung-quoc'){
						$sql = "tb_film.country = '2' AND filmlb!=0";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'gs-han-quoc'){
						$sql = "tb_film.category like '%,31,%' AND tb_film.country = '3'";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'gs-trung-quoc'){
						$sql = "tb_film.category like '%,31,%' AND tb_film.country = '2'";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'gs-viet-nam'){
						$sql = "tb_film.category like '%,31,%' AND tb_film.country = '1'";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'gs-au-my'){
						$sql = "tb_film.category like '%,31,%' AND tb_film.country = '5'";
						$order = 'ORDER BY timeupdate DESC';
					}
					$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.duration,tb_film.quality,tb_film.thuyetminh,tb_film.filmlb,tb_film.category,tb_film.trailer','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql AND active=1 $order LIMIT 16");
						for($i=0;$i<count($arr);$i++) {
							$id = $arr[$i][0];
							$name = $arr[$i][1];
							$name_en = $arr[$i][6];
							$name_en_cut = CutName($arr[$i][6],20);
							$name_cut = CutName($name,30);
							$url = Url::get($arr[$i][0],$name,'Phim');
							$thumb = $arr[$i][2];
							$thumb_big = $arr[$i][4];
							$duration = $arr[$i][7];
							$quality = $arr[$i][8];
							$thuyetminh = $arr[$i][9];
							$filmlb = $arr[$i][10];
							$year = $arr[$i][3];
							$cat = $arr[$i][11];
							$content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),250);
							if($filmlb!=0){
								$types = 'phimbo';
							}
							if($quality) $quality = "$quality";
							$episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
							$epname = $episode[0][1];
							if($thuyetminh == 1){
								$phude = 'TM';
							}else{
								$phude = 'Vi';
							}
							//if($epname && $type == 'phimbo') $epnames = " Tập $epname";
							if(empty($duration) || empty($name_en)){
								$duration = "cập nhật";
								$name_en = "cập nhật";
							}else{


							}
							if($epname && $arr[$i][10] != '0') { $epnames[$i] = "<span class=\"mli-eps\">$phude<i>".substr(abs((int) filter_var($epname, FILTER_SANITIZE_NUMBER_INT)),0,3)."</i> </span>";
							}	
							$html .= '<div class="ml-item">
								<a href="'.$url.'"
								   data-url="'.SITE_URL.'/ajax/movie_load_info/'.$id.'"
								   class="ml-mask jt"
								   title="'.$name.'">
									 '.$epnames[$i].'    
									<img data-original="http://hayphim.tv/timthumb.php?src='.$thumb.'&w=150" class="lazy thumb mli-thumb"
										 alt="'.$name.'">
									<span class="mli-info"><h2>'.$name.'</h2></span>
								</a>
							</div>
							';
						}
						$html .= "<script type=\"text/javascript\">
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
    $(\"img.lazy\").lazyload({
        effect: \"fadeIn\"
    });
</script>";
						$json = array('status'=>1,'message'=>'Success','content'=>$html,'type'=>$action);
						echo json_encode($json);					
				}
				elseif($id == 'get_filter_box'){
					
					if($_REQUEST['cat']!=""){
						$cat = $_REQUEST['cat'];
						$sql .= "AND tb_film.category LIKE '%,$cat,%'";						
					}
					if($_REQUEST['country']!=""){
						$country = $_REQUEST['country'];
						$sql .= "AND tb_film.country = '$country'";						
					}
					if($_REQUEST['year']!=""){
						$year = $_REQUEST['year'];
						$sql .= "AND tb_film.year = '$year'";						
					}
					if($_REQUEST['filmlb']=="0"){						
						$sql .= "AND filmlb=0";						
					}
					if($_REQUEST['filmlb']=="1"){
						$sql .= "AND filmlb!=0";						
					}
					if($_REQUEST['filmlb']=="phim-le"){
						$sql .= "AND filmlb=0";	
						$limit = 40;
					}
					if($_REQUEST['filmlb']=="phim-bo"){
						$sql .= "AND filmlb IN (1,2)";	
						$limit = 40;
					}
					if(!$limit) $limit = 16;
					$order = 'ORDER BY timeupdate DESC';
					$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.duration,tb_film.quality,tb_film.thuyetminh,tb_film.filmlb,tb_film.category,tb_film.trailer','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"1>0 $sql AND active=1 $order LIMIT $limit");
						for($i=0;$i<count($arr);$i++) {
							$id = $arr[$i][0];
							$name = $arr[$i][1];
							$name_en = $arr[$i][6];
							$name_en_cut = CutName($arr[$i][6],20);
							$name_cut = CutName($name,30);
							$url = Url::get($arr[$i][0],$name,'Phim');
							$thumb = $arr[$i][2];
							$thumb_big = $arr[$i][4];
							$duration = $arr[$i][7];
							$quality = $arr[$i][8];
							$thuyetminh = $arr[$i][9];
							$filmlb = $arr[$i][10];
							$year = $arr[$i][3];
							$cat = $arr[$i][11];
							$content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),250);
							if($filmlb!=0){
										$types = 'phimbo';
									}
							if($quality) $quality = "$quality";
							$episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
							$epname = $episode[0][1];
							if($thuyetminh == 1){
								$phude = 'TM';
							}else{
								$phude = 'Vi';
							}
							//if($epname && $type == 'phimbo') $epnames = " Tập $epname";
							if(empty($duration) || empty($name_en)){
								$duration = "cập nhật";
								$name_en = "cập nhật";
							}else{


							}
							if($epname && $types == 'phimbo') { $epnames = "<span class=\"mli-eps\">$phude<i>".abs((int) filter_var($epname, FILTER_SANITIZE_NUMBER_INT))."</i> </span>";
							}	
							$html .= '<div class="ml-item">
								<a href="'.$url.'"
								   data-url="'.SITE_URL.'/ajax/movie_load_info/'.$id.'"
								   class="ml-mask jt"
								   title="'.$name.'">
									 '.$epnames.'    
									<img data-original="http://hayphim.tv/timthumb.php?src='.$thumb.'&w=150" class="lazy thumb mli-thumb"
										 alt="'.$name.'">
									<span class="mli-info"><h2>'.$name.'</h2></span>
								</a>
							</div>
							';
						}
						$html .= "<script type=\"text/javascript\">
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
    $(\"img.lazy\").lazyload({
        effect: \"fadeIn\"
    });
</script>";
					echo $html;					
				}
		}
		// Trang thành viên
		else if($mode == 'user') {
			$userid = $geturl[2];
			$userid = explode('-',$userid);
			$userid = intval($userid[0]);
			if($geturl[2] == 'profile') {
				$site_title = 'Thông tin thành Viên';
			} else if($geturl[2] == 'update') {
				$site_title = 'Cập nhật thông tin';
				if($_SERVER['REQUEST_METHOD']=='POST'){		
					header("Content-type: application/json");
					echo LoginAuth::Edituser($_POST['fullname'],$_POST['facebook'],$_POST['old_password'],$_POST['new_password']);
					exit;
				}
			} else if($geturl[2] == 'billing') {
				$site_title = 'Cập nhật thông tin thanh toán';
				if($_SERVER['REQUEST_METHOD']=='POST'){		
					header("Content-type: application/json");
					echo LoginAuth::UpdateBilling($_POST['bank'],$_POST['fullname'],$_POST['bankid'],$_POST['diachi'],$_POST['phone'],$_POST['bank_brand']);
					exit;
				}
			} else if($geturl[2] == 'payment') {
				$site_title = 'Yêu cầu thanh toán';
				if($_SERVER['REQUEST_METHOD']=='POST'){		
					header("Content-type: application/json");
					echo LoginAuth::Payment($_POST['amount'],$_POST['payment']);
					exit;
				}
			} else if($geturl[2] == 'quen-mat-khau') {
				$site_title = 'Quên mật khẩu';
			} else {
				$site_title = 'Thông tin thành Viên';
			}
			$site_description = Config_Model::ConfigName('site_description');
			$site_keywords = Config_Model::ConfigName('site_keywords');
			//if(IS_LOGIN && !$userid) header('Location: '.SITE_URL);
			include View::TemplateView('member');
		}
		else if($mode == 'logout') {
			echo LoginAuth::logoutUser();
		}
		// Bảng xếp hạng
		else if($mode == 'bang-xep-hang') {
			$site_title = 'Top phim hay chất lượng HD xem miễn phí và nhanh nhất';
			$site_description = "Phim hay tuyển chọn chất lượng cao, xem miễn phi không giới hạn, phim mới năm 2014";
			$site_keywords = Config_Model::ConfigName('site_keywords');
			include View::TemplateView('rank');
		}
		// Video và xem video
		else if($mode == 'video' || $mode == 'xem-video') {
			$id = $geturl[2];
			$id = explode('-',$id);
			$id = intval($id[0]);
			if(!$id) {
				$site_title = 'Tổng hợp clip vui cười, video hài hước nhất năm 2014';
				$site_description = "Tuyển chọn mới nhất Video vui cười, Clip hài hay nhất, xem Video hài cười, Clip vui độc quyền HOT 2013";
				$site_keywords = "video vui, clip cười, video hài hước, video vui cười";
				include View::TemplateView('listvideo');
			}else {
				$arr = MySql::dbselect('name,url,duration,thumb','media',"id = '$id'");
				if($arr) MySql::dbupdate('media',"viewed = viewed+1","id = '$id'");
				$name = $arr[0][0];
				$url = $arr[0][1];
				$duration = $arr[0][2];
				$thumb = $arr[0][3];
				$site_title = "$name";
				$site_description = Config_Model::ConfigName('site_description');
				$site_keywords = Config_Model::ConfigName('site_keywords');
				$urlvideo = SITE_URL.$cururl;
				$other_meta = '<meta property="og:image" content="'.$thumb.'">';
				$other_meta2 = '<link href="'.$urlvideo.'" rel="canonical">';
				include View::TemplateView('video');
			}
		}
		// Bài viết
		else if($mode == 'post') {
			$seotitle = $geturl[2];
			$arr = MySql::dbselect('id,title,content','news',"seotitle = '$seotitle'");
			$id = $arr[0][0];
			$title = $arr[0][1];
			$content = $arr[0][2];
			$site_title = "$title";
			$site_description = Config_Model::ConfigName('site_description');
			$site_keywords = Config_Model::ConfigName('site_keywords');
			include View::TemplateView('post');
		}
		else if($mode == 'live-tv') {
			parse_str(parse_url(Url::curRequestURL(),PHP_URL_QUERY), $data);
			$key = $data['k'];
			$id = $geturl[2];
			$id = explode('-',$id);
			$id = $id[0];
			if($key) {
				$site_title = 'Tìm kiếm kênh: '.$key;
				$sql = "symbol like '%$key%' OR name like '%$key%'";
			}else if($id) {
				$livetv = MySql::dbselect('id,symbol,name,quality,speed,viewed,content,linktv,thumb,lang','tv',"id = '$id'");
				if($livetv) MySql::dbupdate('tv',"viewed = viewed+1","id = '$id'");
				$symbol = $livetv[0][1];
				$site_title = "$symbol - Xem tivi online, kênh truyền hình trực tuyến";
				$type = '1';
				$other_meta = '<meta property="og:image" content="'.$livetv[0][8].'">';
				$other_meta2 = '<link href="'.SITE_URL.$cururl.'" rel="canonical">';
			}else {
				$site_title = 'Danh sách kênh tivi';
				$sql = 'id != 0';
			}
			$site_description = Config_Model::ConfigName('site_description');
			$site_keywords = Config_Model::ConfigName('site_keywords');
			include View::TemplateView('tv');
		}
		// Admincp
		else if($mode == ADMINCP_NAME) {
			include View::AdminView('admin');
		}
		else if($mode == MEMBER_UPLOAD) {
			include View::UploadView('uploads');
		}
		// Phần còn lại
		else if(!$mode) {
			$site_title = Config_Model::ConfigName('site_name');
			$site_description = Config_Model::ConfigName('site_description');
			$site_keywords = Config_Model::ConfigName('site_keywords');
			include View::TemplateView('home');
		}
		// Trang lỗi 404
		else {
			$site_title = 'Thông báo';
			$site_description = Config_Model::ConfigName('site_description');
			$site_keywords = Config_Model::ConfigName('site_keywords');
			include View::TemplateView('404');
		}
	}
}

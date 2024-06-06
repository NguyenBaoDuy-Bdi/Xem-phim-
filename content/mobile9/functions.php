<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
function config_site($config_name) {
	$html = get_jsonconfig($config_name,'siteconfig');
	return $html;
}
function one_data($item,$table,$con) {
	$arr = MySql::dbselect("$item","$table","$con");
	$data = $arr[0][0];
	return $data;
}
function filmdata($id,$item) {
	$arr = Film_Model::get("$id","$item");
	return $arr;
}
function get_url($id,$name,$type) {
	$url = Url::get($id,$name,$type);
	return $url;
}
function get_allpage($ttrow, $limit, $page, $url, $type = '') {
    $total = ceil($ttrow / $limit);
    if ($total <= 1)
        return '';
	$main .= '<div class="pagination_list"><p>';
    if ($page <> 1) {
        $main .= "<a title='Sau' class=\"_mme _mrf\" href='" . $url . ($page - 1) . "'>←</a>";
    }
    for ($num = 1; $num <= $total; $num++) {
        if ($num < $page - 1 || $num > $page + 3)
            continue;
        if ($num == $page)
            $main .= "<a href='$url$num' class=\"btn btn-alt waves-button waves-effect\">$num</a></span>";
        else {
            $main .= "<a href=\"$url$num\" class=\"btn btn-flat btn-alt waves-button waves-effect\">$num</a>";
        }
    }
    if ($page <> $total) {
        $main .= "<a title='Tiếp' class=\"btn btn-flat btn-alt waves-button waves-effect\" href='" . $url . ($page + 1) . "'>→</a>";
    }
	$main .= '</p></div>';
    return $main;
}
function iframe_category($list, $num = 0) {
	$list = substr($list, 1);
    $list = substr($list, 0, -1);
    $category  = MySql::dbselect("name", "category", "id IN (" . $list . ")");
    for($i=0;$i<count($category);$i++) {
        $name = $category[$i][0];
		$url = get_url(0,$name,'Thể Loại');
        $html .= "<a style=\"color:#808080\" href=\"$url\" title=\"Phim $name\">$name</a>, ";
    }
    return $html;
}
function GetTag($data,$type='tag') {
	$data = explode(',',$data);
	for($i=0;$i<count($data);$i++) {
		$name = trim($data[$i]);
		$url = Url::get(0,$name,'tag');
		$output .= "<h3><a href=\"$url\" title=\"".$name."‏\" rel=\"$type\">".$name."‏</a></h3>";
	}
	return $output;
}
function GetTag_a($data,$limit) {
	$data = explode(',',$data);
	for($i=0;$i<$limit;$i++) {
		$name = trim($data[$i]);
		$url = Url::get(0,$name,'tag');
		$output .= "<a href=\"$url\" title=\"".$name."‏\" rel=\"$type\">".$name."‏</a>";
	}
	return $output;
}
function Get_List_director($list) {
	$data = explode(',',$list);
	for($i=0;$i<count($data);$i++) {
		$name = RemoveHack($data[$i]);
		if($name) {
			$arr = MySql::dbselect("info,urlmore,thumb","actor","name = '$name'");
			$image = $arr[0][2];
			$info  = $arr[0][0];
			if(!$arr) {
				/*$wiki = cURL::getWiki(trim($data[$i]));
				$image = $wiki[3];
				$urlmore = $wiki[2];
				$info = CutName($wiki[1],200);
				MySql::dbinsert('actor','name,info,urlmore,thumb',"'$name','$info','$urlmore','$image'");*/
				MySql::dbinsert('actor','name',"'$name'");
			}
			if(!$info) $info = "Chưa có thông tin về $name";
			if($image) $infodiv[$i] = "
				<div class=\"actor-info-single\">
					<div class=\"actor-single-picture\">
						<img src=\"$image\">
					</div>
					<div class=\"single-info\">
						<div class=\"name-of-actor\">
							$name
						</div>
						<div class=\"des-actor-single\">
							<span class=\"read-more-actor\">
								$info <br /><a href=\"$url\" class=\"more-actor\"> Xem thêm »</a>
							</span>
						</div>
					</div>
				</div>
			";
			if(!$image) $image = TEMPLATE_URL.'images/noactoravatar.gif';
			$url = Url::get(0,$name,'search');
			$html .= "
			<li>
				<img src=\"$image\" alt=\"$name\" width=\"45px\" height=\"58px\"/>
				<div class=\"act-info\">
					<p class=\"name\">
						<a href=\"$url\" class=\"data-actor\" title=\"Tìm phim của $name\">$name</a>
					</p>
					<span></span>
				</div>
				".$infodiv[$i]."
			</li>
			";
		}
	}
	return $html;
}
function Get_List_actor($list) {
	$data = explode(',',$list);
	for($i=0;$i<count($data);$i++) {
		$name = RemoveHack($data[$i]);
		if($name) {
			$arr = MySql::dbselect("info,urlmore,thumb","actor","name = '$name'");
			$image = $arr[0][2];
			$info  = $arr[0][0];
			if(!$arr) {
				/*$wiki = cURL::getWiki(trim($data[$i]));
				$image = $wiki[3];
				$urlmore = $wiki[2];
				$info = CutName($wiki[1],200);
				MySql::dbinsert('actor','name,info,urlmore,thumb',"'$name','$info','$urlmore','$image'");*/
				MySql::dbinsert('actor','name',"'$name'");
			}
			if(!$info) $info = "Chưa có thông tin về $name";
			if($image) $infodiv[$i] = "
				<div class=\"actor-info-single\">
					<div class=\"actor-single-picture\">
						<img src=\"$image\">
					</div>
					<div class=\"single-info\">
						<div class=\"name-of-actor\">
							$name
						</div>
						<div class=\"des-actor-single\">
							<span class=\"read-more-actor\">
								$info <br /><a href=\"$url\" class=\"more-actor\"> Xem thêm »</a>
							</span>
						</div>
					</div>
				</div>
			";
			if(!$image) $image = TEMPLATE_URL.'images/noactoravatar.gif';
			$url = Url::get(0,$name,'search');
			$html .= '<li>
				<a href="'.$url.'">
				<span class="img-215">
				<img src="'.$image.'" alt="'.$name.'" title="'.$name.'" style="max-width:100%">
				</span>
				<span class="cast-name">'.$name.'</span>
				</a>
				</li>';
			
		}
	}
	return $html;
}
function li_category() {
	$arr = MySql::dbselect('id,name','category','id != 0');
	for($i=0;$i<count($arr);$i++) {
		$name = $arr[$i][1];
		$id = $arr[$i][0];
		$url = get_url(0,$name,'Thể loại');
		$film = count(MySql::dbselect('id','film',"category like '%,$id,%'"));
		$html .= '<li><a href="'.$url.'" title="'.$name.'"><i class="icon fade">theaters</i>'.$name.'</a></li>';
		
	}
	return $html;
}
function li_country() {
	$arr = MySql::dbselect('id,name','country','id != 0');
	for($i=0;$i<count($arr);$i++) {
		$name = $arr[$i][1];
		$id = $arr[$i][0];
		$url = get_url(0,$name,'Quốc gia');
		$film = count(MySql::dbselect('id','film',"country = '$id'"));
		$html .= '<li><a href="'.$url.'" title="'.$name.'"><i class="icon fade">theaters</i>'.$name.'</a></li>';
		
	}
	return $html;
}
function li_year($type) {
	for($i=0;$i<14;$i++) {
		$name = 'Năm '.(2014-$i);
		$url = get_url(0,'Phim năm-'.(2014-$i),'Danh sách');
		$html .= "<li><a href=\"$url\" title=\"Xem Phim $name\">$name</a></li>";
	}
	return $html;
}
function breadcrumb_menu($list, $num = 0) {
    $list = substr($list, 1);
    $list = substr($list, 0, -1);
    $category  = MySql::dbselect("name", "category", "id IN (" . $list . ")");
    for($i=0;$i<count($category);$i++) {
        $name = $category[$i][0];
		$url = get_url(0,$name,'Thể Loại');
        $html .= "<span typeof=\"v:Breadcrumb\"><a href=\"$url\" rel=\"v:url\" property=\"v:title\">$name</a></span>";
    }
    return $html;
}
function category_Watch($list, $num = 0) {
    $list = substr($list, 1);
    $list = substr($list, 0, -1);
    $category  = MySql::dbselect("name", "category", "id IN (" . $list . ")");
    for($i=0;$i<count($category);$i++) {
        $name = $category[$i][0];
        $html .= "$name, ";
    }
	$html = substr($html,0,-2);
    return $html;
}
function category_a($list, $num = 0) {
    $list = substr($list, 1);
    $list = substr($list, 0, -1);
    $category  = MySql::dbselect("name", "category", "id IN (" . $list . ")");
    for($i=0;$i<count($category);$i++) {
        $name = $category[$i][0];
		$url = get_url(0,$name,'Thể Loại');
        $html .= "<a class=\"_mry\" href=\"$url\" title=\"$name\">$name</a>, ";
    }
	$html = substr($html,0,-2);
    return $html;
}
function category_a_f($ido) {
    $category  = MySql::dbselect("name,id", "category", "id != '0'");
	if(!$ido) $classo = 'active';
	$html .= "<a href=\"javascript:void(0)\" class=\"$classo\" data-value=\"\" name=\"byquality\"> Tất cả</a>";
    for($i=0;$i<count($category);$i++) {
		$id = $category[$i][1];
        $name = $category[$i][0];
		if($id == $ido) $class[$i] = ' class="active"';
        $html .= "<a href=\"javascript:void(0)\"".$class[$i]." data-value=\"$id\" name=\"byquality\"> $name</a>";
    }
    return $html;
}
function get_byorder($type) {
	$date = '<a href="javascript:void(0)" data-value="timeupdate" name="bysort"> Ngày cập nhật</a>';
	$year = '<a href="javascript:void(0)" data-value="year" name="bysort"> Năm sản xuất</a>';
	$title = '<a href="javascript:void(0)" data-value="title" name="bysort"> Tên phim</a>';
	$viewed = '<a href="javascript:void(0)" data-value="viewed" name="bysort"> Lượt xem</a>';
	if($type == 'timeupdate' || !$type) $date = '<span class="active" data-value="timeupdate">Ngày cập nhật</span>';
	if($type == 'year') $year = '<span class="active" data-value="year">Năm sản xuất</span>';
	if($type == 'title') $title = '<span class="active" data-value="title">Tên phim</span>';
	if($type == 'viewed') $viewed = '<span class="active" data-value="viewed">Lượt xem</span>';
	$html = $date.$year.$title.$viewed;
	return $html;
}
function country_a_f($ido) {
    global $db;
    $country  = MySql::dbselect("name,id", "country", "id != '0'");
	if(!$ido) $classo = 'active';
	$html .= "<a href=\"javascript:void(0)\" class=\"$classo\" data-value=\"\" name=\"byquality\"> Tất cả</a>";
    for($i=0;$i<count($country);$i++) {
		$id = $country[$i][1];
        $name = $country[$i][0];
		if($id == $ido) $class[$i] = ' class="active"';
        $html .= "<a href=\"javascript:void(0)\"".$class[$i]." data-value=\"$id\" name=\"byquality\"> $name</a>";
    }
    return $html;
}
function quality_a_f($qualityid) {
	if($qualityid == 'HD') $hd = 'active';
	else if($qualityid == 'SD') $sd = 'active';
	else if($qualityid == 'CAM') $cam = 'active';
	else $tatca = 'active';
    $html = "<a href=\"javascript:void(0)\" class=\"$tatca\" data-value=\"\" name=\"byquality\"> Tất cả</a>
	<a href=\"javascript:void(0)\" class=\"$hd\" data-value=\"HD\" name=\"byquality\"> HD</a>
	<a href=\"javascript:void(0)\" class=\"$sd\" data-value=\"SD\" name=\"byquality\"> SD</a>
	<a href=\"javascript:void(0)\" class=\"$cam\" data-value=\CAM\" name=\"byquality\"> CAM</a>";
    return $html;
}
function filmyear_a_f($year) {
	if(!$year) $tatca = 'active';
	$html .= "<a href=\"javascript:void(0)\" class=\"$tatca\" data-value=\"\" name=\"byyear\"> Tất cả</a>";
	for($i=0;$i<6;$i++) {
		$name = 'Năm '.(2014-$i);
		$yearid = (2014-$i);
		if((2014-$i) == $year) $class[$i] = 'active';
		$html .= "<a href=\"javascript:void(0)\" class=\"".$class[$i]."\" data-value=\"$yearid\" name=\"byyear\"> $name</a>";
	}
    return $html;
}
function country_a($id) {
    $country = MySql::dbselect("name", "country", "id = '$id'");
    $name = $country[0][0];
	$url = get_url(0,$name,'Quốc Gia');
    $html = "<a class=\"_mry\" href=\"$url\" title=\"$name\">$name</a>";
    return $html;
}
function cat_hotlist() {
	$arr = MySql::dbselect('id,title,thumb,tourl','hotmenu',"id != 0 order by id asc");
	for($i=0;$i<count($arr);$i++) {
		$name = $arr[$i][1];
		$url = $arr[$i][3];
		$thumb = $arr[$i][2];
		if($thumb !== '') $thumb = " style=\"background: url($thumb) no-repeat;\"";
		if(!$url) $url = "index.html";
		$html .= "<li><span class=\"back bxh\"$thumb></span><span class=\"cover\"></span><a href=\"$url\">$name</a></li>";
	}
	return $html;
}
function li_film($sql,$limit) {
	$arr = MySql::dbselect('id,title,thumb,year','film',"$sql ORDER BY id DESC LIMIT $limit");
	for($i=0;$i<count($arr);$i++) {
		$name = $arr[$i][1];
		$url = get_url($arr[$i][0],$name,'Phim');
		$thumb = $arr[$i][2];
		$year = $arr[$i][3];
		$html .= "<li><a href=\"$url\" title=\"$name\"><img src=\"$thumb\" class=\"headthumbimg\" alt=\"$name\"/><span>$name<br/>($year)</span></a></li>";
	}
	return $html;
}
function li_film_h3($sql,$limit) {
	$arr = MySql::dbselect('id,title,thumb,year,duration','film',"$sql ORDER BY id DESC LIMIT $limit");
	for($i=0;$i<count($arr);$i++) {
		$name = $arr[$i][1];
		$url = get_url($arr[$i][0],$name,'Phim');
		$thumb = $arr[$i][2];
		$year = $arr[$i][3];
		$duration = $arr[$i][4];
		$html .= "<h3><a href=\"$url\" title=\"$name\">$name</a></h3> ";
	}
	return $html;
}
function li_film_h3_2($sql,$limit) {
	$arr = MySql::dbselect('id,title,thumb,year,duration','film',"$sql AND duration != '' ORDER BY id DESC LIMIT $limit");
	for($i=0;$i<count($arr);$i++) {
		$name = $arr[$i][1];
		$url = get_url($arr[$i][0],$name,'Phim');
		$thumb = $arr[$i][2];
		$year = $arr[$i][3];
		$duration = $arr[$i][4];
		$html .= "<li><h3><a href=\"$url\" title=\"$name\">".CutName($name,20)."</a></h3><span>$duration</span></li>";
	}
	return $html;
}
function slider_film($sql,$limit) {
	$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql ORDER BY id DESC LIMIT $limit");
	for($i=0;$i<count($arr);$i++) {
		$id = $arr[$i][0];
		$name = $arr[$i][1];
		$url = get_url($arr[$i][0],$name,'Phim');
		$thumb = $arr[$i][2];
		$thumb_big = $arr[$i][4];
		$year = $arr[$i][3];
		$content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),200);
		$html .= "
		<li>
			<a href=\"$url\" class=\"btn_hide\">Play</a>
			<img class=\"full_poster\" src=\"$thumb_big\" alt=\"$name\"/>
			<div class=\"gradient_overlay\">
				<a href=\"$url\" class=\"play_btn_big\" title=\"$name\">Play</a>
				<div class=\"meta_feature\">
					<p class=\"title\">
						<a href=\"$url\" title=\"$name\">$name ($year)</a>
					</p>
					<p>
						 $content
					</p>
					<a href=\"#\" data-id=\"$id\" title=\"Nhấp vào đây để lưu vào xem sau\" class=\"add_fav_feature\">Xem sau</a>
				</div>
			</div>
			<div style=\"clear:both\"></div>
		</li>
		";
	}
	return $html;
}
function li_filmALL($type,$limit,$list='') {
	if($type == 'decu') $sql = "decu = '1'"; 
	else if($type == 'xemnhieu') {$sql = "viewed>0"; $orderby = "ORDER BY viewed DESC";}
	else if($type == 'phimbo') $sql = "filmlb IN (1,2)";
	else if($type == 'phimle') $sql = "filmlb = '0'";
	else if($type == 'rand') {
		$sql = "filmlb = '0'";
		$orderby = "ORDER BY RAND()";
	}
	else if($type == 'category') {
		$list = substr($list,1);
		$list = substr($list,0,-1);
		$ex = explode(",",$list);
		$count = count($ex);
		if($count == 1) $sql = "(category LIKE '%,$list,%' ) OR ";
		else {
			for($x=0;$x<$count;$x++) {
				$sql .= "(category LIKE '%,".$ex[$x].",%' ) OR ";
			}
		}
		$sql = substr($sql,0,-4);
		$orderby = "ORDER BY RAND()";
	}
	if(!$orderby) $orderby = 'ORDER BY timeupdate DESC';
	$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.duration,tb_film.quality,tb_film.viewed,tb_film.category','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql AND active=1 $orderby LIMIT $limit");
	for($i=0;$i<count($arr);$i++) {
		$id = $arr[$i][0];
		$name = $arr[$i][1];
		$name_en = CutName($arr[$i][6],20);
		$url = get_url($arr[$i][0],$name,'Phim');
		$thumb = $arr[$i][2];
		$bg_thumb = TEMPLATE_URL.'images/grey.jpg';
		$thumb_big = $arr[$i][4];
		$duration = $arr[$i][7];
		$quality = $arr[$i][8];
		$viewed = $arr[$i][9];
		$year = $arr[$i][3];
		$content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),150);
		if($type=='category'){
		$html .= '<li>
				<a href="'.$url.'">
				<span class="img-215">
				<img src="'.$thumb.'" alt="'.$name.'" title="'.$name.'" style="height:145px;max-width:100%">
				</span>
				<span class="cast-name">'.$name.'</span>
				</a>
				</li>';	
		}else{
		$html .= '<div class="col-lg-6 col-sm-12">
				<div class="card">
				<aside class="card-side card-side-img">
				<a href="'.$url.'" title="Xem phim '.$name.' - '.$name_en.'">
				<img alt="'.$name.'" src="'.$thumb.'" style="width:215px;max-width:100%;">
				</a>
				</aside>
				<div class="card-main">
				<div class="card-inner">
				<p class="card-heading">
				<a href="'.$url.'" title="Xem phim">'.$name.'</a>
				<em class="subtitle">'.$name_en.'</em>
				</p>
				<p class="card-view">
				<i class="fa fa-eye"></i> '.number_format($viewed).'
				</p>
				<p class="card-category">
				<i class="fa fa-bolt"></i> '.category_Watch($arr[$i][10]).' </p>
				<p class="card-info"></p>
				</div>
				</div>
				</div>
				</div>';
			if($i==4){
			$html .= '';
		}
		if($i==8){
			$html .= '<div style="padding:10px;"><script async defer src="//cdn.adpoints.media/production/ads/1094.js"></script></div>';
		}
			}
		
		}
	return $html;
}
function li_filmMEM($limit,$list='',$type) {
	$list = substr($list,1);
	$list = substr($list,0,-1);
	$list = str_replace('||',',',$list);
	$sql = "id IN ($list)";
	$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.duration,tb_film.quality','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql LIMIT $limit");
	for($i=0;$i<count($arr);$i++) {
		$id = $arr[$i][0];
		$name = $arr[$i][1];
		$name_en = CutName($arr[$i][6],20);
		$url = get_url($arr[$i][0],$name,'Phim');
		$thumb = $arr[$i][2];
		$bg_thumb = TEMPLATE_URL.'images/grey.jpg';
		$thumb_big = $arr[$i][4];
		$duration = $arr[$i][7];
		$quality = $arr[$i][8];
		$year = $arr[$i][3];
		$content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),200);
		$html .= "
		<li class=\"film_$id-$type\">
			<div class=\"item\">
				<a href=\"$url\" title=\"$name\" rel=\"nofollow\"><span class=\"over_play\"></span></a>
				<img class=\"thumbimg lazy\" data-original=\"$thumb\" src=\"$bg_thumb\" alt=\"$name\"/>
				<div class=\"meta_block_spec\" style=\"bottom:10px\">
					<p class=\"title\"><a href=\"$url\" title=\"$name\">$name</a> $year ($quality)</p>
					<p>$name_en</p>
				</div>
			</div>
			<span class=\"gradient_thumb\"></span>
			<div class=\"delete_over\"> 
				<a href=\"#\" class=\"remove\" data-id=\"$id\" data-type=\"$type\" title=\"Xóa phim khỏi danh sách\">Xóa</a> 
				<a href=\"$url\" title=\"$name\" rel=\"nofollow\" title=\"Xem phim này\">Xem</a> 
			</div>
		</li>
		";
	}
	return $html;
}
function li_episode($sql,$limit) {
	$arr = MySql::dbselect('tb_episode.id,tb_episode.name,tb_episode.filmid,tb_film.title,tb_episode.thumb','episode JOIN tb_film ON (tb_film.id = tb_episode.filmid)',"$sql ORDER BY tb_episode.id DESC LIMIT $limit");
	for($i=0;$i<count($arr);$i++) {
		$name = $arr[$i][1];
		$filmid = $arr[$i][2];
		$title = $arr[$i][3];
		$url = get_url($arr[$i][0],$title,'Xem Phim');
		$thumb = $arr[$i][4];
		if(!$thumb) $thumb = TEMPLATE_URL.'images/bgcatft.jpg';
		$html .= "
		<li>
			<a href=\"$url\" title=\"$title\">
				<span class=\"over_play\"></span>
				<img class=\"lazy\" src=\"$thumb\" title=\"$title\" alt=\"$title\"/>
				<div class=\"meta_block_spec\">
					<p class=\"title\">$title</p>
					<p>Tập $name</p>
				</div>
				<span class=\"gradient_thumb\"></span>
			</a>
		</li>
		";
	}
	return $html;
}
function user_menu() {
	if(IS_LOGIN == true) {
		$userid = $_SESSION["RK_Userid"];
		$username = one_data('username','user',"id = '$userid'");
		$url = get_url($userid,$username,'Thành Viên');
		$html = "
		<div class=\"loged\">
			<a href=\"$url\" class=\"user-profile level_user_1\">$username</a>
			<ul class=\"menu_user menu\">
				<li><a href=\"$url\" class=\"them_vao_hop\">Thông tin</a></li>
				<li><a href=\"#\" class=\"them_vao_hop logout_site\">Thoát</a></li>
			</ul>
		</div>";
	}else {
		$html = '<a href="#" rel="reg_box" class="show_pop btn_reg">Đăng ký</a><a href="#" rel="login_box" class="show_pop btn_login">Đăng nhập</a>';
	}
	return $html;
}
function bxh_show($type) {
	if($type == 'day') $orderby = 'viewed_day';
	else if($type == 'week') $orderby = 'viewed_week';
	else if($type == 'month') $orderby = 'viewed_month';
	else if($type == 'vote') $orderby = 'total_value';
	$arr = MySql::dbselect('id,title,thumb,year,duration,title_en,actor','film',"id != 0 ORDER BY $orderby DESC LIMIT 10");
	for($i=0;$i<count($arr);$i++) {
		$id = $arr[$i][0];
		$name = $arr[$i][1];
		$name_en = $arr[$i][5];
		$url = get_url($arr[$i][0],$name,'Phim');
		$thumb = $arr[$i][2];
		$actor = CutName($arr[$i][6],70);
		$year = $arr[$i][3];
		$duration = $arr[$i][4];
		$num = $i+1;
		if($num == 1) $color[$i] = '#FF9934';
		else if($num == 2) $color[$i] = '#66CBFF';
		else if($num == 3) $color[$i] = '#67FF9A';
		else $color[$i] = '#9966FF';
		$html .= "<div class=\"bxh-ngay pull-left\">
	<div class=\"stt-bxh pull-left\">
		<svg width=\"100\" height=\"100\"><circle cx=\"50\" cy=\"50\" r=\"25\" fill=\"".$color[$i]."\"/><text fill=\"#ffffff\" font-size=\"20\" font-family=\"Verdana\" x=\"45\" y=\"56\">$num</text></svg>
	</div>
	<div class=\"movie-img pull-left\">
		<img src=\"$thumb\" title=\"$name\" name=\"$name\"/>
	</div>
	<div class=\"movie-title pull-left span8\">
		<h2>$name ($year)</h2>
		Diễn viên: </span><label>$actor</label>
	</div>
	<div class=\"pull-right span1\">
		<div class=\"bxh-control\">
			<a href=\"$url\" title=\"Xem phim $name\"><i class=\"mui-ten\"></i></a>
		</div>
		<div class=\"bxh-control-cong\" data-id=\"$id\">
			<a href=\"#\" title=\"Thêm vào xem sau\"><i class=\"dau-cong\"></i></a>
		</div>
	</div>
</div>";
	}
	return $html;
}
function type_video(&$url) {
    $t_url     = strtolower($url);
    $ext       = explode('.', $t_url);
    $ext       = $ext[count($ext) - 1];
    $ext       = explode('?', $ext);
    $ext       = $ext[0];
    $movie_arr = array('wmv','avi','asf','mpg','mpe','mpeg','asx','m1v','mp2','mpa','ifo','vob','smi');
    $extra_swf_arr = array('www.metacafe.com','www.livevideo.com');
    for ($i = 0; $i < count($extra_swf_arr); $i++) {
        if (preg_match("#^http://" . $extra_swf_arr[$i] . "/(.*?)#s", $url)) {
            $type = 2;
            break;
        }
    }
    $is_youtube       = (preg_match("#youtube.com/([^/]+)#", $url));
    $is_youtube1      = (preg_match("#http://www.youtube.com/watch%(.*?)#s", $url));
    $is_youtube2      = (preg_match("#http://www.youtube.com/watch/v/(.*?)#s", $url));
    $is_youtube3      = (preg_match("#http://www.youtube.com/v/(.*?)#s", $url));
    $is_gdata         = (preg_match("#http://gdata.youtube.com/feeds/api/playlists/(.*?)#s", $url));
    $is_daily         = (preg_match("#dailymotion.com#", $url));
    $is_vntube        = (preg_match("#http://www.vntube.com/mov/view_video.php\?viewkey=(.*?)#s", $url));
    $is_tamtay        = (preg_match("#http://video.tamtay.vn/play/([^/]+)(.*?)#s", $url, $idvideo_tamtay));
    $is_chacha        = (preg_match("#http://chacha.vn/song/(.*?)#s", $url));
    $is_clipvn        = (preg_match("#phim.clip.vn/watch/([^/]+)/([^,]+),#", $url));
    $is_clipvn1       = (preg_match("#clip.vn/watch/(.*?)#s", $url));
    $is_clipvn2       = (preg_match('#clip.vn/w/(.*?)#s', $url));
    $is_clipvn3       = (preg_match('#clip.vn/embed/(.*?)#s', $url));
    $is_googleVideo   = (preg_match("#http://video.google.com/videoplay\?docid=(.*?)#s", $url));
    $is_myspace       = (preg_match("#http://vids.myspace.com/index.cfm\?fuseaction=vids.individual&VideoID=(.*?)#s", $url));
    $is_timnhanh      = (preg_match("#http://video.yume.vn/(.*?)#s", $url));
    $is_veoh          = (preg_match("#http://www.veoh.com/videos/(.*?)#s", $url));
    $is_veoh1         = (preg_match("#http://www.veoh.com/browse/videos/category/([^/]+)/watch/(.*?)#s", $url));
    $is_baamboo       = (preg_match("#http://video.baamboo.com/watch/([0-9]+)/video/([^/]+)/(.*?)#", $url, $idvideo_baamboo));
    $is_livevideo     = (preg_match("#http://www.livevideo.com/video/([^/]+)/(.*?)#", $url, $idvideo_live));
    $is_sevenload     = (preg_match("#sevenload.com/videos/([^/-]+)-([^/]+)#", $url, $id_sevenload));
    $is_picasa        = (preg_match('#picasaweb.google.com/(.*?)#s', $url));
    $is_badongo       = (preg_match("#badongo.com/vid/(.*?)#s", $url));
    $id_sevenload     = (preg_match("#sevenload.com/videos/([^/-]+)-([^/]+)#", $url, $id_sevenload));
    $is_olala         = (preg_match("#http://timvui.vn/player/(.*?)#s", $url));
    $is_tvzing        = (preg_match("#tv.zing.vn/video/([^/]+)#", $url));
    $is_mediafire     = (preg_match("#http://www.mediafire.com/?(.*?)#s", $url));
    $is_cyworld       = (preg_match("#cyworld.vn/([^/]+)#", $url));
    $is_goonline      = (preg_match("#http://clips.goonline.vn/xem/(.*?)#s", $url));
    $is_movshare      = (preg_match("#http://www.movshare.net/video/(.*?)#s", $url));
    $is_novamov       = (preg_match("#http://www.novamov.com/video/(.*?)#s", $url));
    $is_zippyshare    = (preg_match("#http://www([0-9]+).zippyshare.com/v/(.*?)/file.html#s", $url));
    $is_sendspace     = (preg_match("#sendspace.com/([^/]+)#", $url));
    $is_vidxden       = (preg_match("#http://www.vidxden.com/(.*?)#s", $url));
    $is_megafun       = (preg_match("##megafun.vn/(.*?)#s", $url));
    $is_BB            = (preg_match("#http://www.videobb.com/video/(.*?)#s", $url));
    $is_Sshare        = (preg_match("#http://www.speedyshare.com/files/(.*?)#s", $url));
    $is_4share1       = (preg_match("#4shared.com/file/(.*?)#s", $url));
    $is_4share2       = (preg_match("#4shared.com/video/(.*?)#s", $url));
    $is_4share3       = (preg_match("#4shared.com/embed/(.*?)#s", $url));
    $is_2share1       = (preg_match("#2shared.com/file/(.*?)#s", $url));
    $is_2share2       = (preg_match("#2shared.com/video/(.*?)#s", $url));
    $is_2share3       = (preg_match("#2sharedid=(.*?)#s", $url));
    $is_Wootly        = (preg_match("#http://www.wootly.com/(.*?)#s", $url));
    $is_tusfiles      = (preg_match("#http://www.tusfiles.net/(.*?)#s", $url));
    $is_sharevnn      = (preg_match("#http://share.vnn.vn/dl.php/(.*?)#s", $url));
    $is_BBS           = (preg_match("#http://videobb.com/video/(.*?)#s", $url));
    $is_ovfile        = (preg_match("#http://ovfile.com/(.*?)#s", $url));
    $is_SSh           = (preg_match("#http://phim.soha.vn/watch/3/video/(.*?)#s", $url));
    $is_em4share      = (preg_match("#http://www.4shared.com/embed/(.*?)#s", $url));
    $is_viddler       = (preg_match("#http://www.viddler.com/player/(.*?)#s", $url));
    $is_vivo          = (preg_match("#http://vivo.vn/episode/(.*?)#s", $url));
    $is_SeeOn         = (preg_match("#http://video.seeon.tv/video/(.*?)#s", $url));
    $is_vidus         = (preg_match("#http://s([0-9]+).vidbux.com:([0-9]+)/d/(.*?)#s", $url));
    $is_Twitclips     = (preg_match("#http://www.twitvid.com/(.*?)#s", $url));
    $is_videozer      = (preg_match("#http://videozer.com/embed/(.*?)#s", $url));
    $is_eyvx          = (preg_match("#http://eyvx.com/(.*?)#s", $url));
    $is_banbe         = (preg_match("#banbe.net/(.*?)#s", $url));
    $is_nhaccuatui    = (preg_match("#nhaccuatui.com(.*?)#s", $url));
    $is_ggdocs        = (preg_match("#docs.google.com(.*?)#s", $url));
	$is_ggdrive       = (preg_match("#drive.google.com(.*?)#s", $url));
    $is_upfile        = (preg_match("#upfile.vn/([^/]+)#", $url));
    $is_plusgoogle    = (preg_match("#plus.google.com/([^/]+)#", $url));
    $is_vidbull       = (preg_match("#vidbull.com/([^/]+)#", $url));
    $is_telly         = (preg_match("#telly.com/([^/]+)#", $url));
    $is_movreel       = (preg_match("#movreel.com/([^/]+)#", $url));
    $is_videoweed     = (preg_match("#videoweed.es/([^/]+)#", $url));
    $is_hulk          = (preg_match("#hu.lk/([^/]+)#", $url));
    $is_novamov       = (preg_match("#novamov.com/([^/]+)#", $url));
    $is_bitshare      = (preg_match("#bitshare.com/([^/]+)#", $url));
    $is_jumbofiles    = (preg_match("#jumbofiles.com/([^/]+)#", $url));
    $is_glumbouploads = (preg_match("#glumbouploads.com/([^/]+)#", $url));
	$is_phimsomotvn = (preg_match("#phimsomot.vn/([^/]+)#", $url));
	$is_photos 		  = (preg_match("#photos.google.com/([^/]+)#", $url));
	$is_openload      = (preg_match("#openload.co/(.*?)#s", $url));
    if ($ext == 'flv' || $ext == 'mp4') $type = 1;
    elseif ($ext == 'swf' || $is_googleVideo || $is_baamboo) $type = 2;
    elseif ($is_zing || $is_zing1 || $is_zing2 || $is_zing3) $type = 3;
    elseif ($is_youtube || $is_youtube1 || $is_youtube2 || $is_youtube3) $type = 4;
    elseif ($is_picasa) $type = 5;
    elseif ($is_movshare) $type = 6;
    elseif ($is_tamtay || $is_tamtay1 || $idvideo_tamtay || $idvideo_tamtay2) $type = 7;
    elseif ($is_4share1 || $is_4share2 || $is_4share3) $type = 8;
    elseif ($ext == 'divx' || $is_sendspace || $is_olala || $is_megavideo || $is_mediafire || $is_goonline || $is_sevenload || $is_vidxden || $is_novamov || $is_BB || $is_Sshare || $is_Wootly || $is_tusfiles || $is_sharevnn || $is_BBS || $is_ovfile || $is_SSh || $is_em4share || $is_viddler || $is_vivo || $is_SeeOn || $is_vidus || $is_Twitclips || $is_videozer || $is_eyvx || $is_myspace || $is_timnhanh || $is_chacha) $type = 9;
    elseif ($is_2share1 || $is_2share2 || $is_2share3) $type = 10;
    elseif ($is_clipvn || $is_clipvn1 || $is_clipvn2 || $is_clipvn3) $type = 11;
    elseif ($is_banbe) $type = 12;
    elseif ($is_veoh || $is_veoh1) $type = 13;
    elseif ($is_megafun) $type = 14;
    elseif ($is_nhaccuatui) $type = 15;
    elseif ($is_daily)  $type = 16;
    elseif ($is_zippyshare) $type = 17;
    elseif ($is_gdata) $type = 18;
    elseif ($is_cyworld) $type = 19;
    elseif ($is_badongo) $type = 20;
    elseif ($is_ggdocs || $is_ggdrive) $type = 21;
    elseif ($is_tvzing) $type = 22;
    elseif ($is_upfile) $type = 23;
    elseif ($is_plusgoogle) $type = 24;
    elseif ($is_vidbull) $type = 25;
    elseif ($is_telly) $type = 26;
    elseif ($is_movreel) $type = 27;
    elseif ($is_videoweed) $type = 28;
    elseif ($is_hulk) $type = 29;
    elseif ($is_novamov) $type = 30;
    elseif ($is_bitshare) $type = 31;
    elseif ($is_jumbofiles) $type = 32;
    elseif ($is_glumbouploads) $type = 33;
	elseif ($is_phimsomotvn) $type = 34;
	elseif ($is_photos) $type = 38;
	elseif ($is_openload) $type = 38;
    elseif (!$type) $type = 1;
    return $type;
}

function list_episode($filmid,$filmname,$episodeid = '') {
	$khongbit = TEMPLATE_URL.'images/bgepisode.jpg';

	$episode = MySql::dbselect('id,name,filmid,url,subtitle,present','episode',"filmid = '$filmid' AND active=1 ORDER BY id ASC");
	for($i=0;$i<count($episode);$i++) {
		$epid		=	$episode[$i][0];
		$epname		=	$episode[$i][1];
		$playLink	=	get_url($epid,$filmname,'Xem Phim');
		$episode_type = type_video($episode[$i][3]);
		if($episodeid == $epid) $class[$i] = 'btn-alt';
		if($episode[$i][5]==2){
			$episode_type = 40;
			$sv[$episode_type] .= '<a href="'.$playLink.'" class="btn '.$class[$i].' waves-button waves-effect" style="margin: 5px;" id="'.$epid.'"><span>&nbsp;&nbsp;'.$epname.'&nbsp;&nbsp;</span></a>';
		}elseif($episode[$i][5]==3){
			$episode_type = 41;
			$sv[$episode_type] .= '<a href="'.$playLink.'" class="btn '.$class[$i].' waves-button waves-effect" style="margin: 5px;" id="'.$epid.'"><span>&nbsp;&nbsp;'.$epname.'&nbsp;&nbsp;</span></a>';			
		}elseif($episode[$i][5]==1){
			$episode_type = 42;
			$sv[$episode_type] .= '<a href="'.$playLink.'" class="btn '.$class[$i].' waves-button waves-effect" style="margin: 5px;" id="'.$epid.'"><span>&nbsp;&nbsp;'.$epname.'&nbsp;&nbsp;</span></a>';
		}else{
			$sv[$episode_type] .= '<a href="'.$playLink.'" class="btn '.$class[$i].' waves-button waves-effect" style="margin: 5px;" id="'.$epid.'"><span>&nbsp;&nbsp;'.$epname.'&nbsp;&nbsp;</span></a>';
		}
	}
	if($sv[1]) $total_server .= "<div class=\"server\"><div class=\"btn\">V.I.P:</div>".$sv[1]."</div>";
	if($sv[2]) $total_server .= "<div class=\"server\"><div class=\"btn\">Flash:</div>".$sv[2]."</div>";
	if($sv[3]) $total_server .= "<div class=\"server\"><div class=\"btn\">Zing:</div>".$sv[3]."</div>";
	if($sv[4]) $total_server .= "<div class=\"server\"><div class=\"btn\">YouTube:</div>".$sv[4]."</div>";
	if($sv[5]) $total_server .= "<div class=\"server\"><div class=\"btn\"><a href=\"\" >Picasa:</a></div>".$sv[5]."</div>";
	if($sv[6]) $total_server .= "<div class=\"server\"><div class=\"btn\">Movshare:</div>".$sv[6]."</div>";
	if($sv[7]) $total_server .= "<div class=\"server\"><div class=\"btn\">Tam Tay:</div>".$sv[7]."</div>";
	if($sv[8]) $total_server .= "<div class=\"server\"><div class=\"btn\">4Share:</div>".$sv[8]."</div>";
	if($sv[9]) $total_server .= "<div class=\"server\"><div class=\"btn\">Unknow:</div>".$sv[9]."</div>";
	if($sv[10]) $total_server .= "<div class=\"server\"><div class=\"btn\">2Share:</div>".$sv[10]."</div>";
	if($sv[11]) $total_server .= "<div class=\"server\"><div class=\"btn\">Clip.Vn:</div>".$sv[11]."</div>";
	if($sv[12]) $total_server .= "<div class=\"server\"><div class=\"btn\">Ban Be:</div>".$sv[12]."</div>";
	if($sv[13]) $total_server .= "<div class=\"server\"><div class=\"btn\">Veoh:</div>".$sv[13]."</div>";
	if($sv[14]) $total_server .= "<div class=\"server\"><div class=\"btn\">MegaFun:</div>".$sv[14]."</div>";
	if($sv[15]) $total_server .= "<div class=\"server\"><div class=\"btn\">NhacCuaTui:</div>".$sv[15]."</div>";
	if($sv[16]) $total_server .= "<div class=\"server\"><div class=\"btn\">Dailymotion:</div>".$sv[16]."</div>";
	if($sv[17]) $total_server .= "<div class=\"server\"><div class=\"btn\">Zippy Share:</div>".$sv[17]."</div>";
	if($sv[18]) $total_server .= "<div class=\"server\"><div class=\"btn\">YouTube:</div>".$sv[18]."</div>";
	if($sv[19]) $total_server .= "<div class=\"server\"><div class=\"btn\">Cyworld:</div>".$sv[19]."</div>";
	if($sv[20]) $total_server .= "<div class=\"server\"><div class=\"btn\">Gdata:</div>".$sv[20]."</div>";
	if($sv[21]) $total_server .= "<div class=\"server\"><div class=\"btn\">Google Docs:</div>".$sv[21]."</div>";
	if($sv[22]) $total_server .= "<div class=\"server\"><div class=\"btn\">ZingVN:</div>".$sv[22]."</div>";
	if($sv[24]) $total_server .= "<div class=\"server\"><div class=\"btn\">Picasa 2:</div>".$sv[24]."</div>";
	if($sv[25]) $total_server .= "<div class=\"server\"><div class=\"btn\">Vidbull:</div>".$sv[25]."</div>";
	if($sv[26]) $total_server .= "<div class=\"server\"><div class=\"btn\">Telly:</div>".$sv[26]."</div>";
	if($sv[27]) $total_server .= "<div class=\"server\"><div class=\"btn\">Movreel:</div>".$sv[27]."</div>";
	if($sv[28]) $total_server .= "<div class=\"server\"><div class=\"btn\">Videoweed:</div>".$sv[28]."</div>";
	if($sv[29]) $total_server .= "<div class=\"server\"><div class=\"btn\">Hu.lk:</div>".$sv[29]."</div>";
	if($sv[30]) $total_server .= "<div class=\"server\"><div class=\"btn\">Novamov:</div>".$sv[30]."</div>";
	if($sv[31]) $total_server .= "<div class=\"server\"><div class=\"btn\">Bitshare:</div>".$sv[31]."</div>";
	if($sv[32]) $total_server .= "<div class=\"server\"><div class=\"btn\">Jumbofiles:</div>".$sv[32]."</div>";
	if($sv[33]) $total_server .= "<div class=\"server\"><div class=\"btn\">Glumbouploads:</div>".$sv[33]."</div>";
	if($sv[38]) $total_server .= "<div class=\"server\"><div class=\"btn\">PV.I.P:</div>".$sv[38]."</div>";
	if($sv[39]) $total_server .= "<div class=\"server\"><div class=\"btn\">OV.I.P:</div>".$sv[39]."</div>";
	if($sv[40]) $total_server .= "<div class=\"server\"><div class=\"btn\">SV.I.P VS:</div>".$sv[40]."</div>";
	if($sv[41]) $total_server .= "<div class=\"server\"><div class=\"btn\">SV.I.P FULL:</div>".$sv[41]."</div>";
	if($sv[42]) $total_server .= "<div class=\"server\"><div class=\"btn\">Thuyết Minh:</div>".$sv[42]."</div>";
	return $total_server;
}
function list_episode_slider($filmid,$filmname,$id) {
	$episode = MySql::dbselect('id,name,filmid,url,subtitle,thumb','episode',"filmid = '$filmid' ORDER BY id ASC");
	if(count($episode) > 1) {
		$total_server .= '<div class="watch-list"><div class="stream-line"><div class="scroll_list"><ul class="stream-items">';
		for($i=0;$i<count($episode);$i++) {
			$epid		=	$episode[$i][0];
			$epname		=	$episode[$i][1];
			$thumb		=	$episode[$i][5];
			if(!$thumb) $thumb = TEMPLATE_URL.'images/bgepisode.jpg';
			$playLink	=	get_url($epid,$filmname,'Xem Phim');
			$episode_type = type_video($episode[$i][3]);
			if($id == $epid) $class[$i] = ' class="current"';
			$sv[$episode_type] .= "
			<li".$class[$i]." id=\"ep_$epid\">
				<a href=\"$playLink\" id=\"$epid\">
					<span class=\"video\"></span><span class=\"name\">Tập $epname</span>
					<img rel=\"nofollow\" title=\"Tập $epname\" id=\"img_$epname\" src=\"$thumb\"/>
				</a>
			</li>";
		}
		$epurl = one_data('url','episode',"id = '$id'");
		$eptype = type_video($epurl);
		if($sv[$eptype]) $total_server .= $sv[$eptype];
		$total_server .= '</ul></div><div class="wrap_prev_block"><a href="javascript:void(0)" class="stream-prev prev_block"></a></div><div class="wrap_next_block"><a href="javascript:void(0)" class="stream-next next_block"></a></div></div></div>';
	}
	return $total_server;
}
function get_video($sql,$limit,$type='') {
	$arr = MySql::dbselect('id,name,url,duration,thumb,viewed','media',"$sql order by id desc limit $limit");
	if($type == 'rand') {
		for($i=0;$i<count($arr);$i++) {
			$name = $arr[$i][1];
			$thumb = $arr[$i][4];
			$mediaid = $arr[$i][0];
			$duration = $arr[$i][3];
			$viewed = $arr[$i][5];
			$url = get_url($mediaid,$name,'Xem Video');
			$html .= '<li>
				<a href="'.$url.'">
				<span class="img-215">
				<img src="'.$thumb.'" alt="'.$name.'" title="'.$name.'" style="height:100px;max-width:200px">
				</span>
				<span class="cast-name">'.$name.'</span>
				</a>
				</li>';	
		}
	}else {
		for($i=0;$i<count($arr);$i++) {
			$name = $arr[$i][1];
			$thumb = $arr[$i][4];
			$mediaid = $arr[$i][0];
			$duration = $arr[$i][3];
			$viewed = $arr[$i][5];
			$url = get_url($mediaid,$name,'Xem Video');
			$html .= "
			<li style=\"float:left;height:400px\">
			<div class=\"hvideo clearfix\">
				<div class=\"video\">
					<img src=\"$thumb\" title=\"$name\" alt=\"$name\"/><a href=\"$url\"><span class=\"vdicon\"></span></a>
				</div>
				<div class=\"info\">
					<h1>$name</h1>
					<span class=\"content\"><strong>Thời lượng</strong>: $duration</span>
					<span class=\"content\"><strong>Lượt xem</strong>: $viewed</span>
				</div>
			</div>
			</li>
			";
		}
	}
	return $html;
}
include('videojs-fix/JS_Player_Fix.php');
?>
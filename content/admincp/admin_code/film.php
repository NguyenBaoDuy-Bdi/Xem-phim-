<div class="main">
	<div class="container">
	<?php if($Admingroup == '1') echo '<pre>Lưu ý: Bạn đang nằm trong nhóm <b>hợp tác viên</b>, bạn sẽ bị hạn chế một số chức năng thêm/sửa/xóa thông tin trên website.</pre>';?>
<?php
$admin_id = $_SESSION["RK_Adminid"];
	if($mode == 'delete') {
		if($Admingroup == '2') {
			MySql::dbdelete('film',"id = '$filmid'");
			MySql::dbdelete('film_other',"filmid = '$filmid'");
			MySql::dbdelete('episode',"filmid = '$filmid'");
		}
		header('Location: ?action=film');
	} else if($mode == 'add' || $mode == 'edit') {
		$timeupdate = time();
		$title = RemoveHack($_POST['titlevn']);
		$title_en = RemoveHack($_POST['Title']);
		$title_search = VietChar($title);
		$director = RemoveHack($_POST['Director']);
		$actor = RemoveHack($_POST['Actors']);
		$category = ','.(implode(',',$_POST['category'])).',';
		$country = RemoveHack($_POST['country']);
		$duration = RemoveHack($_POST['Runtime']);
		$year = RemoveHack($_POST['Year']);
		$thumb = RemoveHack($_POST['thumb']);
		$image_params = getimagesize($_FILES["thumb-upload"]["tmp_name"]);
	    if($image_params !== false) {
	    	$thumb_name = Replace(VietChar($title));
	    	$thumb = UPLOAD_URL."images/".$thumb_name.".jpg";
	    	move_uploaded_file($_FILES["thumb-upload"]['tmp_name'], UPLOAD_PATH."images/".$thumb_name.".jpg");
	    }
		$filmlb = RemoveHack($_POST['filmlb']);
		$quality = RemoveHack($_POST['quality']);
		$thuyetminh = RemoveHack($_POST['thuyetminh']);
		$trailer = RemoveHack($_POST['trailer']);
		$big_image = RemoveHack($_POST['big_image']);
		$release_time = RemoveHack($_POST['release_time']);
		$content = addslashes($_POST['content']);
		$link_down = $_POST['link_down'];
		$keywords = RemoveHack($_POST['keywords']);
		if($filmid && !$_POST['submit']) {
			$arr = MySql::dbselect('
				tb_film.title,
				tb_film.title_en,
				tb_film.director,
				tb_film.actor,
				tb_film.category,
				tb_film.country,
				tb_film.duration,
				tb_film.year,
				tb_film.thumb,
				tb_film.filmlb,
				tb_film.quality,
				tb_film.trailer,
				tb_film.big_image,
				tb_film.release_time,
				tb_film_other.content,
				tb_film_other.keywords,
				tb_film.userpost,
				tb_film_other.searchs,
				tb_film.thuyetminh,
				tb_film.link_down
				','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"filmid = '$filmid'");
			$title = RemoveHack($arr[0][0]);
			$title_en = RemoveHack($arr[0][1]);
			$director = RemoveHack($arr[0][2]);
			$actor = RemoveHack($arr[0][3]);
			$category = RemoveHack($arr[0][4]);
			$country = RemoveHack($arr[0][5]);
			$duration = RemoveHack($arr[0][6]);
			$year = RemoveHack($arr[0][7]);
			$thumb = RemoveHack($arr[0][8]);
			$filmlb = RemoveHack($arr[0][9]);
			$quality = RemoveHack($arr[0][10]);
			$trailer = RemoveHack($arr[0][11]);
			$big_image = RemoveHack($arr[0][12]);
			$release_time = RemoveHack($arr[0][13]);
			$content = $arr[0][14];
			$keywords = RemoveHack($arr[0][15]);
			$userpost = $arr[0][16];
			$thuyetminh = RemoveHack($arr[0][18]);
			$link_down = $arr[0][19];
		}
	if($mode == 'add' && $_POST['submit'] && ($Admingroup == '2' or $Admingroup == '1')) {
		$timeupdate = time();
		MySql::dbinsert("film",
		"title,title_en,title_search,director,actor,category,country,duration,year,thumb,filmlb,quality,trailer,big_image,release_time,timeupdate,userpost,thuyetminh,link_down",
		"'$title','$title_en','$title_search','$director','$actor','$category','$country','$duration','$year','$thumb','$filmlb','$quality','$trailer','$big_image','$release_time','$timeupdate','$admin_id','$thuyetminh','$link_down'");
		$filmis = mysql_insert_id();
		MySql::dbinsert("film_other","filmid,content,keywords,searchs","'$filmis','$content','$keywords','$keywords'");
		header('Location: ?action=film');
	}else if($mode == 'edit' && $_POST['submit'] && ($Admingroup != 0)) {
		//echo UPLOAD_PATH;
		$timeupdate = time();
		MySql::dbupdate('film',"
			title = '$title',
			title_en = '$title_en',
			title_search = '$title_search',
			director = '$director',
			actor = '$actor',
			category = '$category',
			country = '$country',
			duration = '$duration',
			year = '$year',
			thumb = '$thumb',
			filmlb = '$filmlb',
			quality = '$quality',
			trailer = '$trailer',
			big_image = '$big_image',
			release_time = '$release_time',
			timeupdate = '$timeupdate',
			thuyetminh = '$thuyetminh',
			link_down  = '$link_down'
			","id = '$filmid'");
		MySql::dbupdate('film_other',"
			content = '$content',
			keywords = '$keywords'
			","filmid = '$filmid'");
		header('Location: ?action=film&mode=edit&filmid='.$filmid);
	}else if($_POST['submit'] && $Admingroup !== '2') {
		header('Location: ?action=film&mode=edit&filmid='.$filmid);
	}
?>
<script type="text/javascript" language="javascript">
$(function () {
	$('textarea#content').ckeditor();
});
</script>
		<div class="widget stacked">
			<div class="widget-header">
				<i class="icon-check"></i>
				<h3>Đăng / Sửa phim</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">




				<form class="form-horizontal" method="post" enctype="multipart/form-data"/>
					<fieldset>

						<div class="control-group">
							<label class="control-label" for="title">Tên phim</label>
							<div class="controls">
								<input type="text" class="input-large" name="titlevn" id="titlevn" value="<?php echo $title;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="title">ID IDBM </label>
							<div class="controls">
							    <input class="input-large" type="text" id="getidbm2" name="Checkbx2" value="">
							    <input type="button" id="getidbm" class="btmmt" name="Checkbx" value="Generate data from IMDb">
				<script>
	$('input[name=Checkbx]').click(function() {
	var coc = $('input[name=Checkbx2]').get(0).value;
    $.getJSON("http://www.omdbapi.com/?&plot=full&i=" + coc, function(data) {
	    var valDir = "";
		var valWri = "";
		var valAct = "";
		var review = "review";	
		$.each(data, function(key, val) {
			  $('input[name=' +key+ ']').val(val); 
			  if(key == "Plot"){
				$('textarea[name=' +key+ ']').val(val); 
			  }
			  if(key == "Year"){
				$('#new-tag-').val(val);
			  }
			  
		});
		$('#new-tag-').val(valDir);
		$('#new-tag-').val(valAct);
	}); 
});
</script>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="Title">Tên tiếng anh</label>
							<div class="controls">
								<input type="text" class="input-large" name="Title" id="title_en" value="<?php echo $title_en;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="director">Đạo diễn</label>
							<div class="controls">
								<input type="text" class="input-large" name="Director" id="director" value="<?php echo $director;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="actor">Diễn viên</label>
							<div class="controls">
								<input type="text" class="input-large" name="Actors" id="actor" value="<?php echo $actor;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="category">Thể loại</label>
							<div class="controls">
								<?php echo admin_category($category);?>
							</div>
						</div>
        <div class="control-group"><label class="control-label" for="filmlb">phim chiếu rạp</label>
<div class="controls">
<select id="decu" name="decu">
<?php echo admin_decu($decu);?>
</select>
</div>
</div>           
 <div class="control-group"><label class="control-label" for="filmlb">Hiển thị tại slider</label>
<div class="controls">
<select id="slider" name="slider">
<?php echo admin_slider($slider);?>
</select>
</div>
</div>                              
						<div class="control-group">
							<label class="control-label" for="country">Quốc gia</label>
							<div class="controls">
								<select id="country" name="country">
								<?php echo admin_country($country);?>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="duration">Thời lượng</label>
							<div class="controls">
								<input type="text" class="input-large" name="Runtime" id="duration" value="<?php echo $duration;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="year">Năm sản xuất</label>
							<div class="controls">
								<input type="text" class="input-large" name="Year" id="year" value="<?php echo $year;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="thumb">Ảnh phim</label>
							<div class="controls">
								<input type="text" class="input-large" name="thumb" id="thumb" value="<?php echo $thumb;?>"/>
								<br />
								<input type="file" name="thumb-upload" id="thumb-upload"/>
                                <!--button class="btn" type="button">Change Content</button-->
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="filmlb">Phân loại</label>
							<div class="controls">
								<select id="filmlb" name="filmlb">
								<?php echo admin_filmlb($filmlb);?>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="quality">Chất lượng</label>
							<div class="controls">
								<input type="text" class="input-large" name="quality" id="quality" value="<?php echo $quality;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="quality">Thuyết minh</label>
							<div class="controls">
								<select name="thuyetminh">
								<option value="0" <?if($thuyetminh==0) { echo "selected";}?>>Không</option>
								<option value="1" <?if($thuyetminh==1) { echo "selected";}?>>Có</option>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="trailer">Trailer (Embed)</label>
							<div class="controls">
								<input type="text" class="input-large" name="trailer" id="trailer" value="<?php echo $trailer;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="trailer">Link Download</label>
							<div class="controls">
								<input type="text" class="input-large" name="link_down" id="link_down" value="<?php echo $link_down;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="big_image">Ảnh lớn</label>
							<div class="controls">
								<input type="text" class="input-large" name="big_image" id="big_image" value="<?php echo $big_image;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="release_time">Ngày phát hành</label>
							<div class="controls">
								<textarea id="release_time" name="Released" class="span8" rows="8"><?php echo $release_time;?></textarea>								
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="content">Thông tin phim</label>
							<div class="controls">
								<textarea id="content" name="content" class="span8" rows="8"><?php echo $content;?></textarea>
								
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="keywords">Từ khóa phim</label>
							<div class="controls">
								<textarea id="keywords" name="keywords" class="span8" rows="3"><?php echo $keywords;?></textarea>
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-danger btn" name="submit" value="submit">Hoàn tất</button>&nbsp;&nbsp; <button type="reset" class="btn">Làm lại</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
<?php }else { 
if($mode == 'phimle') {
	$sql = 'filmlb = 0 AND active!=2';
	$list_title = 'phim mới';
	$url_page = '?action=film&mode=phimle';
}elseif($mode == 'phimbo') {
	$sql = 'filmlb = 1 AND active!=2';
	$list_title = 'phim đã hoàn thành';
	$url_page = '?action=film&mode=phimbo';
}elseif($mode == 'phimbochuahoanthanh') {
	$sql = 'filmlb = 2 AND active!=2';
	$list_title = 'phim chưa hoàn thành';
	$url_page = '?action=film&mode=phimbochuahoanthanh';
}elseif($mode == 'decu') {
	$sql = 'decu = 1 AND active!=2';
	$list_title = 'phim đề cử';
	$url_page = '?action=film&mode=decu';
}elseif($mode == 'slider') {
	$sql = "slider = '1 AND active!=2'";
	$list_title = 'phim trên slider';
	$url_page = '?action=film&mode=slider';
}elseif($mode == 'error') {
	$sql = "error = '1 AND active!=2'";
	$list_title = 'phim bị lỗi';
	$url_page = '?action=film&mode=error';
}elseif($mode == 'bigthumb') {
	$sql = "big_image != ' AND active!=2'";
	$list_title = 'phim có ảnh lớn';
	$url_page = '?action=film&mode=bigthumb';
}elseif($mode == 'trailer') {
	$sql = "category LIKE '%,42,%' AND active!=2";
	$list_title = 'phim Trailer';
	$url_page = '?action=film&mode=trailer'; 
}elseif($mode == 'film_member') {
	$sql = "active = '2'";
	$list_title = 'phim thành viên đăng';
	$url_page = '?action=film&mode=film_member';
}elseif($mode == 'userpost') {
	$sql = "userpost = '".$_REQUEST['id']."' AND active!=2";
	$list_title = 'Danh sách phim của '.username($_REQUEST['id']).' đã đăng';
	$url_page = '?action=film&mode=userpost&id='.$_REQUEST['id'];
}elseif($search) {
	$sql = "title like '%$search%' OR title_en like '%$search%' AND active!=2";
	$list_title = "phim có từ khóa: $search";
	$url_page = "?action=film&search=$search";
}else {
	$sql = 'id != 0 AND active!=2';
	$list_title = 'phim mới';
	$url_page = '?action=film';
}
$num		= 	30;
$num 		= 	intval($num);
$page 		= 	intval($page);
if (!$page) 	$page = 1;
$limit 		= 	($page-1)*$num;
if($limit<0) 	$limit=0;
$arr = MySql::dbselect('
	tb_film.id,
	tb_film.title,
	tb_film.title_en,
	tb_film.thumb,
	tb_film.year,
	tb_film.big_image,
	tb_film_other.content,
	tb_film.quality,
	tb_film.country,
	tb_film.category,
	tb_film.filmlb,
	tb_film.viewed,
	tb_film.active,
	tb_film.userpost
	','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql order by id desc LIMIT $limit,$num");
$total = MySql::dbselect('tb_film.id','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql");
$allpage_site = get_allpage(count($total),$num,$page,$url_page.'&page=');
if($_POST['submit'] && ($Admingroup == '2' or $Admingroup == '1')) {
	$idlist = implode(',',$_POST['checkbox']);
	if($_POST['filmsetting'] == 'hide') MySql::dbupdate('film',"active = '0'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'show') MySql::dbupdate('film',"active = '1'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'decu') MySql::dbupdate('film',"decu = '1'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'undecu') MySql::dbupdate('film',"decu = '0'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'slider') MySql::dbupdate('film',"slider = '1'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'unslider') MySql::dbupdate('film',"slider = '0'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'phimle') MySql::dbupdate('film',"filmlb = '0'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'phimbo') MySql::dbupdate('film',"filmlb = '1'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'phimbochuahoanthanh') MySql::dbupdate('film',"filmlb = '2'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'unerror') MySql::dbupdate('film',"error = '0'","id IN ($idlist)");
	header('Location: '.$url_page);
} else if($_POST['submit'] && $Admingroup !== '2'){
	header('Location: '.$url_page);
}
?>
<script type="text/javascript" language="javascript">
$(function () {
	$('.deletefilm').live('click', function (e) {
		var url = $(this).attr('data-url');
		$.msgbox("Bạn có chắc muốn xóa phim này?", {
		type: "confirm",
		buttons : [
			{type: "submit", value: "Đồng ý"},
			{type: "cancel", value: "Hủy bỏ"}
		]}, function(result) {
			if(result !== false) window.location.href = url;
		});
	});
	$('form#list').on('submit', function(e) {
		if (confirm('Bạn có chắc muốn thực hiện hành động này?')) {
			return true;
		} else {
			return false;
		}
	});
	var check_all = false;
	$('#check_all').live('click', function (e) {
		if(check_all == false) {
			$('form#list input:checkbox').attr('checked',true); 
			$(this).html('Bỏ chọn'); 
			check_all = true;
		} else {
			$('form#list input:checkbox').attr('checked',false); 
			$(this).html('Chọn hết'); 
			check_all = false;
		}
	});
});
</script>
		<div class="row">
			<div>
				<?php if($arr) { ?>
				<form id="list" method="post">
				<div class="widget stacked ">
					<section id="tables">
					<h3>Danh sách <?php echo $list_title?></h3>
					<table class="table table-bordered table-striped table-highlight">
					<thead>
					<tr>
						<th width="70px">
							<label id="check_all">Chọn hết</label>
						</th>
						<th width="80px"><label>Ảnh phim</label></th>
						<th width="66%"><label>Tên phim</label></th>
						<th><label>Chức năng</label></th>
					</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($arr);$i++) {
							$id = $arr[$i][0];
							$title = $arr[$i][1];
							$title_en = $arr[$i][2];
							$thumb = $arr[$i][3];
							$year = $arr[$i][4];
							$filmlb = filmlb_a($arr[$i][10]);
							$viewed = $arr[$i][11];
							$active = $arr[$i][12];
							$userpost = $arr[$i][13];
							$lastep =  MySql::dbselect('name','episode',"filmid = '$id' order by id desc LIMIT 1");
							$last = $lastep[0][0];
							$category = category_a($arr[$i][9]);
							$urlfilm = get_url($arr[$i][0],$title,'Phim');
							$country = one_data('name','country',"id = '".$arr[$i][8]."'");
							if(!$thumb) $thumb = TEMPLATE_URL.'images/grey.jpg';
					?>
					<tr>
						<td><input type="checkbox" name="checkbox[]" value="<?php echo $id;?>"></td>
						<td><img src="<?php echo $thumb;?>" alt="<?php echo $title.' - '.$title_en;?>" height="90px" width="80px"></td>
						<td>
							<a href="<?php echo $urlfilm;?>" target="_blank"><?php echo $title.' - '.$title_en;?></a><br />
							Tập mới nhất: <?php echo $last;?><br />
							Phân loại: <?php echo $filmlb?> (<i>Hiện đang : <?if($active==1) echo "Hiện"; else echo "Ẩn";?></i>) <br />
							Thể loại: <?php echo $category;?><br />
							Quốc gia: <?php echo $country;?><br />
							Người đăng: <a href="?action=film&mode=userpost&id=<?=$userpost?>"><?php echo username($userpost);?></a><br />
                            Lượt xem: <?php echo $viewed;?>
						</td>
						<td>
							<p class="text-center">
								<a class="btn btn-info" href="?action=multi-episode&filmid=<?php echo $id;?>">Thêm nhiều tập</a>
							</p>
							<p>
								<a class="btn" href="?action=film&mode=edit&filmid=<?php echo $id;?>">Sửa phim</a>&nbsp;&nbsp;
								<a class="btn btn-danger deletefilm" data-url="?action=film&mode=delete&filmid=<?php echo $id;?>">Xóa phim</a>
							</p>
							<p>
								<a class="btn" href="?action=episode&mode=add&filmid=<?php echo $id;?>">Thêm tập</a>&nbsp;&nbsp;
								<a class="btn" href="?action=episode&filmid=<?php echo $id;?>">Tập phim</a>
							</p>
						</td>
					</tr>
					<?php } ?>
					</tbody>
					<?php echo $allpage_site;?>
					</table>
					</section>
				</div>
				<select name="filmsetting" style="margin-top: 10px;">
					<option>Chọn...</option>
					<option value='hide'>Ẩn phim</option>
					<option value='show'>Hiện phim</option>
					<option value='decu'>Phim đề cử</option>
					<option value='undecu'>Bỏ phim đề cử</option>
					<option value='slider'>Phim trên slider</option>
					<option value='unslider'>Bỏ phim trên slider</option>
					<option value='phimle'>Chọn phim lẻ</option>
					<option value='phimbo'>Chọn phim đã hoàn thành</option>
					<option value='phimbochuahoanthanh'>Chọn phim bộ chưa hoàn thành</option>
					<option value='unerror'>Phim đã sửa lỗi</option>
				</select>
				<input id="submit_setting" type="submit" class="btn btn-small btn-warning" name="submit" value="Thực hiện"> 
				</form>
				<?php echo $allpage_site;?>
				<?php } else { ?>
				<div class="widget stacked ">
					<div class="widget-header">
						<i class="icon-th-large"></i>
						<h3>Thông báo</h3>
					</div>
					<div class="widget-content">
						Không có phim nào được liệt kê
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
<?php } ?>
	</div>
</div>
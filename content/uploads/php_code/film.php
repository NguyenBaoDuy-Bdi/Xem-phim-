<div class="main">
	<div class="container">	
<?php
$upload_id = $_SESSION["RK_Uploadid"];
	if($mode == 'add' || $mode == 'edit') {
		$timeupdate = time();
		$title = RemoveHack($_POST['title']);
		$title_en = RemoveHack($_POST['title_en']);
		$director = RemoveHack($_POST['director']);
		$actor = $_POST['actor'];
		$category = ','.(implode(',',$_POST['category'])).',';
		$country = RemoveHack($_POST['country']);
		$duration = RemoveHack($_POST['duration']);
		$year = RemoveHack($_POST['year']);
		$thumb = RemoveHack($_POST['thumb']);
		$filmlb = RemoveHack($_POST['filmlb']);
		$film_type = RemoveHack($_POST['film_type']);
		$quality = RemoveHack($_POST['quality']);
		$trailer = RemoveHack($_POST['trailer']);
		$big_image = RemoveHack($_POST['big_image']);
		$release_time = RemoveHack($_POST['release_time']);
		$link_forum = $_POST['link_forum'];
		$content = addslashes($_POST['content']);
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
				tb_film_other.searchs
				','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"filmid = '$filmid' AND userpost = '$upload_id'");
			$title = RemoveHack($arr[0][0]);
			$title_en = RemoveHack($arr[0][1]);
			$director = RemoveHack($arr[0][2]);
			$actor = $arr[0][3];
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
			
		}
	if($mode == 'add' && $_POST['submit'] && ($Uploadgroup == '3')) {
		$timeupdate = time();
		if(!$title){
			$err .= 'Chưa nhập tên phim.<br />';
		}
		$filmed = MySql::dbselect('title','film',"title = '$title'");
		if($title == $filmed[0][0]){
			$err .= 'Phim này đã có trong dữ liệu.<br />';
		}
		if(!$category){
			$err .= 'Chưa chọn thể loại.<br/>';
		}
		if(!$duration){
			$err .= 'Chưa nhập thời lượng phim.<br/>';
		}
		if(!$year){
			$err .= 'Chưa nhập năm sản xuất.<br/>';
		}
		if(!$thumb){
			$err .= 'Chưa chọn hình ảnh.<br/>';
		}
		if(!$quality){
			$err .= 'Chưa nhập chất lượng.<br/>';
		}
		if(!$content){
			$err .= 'Chưa nhập nội dung.<br/>';
		}
		if(!$keywords){
			$err .= 'Chưa nhập từ khóa.<br/>';
		}
		
		if(!$err){
		MySql::dbinsert("film",		"title,title_en,director,actor,category,country,duration,year,thumb,filmlb,quality,trailer,big_image,timeupdate,userpost,active",
		"'$title','$title_en','$director','$actor','$category','$country','$duration','$year','$thumb','$filmlb','$quality','$trailer','$big_image','$timeupdate','$upload_id','2'");
		$filmis = mysql_insert_id();
		MySql::dbinsert("film_other","filmid,content,keywords,searchs","'$filmis','$content','$keywords','$keywords'");		
		header('Location: ?action=film');
		}
	}else if($mode == 'edit' && $_POST['submit'] && ($Uploadgroup != 0)) {
		$timeupdate = time();
		MySql::dbupdate('film',"
			title = '$title',
			title_en = '$title_en',
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
			timeupdate = '".time()."'
			","id = '$filmid'");
		MySql::dbupdate('film_other',"
			content = '$content',
			keywords = '$keywords'
			","filmid = '$filmid'");
		header('Location: ?action=film&mode=edit&filmid='.$filmid);
	}else if($_POST['submit'] && $Uploadgroup !== '3') {
		header('Location: ?action=film&mode=edit&filmid='.$filmid);
	}
?>

		<div class="widget stacked">
			<div class="widget-header">
				<i class="icon-check"></i>
				<h3>Đăng / Sửa phim</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
			<?php if($err){?>
			<div class="error" style="color:red"><?=$err?></div>
			<?}?>
				<form class="form-horizontal" method="post"/>
				<input type="hidden" name="filmlb" value="0">
					<fieldset>
					<!--<div class="control-group">
							<label class="control-label" for="title">Tập phim</label>
							<div class="controls">
							Tên tập	 <input type="text" class="input-small" name="epname" id="epname" value="<?php echo $epname;?>"/> <br/> <br/>
							Link tập  <input type="text" class="input-large" name="epurl" id="epurl" value="<?php echo $epurl;?>"/>
							</div>
						</div>-->
						<div class="control-group">
							<label class="control-label" for="title">Tên phim</label>
							<div class="controls">
								<input type="text" class="input-large" name="title" id="title" value="<?php echo $title;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="title_en">Tên tiếng anh</label>
							<div class="controls">
								<input type="text" class="input-large" name="title_en" id="title_en" value="<?php echo $title_en;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="director">Đạo diễn</label>
							<div class="controls">
								<input type="text" class="input-large" name="director" id="director" value="<?php echo $director;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="actor">Diễn viên</label>
							<div class="controls">
								<input type="text" class="input-large" name="actor" id="actor" value="<?php echo $actor;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="category">Thể loại</label>
							<div class="controls">
							<table class="theloai" >
							<tr>
							<td style="vertical-align:top;width:150px;">
								<?php echo admin_category($category);?>
							</td>
							</tr>
							</table>
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
								<input type="text" class="input-large" name="duration" id="duration" value="<?php echo $duration;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="year">Năm sản xuất</label>
							<div class="controls">
								<input type="text" class="input-large" name="year" id="year" value="<?php echo $year;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="thumb">Ảnh phim</label>
							<div class="controls">
								<input type="text" class="input-large" name="thumb" id="thumb" value="<?php echo $thumb;?>"/>
                              
							</div>
						</div>
						
						
						<div class="control-group">
							<label class="control-label" for="quality">Chất lượng</label>
							<div class="controls">
								<input type="text" class="input-large" name="quality" id="quality" value="<?php echo $quality;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="trailer">Trailer</label>
							<div class="controls">
								<input type="text" class="input-large" name="trailer" id="trailer" value="<?php echo $trailer;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="big_image">Ảnh lớn</label>
							<div class="controls">
								<input type="text" class="input-large" name="big_image" id="big_image" value="<?php echo $big_image;?>"/>
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
	$sql = 'filmlb = 0';
	$list_title = 'Anime mới';
	$url_page = '?action=film&mode=phimle';
}elseif($mode == 'phimbo') {
	$sql = 'filmlb = 1';
	$list_title = 'phim đã hoàn thành';
	$url_page = '?action=film&mode=phimbo';
}elseif($mode == 'phimbochuahoanthanh') {
	$sql = 'filmlb = 2';
	$list_title = 'phim chưa hoàn thành';
	$url_page = '?action=film&mode=phimbochuahoanthanh';
}elseif($mode == 'decu') {
	$sql = 'decu = 1';
	$list_title = 'phim đề cử';
	$url_page = '?action=film&mode=decu';
}elseif($mode == 'slider') {
	$sql = "slider = '1'";
	$list_title = 'phim trên slider';
	$url_page = '?action=film&mode=slider';
}elseif($mode == 'error') {
	$sql = "error = '1'";
	$list_title = 'phim bị lỗi';
	$url_page = '?action=film&mode=error';
}elseif($mode == 'bigthumb') {
	$sql = "big_image != ''";
	$list_title = 'phim có ảnh lớn';
	$url_page = '?action=film&mode=bigthumb';
}elseif($search) {
	$sql = "title like '%$search%' OR title_en like '%$search%'";
	$list_title = "phim có từ khóa: $search";
	$url_page = "?action=film&search=$search";
}else {
	$sql = 'id != 0 AND userpost = "'.$_SESSION["RK_Userid"].'"';
	$list_title = 'Anime mới';
	$url_page = '?action=film';
}
$num		= 	config_site('list_limit');
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
	tb_film.active
	','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql order by id desc LIMIT $limit,$num");
$total = MySql::dbselect('tb_film.id','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql");
$allpage_site = get_allpage(count($total),$num,$page,$url_page.'&page=');
if($_POST['submit'] && ($Uploadgroup == '2' or $Uploadgroup == '1')) {
	$idlist = implode(',',$_POST['checkbox']);
	if($_POST['filmsetting'] == 'decu') MySql::dbupdate('film',"decu = '1'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'undecu') MySql::dbupdate('film',"decu = '0'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'slider') MySql::dbupdate('film',"slider = '1'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'unslider') MySql::dbupdate('film',"slider = '0'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'phimle') MySql::dbupdate('film',"filmlb = '0'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'phimbo') MySql::dbupdate('film',"filmlb = '1'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'phimbochuahoanthanh') MySql::dbupdate('film',"filmlb = '2'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'unerror') MySql::dbupdate('film',"error = '0'","id IN ($idlist)");
	header('Location: '.$url_page);
} else if($_POST['submit'] && $Uploadgroup !== '2'){
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
					<h3>Danh sách phim đã đăng</h3>
					<table class="table table-bordered table-striped table-highlight">
					<thead>
					<tr>
						<th width="70px">
							<label id="check_all">Chọn hết</label>
						</th>
						<th width="80px"><label>Ảnh phim</label></th>
						<th width="50%"><label>Tên phim</label></th>
						<th width="16%"><label>Hiện có</label></th>
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
							$lastep =  MySql::dbselect('name','episode',"filmid = '$id' order by id desc LIMIT 1");
							$last = $lastep[0][0];
							$category = category_a($arr[$i][9]);
							$urlfilm = get_url($arr[$i][0],$title,'Phim');
							$country = one_data('name','country',"id = '".$arr[$i][8]."'");
							if(!$thumb) $thumb = TEMPLATE_URL.'images/grey.jpg';
							$tien = $viewed*(3000/1000);
					?>
					<tr>
						<td><input type="checkbox" name="checkbox[]" value="<?php echo $id;?>"></td>
						<td><img src="<?php echo $thumb;?>" alt="<?php echo $title.' - '.$title_en;?>" height="90px" width="80px"></td>
						<td>
							<a href="<?php echo $urlfilm;?>" target="_blank"><?php echo $title.' - '.$title_en;?></a><br />
							Tập mới nhất: <?php echo $last;?><br />
							Phân loại: <?php echo $filmlb?><br />
							Thể loại: <?php echo $category;?><br />
							Tình trạng: <?php if($active==1) echo "Đã duyệt"; else echo "Chưa duyệt";?><br />
                            Lượt xem: <?php echo $viewed;?>
						</td>
						<td><?=number_format($tien)?>đ</td>
						<td>
							<p class="text-center">
								<a class="btn" href="?action=film&mode=edit&filmid=<?php echo $id;?>">Sửa</a>&nbsp;<a class="btn btn-info" href="?action=multi-episode&filmid=<?php echo $id;?>">Thêm nhiều tập</a>
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
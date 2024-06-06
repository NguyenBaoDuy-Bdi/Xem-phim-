<div class="main">
	<div class="container">
<?php 
if($mode == 'delete') {
	MySql::dbdelete('actor',"id = '$cid'");
	header('Location: ?action=actor');
}
else if($mode == 'add' || $mode == 'edit') {
	if($mode == 'edit') {
		$arr = MySql::dbselect('name,info,urlmore,thumb','actor',"id = '$cid'");
		$name = $arr[0][0];
		$info = $arr[0][1];
		$urlmore = $arr[0][2];
		$thumb = $arr[0][3];
	}
	if($mode == 'edit' && $_POST['submit']) {
		$name = RemoveHack($_POST['name']);
		$info = RemoveHack($_POST['info']);
		$urlmore = RemoveHack($_POST['urlmore']);
		$thumb = RemoveHack($_POST['thumb']);
		MySql::dbupdate('actor',"name='$name',info='$info',urlmore='$urlmore',thumb='$thumb'","id = '$cid'");
		header("Location: ?action=actor&mode=edit&cid=$cid");
	}
?>
		<div class="widget stacked">
			<div class="widget-header">
				<i class="icon-check"></i>
				<h3>Sửa đạo diễn - diễn viên</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<form class="form-horizontal" method="post" enctype="multipart/form-data"/>
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="name">Tên</label>
							<div class="controls">
								<input type="text" class="input-large" name="name" id="name" value="<?php echo $name;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="info">Thông tin</label>
							<div class="controls">
								<textarea id="info" name="info" class="span8" rows="3"><?php echo $info;?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="urlmore">Liên kết ngoài</label>
							<div class="controls">
								<input type="text" class="input-large" name="urlmore" id="urlmore" value="<?php echo $urlmore;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="thumb">Ảnh đại diện</label>
							<div class="controls">
								<input type="text" class="input-large" name="thumb" id="thumb" value="<?php echo $thumb;?>"/>
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-danger btn" name="submit" value="submit">Hoàn tất</button>&nbsp;&nbsp; <button type="reset" class="btn">Làm lại</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
<?php } else { 
$num		= 	config_site('list_limit');
$num 		= 	intval($num);
$page 		= 	intval($page);
if (!$page) 	$page = 1;
$limit 		= 	($page-1)*$num;
if($limit<0) 	$limit=0;
if($mode == 'search') {
	$sql = "name like '%$search%'";
	//echo $search;
}else {
	$sql = 'id != 0';
}
$arr = MySql::dbselect('id,name,urlmore','actor',"$sql order by id desc LIMIT $limit,$num");
$total = MySql::dbselect('id','actor',"$sql");
if($mode == 'search') {
	$allpage_site = get_allpage(count($total),$num,$page,"?action=actor&mode=search&search=$search&page=");
}else {
	$allpage_site = get_allpage(count($total),$num,$page,"?action=actor&page=");
}
$allpage_site = get_allpage(count($total),$num,$page,"?action=actor&page=");
if($_POST['submit']) {
	$list_media = implode(',',$_POST['checkbox']);
	MySql::dbdelete('actor',"id IN ($list_media)");
	if($mode) $aaa = "&mode=search&search=$search";
	header("Location: ?action=actor$aaa");
}
?>
<script type="text/javascript" language="javascript">
$(function () {
	$('.deletefilm').live('click', function (e) {
		var url = $(this).attr('data-url');
		$.msgbox("Bạn có chắc muốn xóa quốc gia này?", {
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
		<form id="list" method="post">
		<div class="widget stacked widget-table action-table">
			<div class="widget-header">
				<i class="icon-th-list"></i>
				<h3>Đạo diễn - Diễn viên</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<table class="table table-striped table-bordered">
				<thead>
				<tr>
					<th width="100px">
						<input type="checkbox" id="check_all"> Chọn hết
					</th>
					<th>
						Tên đạo diễn - diễn viên
					</th>
					<th>
						Liên kết ngoài
					</th>
					<th width="130px">
						Chức năng
					</th>
				</tr>
				</thead>
				<tbody>
				<?php
					for($i=0;$i<count($arr);$i++) {
						$id = $arr[$i][0];
						$name = $arr[$i][1];
						$urlmore = $arr[$i][2];
				?>
				<tr>
					<td>
						<input type="checkbox" name="checkbox[]" value="<?php echo $id;?>">
					</td>
					<td>
						<?php echo $name;?>
					</td>
					<td>
						<?php echo $urlmore;?>
					</td>
					<td class="td-actions">
						<a href="?action=actor&mode=edit&cid=<?php echo $id;?>" class="btn btn-small btn-warning">
						Sửa
						</a>
						<a data-url="?action=actor&mode=delete&cid=<?php echo $id;?>" class="btn btn-small deletefilm">
						Xóa
						</a>
					</td>
				</tr>
				<?php } ?>
				</tbody>
				</table>
			</div>
			<!-- /widget-content -->
		</div>
		<input id="submit_setting" type="submit" class="btn btn-small btn-warning" name="submit" value="Xóa toàn bộ"> 
		</form>
		<?php echo $allpage_site;?>
<?php } ?>
	</div>
</div>
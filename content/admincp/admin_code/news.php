<div class="main">
	<div class="container">
<?php 
if($mode == 'delete') {
	MySql::dbdelete('news',"id = '$cid'");
	header('Location: ?action=news');
}
else if($mode == 'add' || $mode == 'edit') {
	if($mode == 'edit') {
		$arr = MySql::dbselect('title,seotitle,content','news',"id = '$cid'");
		$title = $arr[0][0];
		$seotitle = $arr[0][1];
		$content = $arr[0][2];
	}
	if($mode == 'edit' && $_POST['submit']) {
		$title = RemoveHack($_POST['title']);
		$seotitle = RemoveHack($_POST['seotitle']);
		$content = UnHtmlChars($_POST['content']);
		MySql::dbupdate('news',"title = '$title',seotitle='$seotitle',content='$content'","id = '$cid'");
		header("Location: ?action=news&mode=edit&cid=$cid");
	}else if($mode == 'add' && $_POST['submit']) {
		$title = RemoveHack($_POST['title']);
		$seotitle = RemoveHack($_POST['seotitle']);
		$content = UnHtmlChars($_POST['content']);
		MySql::dbinsert("news","title,seotitle,content","'$title','$seotitle','$content'");
		header("Location: ?action=news");
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
				<h3>Đăng / Sửa quốc gia</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<form class="form-horizontal" method="post" enctype="multipart/form-data"/>
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="title">Tiêu đề</label>
							<div class="controls">
								<input type="text" class="input-large" name="title" id="title" value="<?php echo $title;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="seotitle">Seo</label>
							<div class="controls">
								<input type="text" class="input-large" name="seotitle" id="seotitle" value="<?php echo $seotitle;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="content">Nội dung</label>
							<div class="controls">
								<textarea id="content" name="content" class="span8" rows="8"><?php echo $content;?></textarea>
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
$arr = MySql::dbselect('id,title,seotitle','news',"id != 0 order by id desc LIMIT $limit,$num");
$total = MySql::dbselect('id','news',"id != 0");
$allpage_site = get_allpage(count($total),$num,$page,"?action=news&page=");
if($_POST['submit']) {
	$list_media = implode(',',$_POST['checkbox']);
	MySql::dbdelete('news',"id IN ($list_media)");
	header('Location: ?action=news');
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
		<a href="?action=news&mode=add" class="btn btn-small btn-warning" style="margin-bottom:10px"> Thêm Bài viết</a>
		<form id="list" method="post">
		<div class="widget stacked widget-table action-table">
			<div class="widget-header">
				<i class="icon-th-list"></i>
				<h3>Tin tức</h3>
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
						Tiêu đề
					</th>
					<th>
						Seo
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
						$name_seo = $arr[$i][2];
				?>
				<tr>
					<td>
						<input type="checkbox" name="checkbox[]" value="<?php echo $id;?>">
					</td>
					<td>
						<?php echo $name;?>
					</td>
					<td>
						<?php echo $name_seo;?>
					</td>
					<td class="td-actions">
						<a href="?action=news&mode=edit&cid=<?php echo $id;?>" class="btn btn-small btn-warning">
						Sửa
						</a>
						<a data-url="?action=news&mode=delete&cid=<?php echo $id;?>" class="btn btn-small deletefilm">
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
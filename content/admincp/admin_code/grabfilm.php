<div class="main">
	<div class="container">
	<?php if($Admingroup == '1') echo '<pre>Lưu ý: Bạn đang nằm trong nhóm <b>hợp tác viên</b>, bạn sẽ bị hạn chế một số chức năng thêm/sửa/xóa thông tin trên website.</pre>';?>
<script type="text/javascript" language="javascript">
$(function () {
	$('textarea#content').ckeditor();
});
</script>
		<div class="widget stacked">
			<div class="widget-header">
				<i class="icon-check"></i>
				<h3>Grab phim</h3>
			</div>
			<!-- /widget-header -->
			<?php if(!$page) { ?>
			<div class="widget-content">
				<form class="form-horizontal" method="get"/>
					<fieldset>
						<input type="hidden" name="action" value="grabfilm">
						<div class="control-group">
							<label class="control-label" for="page">Link grab</label>
							<div class="controls">
								<input type="text" class="input-large" name="page" id="page" value=""/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="begin">Bắt đầu từ</label>
							<div class="controls">
								<input type="text" class="input-large" name="begin" id="begin" value=""/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="end">Kết thúc</label>
							<div class="controls">
								<input type="text" class="input-large" name="end" id="end" value=""/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="name">Chọn phim</label>
							<div class="controls">
								<select id="filmid" name="filmid">
									<option value="0">Thêm phim mới</option>
									<?php echo admin_film($filmid);?>
								</select>
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-danger btn">Tiếp theo</button>&nbsp;&nbsp; <button type="reset" class="btn">Làm lại</button>
						</div>
					</fieldset>
				</form>
			</div>
			<?php } else { 
				$page = urldecode($page);
				$filmid = intval($_GET['filmid']);
				if(!$_POST['submit']) {
					if(preg_match('#olaphim.org/(.*?)#s', $page)) $grabtype = 'olaphimorg';
					else if(preg_match('#anime47.com/(.*?)#s', $page)) $grabtype = 'anime47com';
					else if(preg_match('#vkool.net/(.*?)#s', $page)) $grabtype = 'vkool';
					else if(preg_match('#onphim.net/(.*?)#s', $page)) $grabtype = 'onphim';
					else if(preg_match('#topdau.com/(.*?)#s', $page)) $grabtype = 'topdau';
					else if(preg_match('#phim14.net/(.*?)#s', $page)) $grabtype = 'phim14';
					else if(preg_match('#mananhnho.net/(.*?)#s', $page)) $grabtype = 'man';
					include('sitegrab/_decode.php');
					include('sitegrab/_dom.php');
					$dom = new Dom();
					include "sitegrab/$grabtype.php";
					$keywords = "$title, xem phim $title, phim $title full hd, $title vietsub, $title_en, $title_en full hd, watch $title_en online, $title_en trọn bộ, $title tập cuối";
					if(!$quality) $quality = 'HD';
				}else if($Admingroup == '2') {
					// nhập dữ liệu vào database
					$title = RemoveHack($_POST['title']);
					$title_en = RemoveHack($_POST['title_en']);
					$director = RemoveHack($_POST['director']);
					$actor = RemoveHack($_POST['actor']);
					$category = ','.(implode(',',$_POST['category'])).',';
					$country = RemoveHack($_POST['country']);
					$duration = RemoveHack($_POST['duration']);
					$year = RemoveHack($_POST['year']);
					$thumb = RemoveHack($_POST['thumb']);
					$filmlb = RemoveHack($_POST['filmlb']);
					$quality = RemoveHack($_POST['quality']);
					$trailer = RemoveHack($_POST['trailer']);
					$big_image = RemoveHack($_POST['big_image']);
					$release_time = RemoveHack($_POST['release_time']);
					$content = HtmlChars($_POST['content']);
					$keywords = RemoveHack($_POST['keywords']);
					$timeupdate = time();
					if($title && $filmid == '0') {
						MySql::dbinsert("film","title,title_en,director,actor,category,country,duration,year,thumb,filmlb,quality,trailer,big_image,release_time,timeupdate","'$title','$title_en','$director','$actor','$category','$country','$duration','$year','$thumb','$filmlb','$quality','$trailer','$big_image','$release_time','$timeupdate'");
						$filmis = mysql_insert_id();
						MySql::dbinsert("film_other","filmid,content,keywords,searchs","'$filmis','$content','$keywords','$keywords'");
					}else {
						$filmis = $filmid;
					}
					$epbegin = intval($_POST['epbegin']);
					$epend = intval($_POST['epend']);
					for($i=$epbegin;$i<=$epend;$i++) {
						$filmid = $filmis;
						$name = RemoveHack($_POST['epname'][$i]);
						$url = RemoveHack($_POST['epurl'][$i]);
						//$epthumb = RemoveHack($_POST['thumb'][$i]);
						$subtitle = RemoveHack($_POST['epsubtitle'][$i]);
						if($name && $url) MySql::dbinsert("episode","filmid,name,url,thumb","'$filmid','$name','$url','$epthumb'");
						if(filter_var($subtitle, FILTER_VALIDATE_URL)) {
							$epidis = mysql_insert_id();
							$datasub = file_get_contents($subtitle);
							$newsub = UPLOAD_PATH."subtitle/$epidis.srt";
							file_put_contents($newsub, $datasub);
							$subtitle = UPLOAD_URL."subtitle/$epidis.srt";
							MySql::dbupdate("episode","subtitle='$subtitle'","id = '$epidis'");
						}
						//echo $i.'<br />';
					}
					header('Location: ?action=film');
					//echo $_POST['epbegin'],''.$_POST['epend'];
				}
			?>
			<div class="widget-content">
				<form class="form-horizontal" method="post"/>
					<fieldset>
						<?php if($filmid == '0') { ?>
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
								<?php echo admin_category($category);?>
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
							<label class="control-label" for="release_time">Ngày phát hành</label>
							<div class="controls">
								<input type="text" class="input-large" name="release_time" id="release_time" value="<?php echo $release_time;?>"/>
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
						<?php } ?>
						<?php
							if(!$begin) $begin = 1;
							for($i=$begin;$i<=$total_playlink;$i++) {
						?>
							<div class="control-group">
								<label class="control-label" for="name<?php echo $i;?>">Tên tập</label>
								<div class="controls">
									<input type="text" class="input-large" name="epname[<?php echo $i;?>]" id="name<?php echo $i;?>" value="<?php echo $name[$i];?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="url<?php echo $i;?>">Liên kết</label>
								<div class="controls">
									<input type="text" class="input-large" name="epurl[<?php echo $i;?>]" id="url<?php echo $i;?>" value="<?php echo $_Linkembed[$i];?>"/>
								</div>
							</div>
							<div class="control-group" style="border-bottom: 1px dotted #BBB; padding-bottom: 20px;">
								<label class="control-label" for="subtitle<?php echo $i;?>">Subtitle</label>
								<div class="controls">
									<input type="text" class="input-large" name="epsubtitle[<?php echo $i;?>]" id="subtitle<?php echo $i;?>" value="<?php echo $_Caption[$i];?>"/>
								</div>
							</div>
						<?php } ?>
						<div class="form-actions">
							<input type="hidden" name="epbegin" value="<?php echo $begin;?>">
							<input type="hidden" name="epend" value="<?php echo $total_playlink;?>">
							<button type="submit" class="btn btn-danger btn" name="submit" value="submit">Hoàn tất</button>&nbsp;&nbsp; <button type="reset" class="btn">Làm lại</button>
						</div>
					</fieldset>
				</form>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
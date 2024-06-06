<?php
if(isset($_GET['url'])){
$link = $_GET['url'];
$source = file_get_contents($link);
echo '<h5>Hiện có '.$page[2].' Trang Phim';
preg_match('#<li class="last"><a href="(.+?)([0-9]+)">Cuối &gt;&gt;</a></li>#is',$source, $page);
for($i = 1;$i <= $page[2];$i++){
	$source1 = file_get_contents($link.'?p='.$i);

if(preg_match('#<div class="box-content clearfix">(.+?)<div class="pagination pull-right clearfix">#is',$source1,$data)){
preg_match_all('#<a href="(.+?)" class="item">#is',$data[1],$url);
for($a = 0;$a <= count($url[1])-1;$a++){
echo 'phim '.$a.':<br />';
echo file_get_contents('http://php2-lephi.rhcloud.com/leech/addchap.php?url=http://phim.clip.vn'.$url[1][$a]);
echo '<hr>';
}
}elseif(preg_match('#<div class="box-content clearfix">(.+?)<div class="pagination pull-right">#is',$source1,$data)){
preg_match_all('#<a href="(.+?)" class="item">#is',$data[1],$url);
for($a = count($url[1])-1;$a >= 0;$a--){
echo file_get_contents('http://php2-lephi.rhcloud.com/leech/addchap.php?url='.$url[1][$a]);
echo '<hr>';
}
}else{
echo 'lỗi';
}
}
echo '<h6> trang '.$i.'</h6>';
}else{

echo '<form method="get">
nhạp link phim.clip.vn: <input name="url">
<input type="submit" value="Lấy Phim">


';







}
?>
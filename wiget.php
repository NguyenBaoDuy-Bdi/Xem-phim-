<?php
define('RK_MEDIA',true);
require('init.php');
?>
<!DOCTYPE html><html><head><title>Phim bộ mới</title><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="robots" content="noindex, follow"><base href="http://hayphim.tv/" /><style type="text/css"><!--
body
{
font-family: Arial, sans-serif;
font-size: 14px;
line-height: 1.3;
margin: 0;
padding: 0;
background: #4F4E52 url('wiget/item_bg.gif') repeat;
}
*
{
box-sizing: border-box;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
}
.head-title
{
padding: 3px 5px;
margin: 0;
color: #dacb46;
text-shadow: 1px 1px 1px #1a1a1a;
display: inline-block;
font-size: 120%px;
text-transform: uppercase;
}
#widget-wraper
{
margin:0;
padding: 0 5px;
display: block;
width: 100%;
position: relative;
}
.widget-list
{
display: block;
list-style: none;
margin: 0;
padding: 0;
-webkit-margin-before: 0;
-webkit-margin-after: 0;
-webkit-margin-start: 0;
-webkit-margin-end: 0;
-webkit-padding-start: 0;
white-space: nowrap;
}
.widget-item
{
display: inline-block;
width: 150px;
height: 200px;
position: relative;
margin-right: 5px;
}
.widget-item:last-child
{
margin-right: 0;
}
.item-link
{
display: block;
width: 100%;
height: 100%;
margin: 0;
padding: 0;
}
.item-link > .item-image
{
display: block;
width: 100%;
height: 100%;
background-repeat: no-repeat;
background-color: #080808;
background-size: cover;
}
.item-link > .title-wrapper
{
display: block;
background-color: rgba(0,0,0,0.7);
position: absolute;
width: 100%;
overflow: hidden;
bottom: 0;
padding: 0 2px;
}
.item-link > .title-wrapper > .title
{
display: block;
overflow: hidden;
text-overflow: ellipsis;
white-space: nowrap;
width: 100%;
color: #FF8040;
text-transform: uppercase;
font-size: 14px;
font-weight: 700;
text-decoration: none;
margin: 5px 0px;
}
.item-link > .title-wrapper > .english-title
{
color: #fff;
font-size: 12px;
display: block;
overflow: hidden;
text-overflow: ellipsis;
white-space: nowrap;
width: 100%;
text-decoration: none;
margin: 5px 0px;
}
.item-link:hover > .title-wrapper
{
background-color: rgba(0,0,0,0.9);
}
.item-link:hover .title
{
color: #dacb46;;
}
.promo-text
{
display: block;
position: absolute;
color: #fff;
background: #D9534F;
font-size: 11px;
font-weight: bold;
float: left;
clear: both;
padding: 4px;
text-shadow: 0 -1px #d0284b, 0 1px #f96080;
left: 0px;
top: 5px;
}
.promo-text:after
{
content: "";
float: right;
position: absolute;
top: 0;
right: -12px;
width: 0;
height: 0;
border-color: transparent transparent transparent #D9534F;
border-style: solid;
border-width: 11px 0 12px 12px;
}
#prev,#next
{
position: absolute;
outline: none;
cursor: pointer;
display: block;
padding: 30px 10px;
background-color: rgba(0,0,0,0.6);
}
#prev
{
left: 0;
top: 50%;
margin-top: -68px;
}
#next
{
right: 0;
top: 50%;
margin-top: -68px;
}
.prev-icon,.next-icon
{
height: 24px;
width: 16px;
display: block;
background: url(wiget/image.png) no-repeat;
}
.prev-icon
{
background-position: -2px -535px;
}
.next-icon
{
background-position: -23px -535px;
}
--></style><link href="wiget/owl.carousel.css" rel="stylesheet"><link href="wiget/owl.theme.css" rel="stylesheet"><link href="wiget/owl.transitions.css" rel="stylesheet"><script type="text/javascript" src="wiget/jquery-1.10.2.min.js"></script><script type="text/javascript" src="wiget/owl.carousel.min.js"></script><script type="text/javascript"><!--
jQuery(document).ready(function() {
var custom=[];
var i=1;
var width=i*155-5;
while(width<=2560)
{
custom.push([width,i]);
i++;
width=i*155-5;
}
jQuery("#widget").owlCarousel({
stopOnHover : true,
itemsCustom: custom,
navigation:false,
slideSpeed:500,
paginationSpeed : 500,
rewindSpeed: 500,
goToFirstSpeed : 500,
scrollPerPage: true,
singleItem : false,
autoHeight : true,
transitionStyle:"fade"
});
var listObject = jQuery("#widget");
jQuery("#next").click(function(){
listObject.trigger('owl.next');
});
jQuery("#prev").click(function(){
listObject.trigger('owl.prev');
})
});
--></script></head><body><h2 class="head-title">Phim bộ mới</h2><div id="widget-wraper">
<ul class="widget-list" id="widget">
<?php
$film = MySql::dbselect("id,title,title_en,thumb,thuyetminh,timeupdate", "film", "filmlb IN (1,2) ORDER BY timeupdate DESC LIMIT 32");
		for ($i = 0; $i < count($film); $i++) {
			$filmid = $film[$i][0];
			$title = $film[$i][1];
			$title_en = $film[$i][2]; 
			$thumb = $film[$i][3];
			$thuyetminh = $film[$i][4];
			if($thuyetminh == 1){
					$phude = 'Thuyết Minh';
				}else{
					$phude = 'Vietsub';
				}
			$url_phim = Url::get($film[$i][0],$title,'Phim');
			$episode = MySql::dbselect('id,name','episode',"filmid = '$filmid' order by id desc limit 1");
			$epname = $episode[0][1];
			$epnames = "<span class=\"promo-text\">Tập $epname | $phude</span>";

?>
<li class="widget-item"><a target="_blank" class="item-link" href="<?=$url_phim?>?utm_source=&utm_medium=referral&utm_campaign=iframeAd" title="<?=$title?> - <?=$title_en?>"><div class="item-image" style="background-image: url('<?=$thumb?>')"></div><div class="title-wrapper"><span class="title"><?=$title?></span><span class="english-title"><?=$title_en?></span></div></a><?=$epnames?></li>
<?}?>
</ul><span id="prev"><span class="prev-icon"></span></span><span id="next"><span class="next-icon"></span></span></div></body></html>
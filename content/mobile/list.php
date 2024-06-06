<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
$title_page = $name;
// Bộ lọc
parse_str(parse_url(Url::curRequestURL(),PHP_URL_QUERY), $filter);
if($filter['bycat'] || $filter['bycountry'] || $filter['byquality'] || $filter['byyear'] || $filter['bytype']) {
	if($filter['bycat']) {
		$catid =$filter['bycat'];
		$sql .= " AND category like '%,$catid,%'";
	}if ($filter['bycountry']) {
		$couid = $filter['bycountry'];
		$sql .= " AND country = '$couid'";
	}if ($filter['byquality']!="" && $filter['byquality']!="all") {
		$qualityid = $filter['byquality'];
		$sql .= " AND quality = '$qualityid'";
	}if ($filter['byyear']!="" && $filter['byyear']!="all") {
		$getyear = $filter['byyear'];
		$sql .= " AND year = '$getyear'";
	}if ($filter['bytype']!="" && $filter['bytype']!="all") {
		$gettype = $filter['bytype'];
		$sql .= " AND thuyetminh = '$gettype'";
	}if ($filter['byorder']) {
		$byorder = $filter['byorder'];
		if($byorder == 'timeupdate') $byorder = 'timeupdate';
		else if($byorder == 'year') $byorder = 'year';
		else if($byorder == 'title') $byorder = 'title';
		else if($byorder == 'viewed') $byorder = 'viewed';
		else $byorder = 'timeupdate';
	}
}
$orderby = 'ORDER BY '.$byorder.' DESC';
if(!$byorder) $orderby = 'ORDER BY timeupdate DESC';
if($geturl[3]) {
	$page = explode('-',$geturl[3]);
}
$page		= 	$page[1];
$num		= 	'40';
$num 		= 	intval($num);
$page 		= 	intval($page);
if (!$page) 	$page = 1;
$limit 		= 	($page-1)*$num;
if($limit<0) 	$limit=0;
$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.title_en,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film.quality,tb_film.year,tb_film.duration,tb_film.filmlb,tb_film.thuyetminh,tb_film.category,trailer','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql $orderby LIMIT $limit,$num");
$total = MySql::dbselect('tb_film.id','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql");
$allpage_site = get_allpage(count($total),$num,$page,$url_page.'page-');
?>
<div class="main-content main-category">

            <div class="content-kus" style="text-align: center; margin: 10px 0; padding: 15px;">
			<center style="padding-bottom:5px">
<script async defer src="//cdn.adpoints.media/production/ads/1139.js"></script>
</center>
	            </div>

            <!--category-->
            <div class="movies-list-wrap mlw-category">
                <div class="ml-title ml-title-page">
                    <span class="pull-left"><?php echo $title_page;?></span>
					<ul role="tablist" class="nav nav-tabs">
                       
                        <li><select name="cat" id="cat" class="filter">
						<option value="">Thể loại</option>
						<?php
						$cat = MySql::dbselect('id,name','category','id != 0');
						for($i=0;$i<count($cat);$i++) {
							$name = $cat[$i][1];						
							echo "<option value='".$cat[$i][0]."'>$name</option>";
						}
						?>
						</select>
						</li>
                        <li>
						<select name="country" id="country" class="filter">
						<option value="">Quốc gia</option>
						<?php
						$country = MySql::dbselect('id,name','country','id != 0');
						for($i=0;$i<count($country);$i++) {
							$name = $country[$i][1];						
							echo "<option value='".$country[$i][0]."'>$name</option>";
						}
						?>
						</select>
                        </li>
						 <li>
						<select name="year" id="year" class="filter">
						<option value="">Năm sản xuất</option>
						<?php
						for($i=0;$i<14;$i++) {
							$name = (2016-$i);
							
							echo "<option value='$name'>$name</option>";
						}
						?>
						</select>
                        </li>
						<li><button id="login-submit" type="submit" class="filters btn btn-block btn-success btn-approve" style="height:40px;margin-left:5px"> Lọc </button>
                        </li>
                       
                    </ul>
                    <div class="filter-toggle"><i class="fa fa-sort mr5"></i>Lọc phim</div>
                    <div class="clearfix"></div>
                </div>
                <div id="filter">
    <div class="filter-btn">
        <button onclick="filterMovies()" class="btn btn-lg btn-success">Lọc phim</button>
    </div>
    <div class="filter-content row">
        <div class="col-sm-2 fc-main">
            <span class="fc-title">Sort by</span>
            <ul class="fc-main-list">
                <li>
                    <a class="active" href="<?=SITE_URL?>/danh-sach/phim-moi/"><i
                            class="fa fa-clock-o mr5"></i>Mới nhất</a></li>
                <li>
                    <a class="" href="<?=SITE_URL?>/danh-sach/phim-xem-nhieu/"><i
                            class="fa fa-eye mr5"></i>Xem nhiều nhất</a></li>
               
              
            </ul>
        </div>
        <div class="col-sm-10">
            <div class="cs10-top">
			<div class="fc-filmtype">
                    <span class="fc-title">Film Type</span>
                    <ul class="fc-filmtype-list">
                        <li><label><input name="type" checked value="all" type="radio">
                                All</label>
                        </li>
                        <li><label><input name="type"  value="0"
                                          type="radio">
                                Phụ Đề</label></li>
                        <li><label><input name="type"  value="1"
                                          type="radio">
                                Thuyết Minh</label></li>
                    </ul>
                </div>
                 <div class="fc-quality">
                    <span class="fc-title">Quality</span>
                    <ul class="fc-quality-list">
                        <li><label><input name="quality" checked value="all"
                                          type="radio">
                                All</label></li>
                        <li><label><input name="quality"  value="hd"
                                          type="radio"> HD</label>
                        </li>
                        <li><label><input name="quality"  value="sd"
                                          type="radio"> SD</label>
                        </li>
                        <li><label><input name="quality"  value="cam"
                                          type="radio">
                                CAM</label></li>
                    </ul>
                </div>
               
            </div>
            <div class="clearfix"></div>
            <div class="fc-genre">
                <span class="fc-title">Genre</span>
                <ul class="fc-genre-list">
				<?php
				$arrs = MySql::dbselect('id,name','category','id != 0');
				for($i=0;$i<count($arrs);$i++) {
					$name = $arrs[$i][1];			

					echo '<li>
                                <label>
                                    <input class="genre-ids" value="'.$arrs[$i][0].'" name="genres[]"
                                           type="checkbox"> '.$name.'                                </label>
                            </li>';
				}
				?>
                        
                                        </ul>
            </div>
            <div class="clearfix"></div>
            <div class="fc-country">
                <span class="fc-title">Country</span>
                <ul class="fc-country-list">
				<?php
				$arrq = MySql::dbselect('id,name','country','id != 0');
				for($i=0;$i<count($arrq);$i++) {
					$name = $arrq[$i][1];
					echo '  <li>
                                <label>
                                    <input class="country-ids" value="'.$arrq[$i][0].'" name="countries[]"
                                           type="checkbox" > '.$name.'                                </label>
                            </li>';
				}
				?>
                                   
                                        </ul>
            </div>
            <div class="clearfix"></div>
            <div class="fc-release">
                <span class="fc-title">Release</span>
                <ul class="fc-release-list">
                    <li><label><input checked name="year" value="all" type="radio">
                            All</label></li>
                                            <li>
                            <label>
                                <input                                     value="2016" name="year"
                                    type="radio"> 2016                            </label>
                        </li>
                                            <li>
                            <label>
                                <input                                     value="2015" name="year"
                                    type="radio"> 2015                            </label>
                        </li>
                                            <li>
                            <label>
                                <input                                     value="2014" name="year"
                                    type="radio"> 2014                            </label>
                        </li>
                                            <li>
                            <label>
                                <input                                     value="2013" name="year"
                                    type="radio"> 2013                            </label>
                        </li>
                                            <li>
                            <label>
                                <input                                     value="2012" name="year"
                                    type="radio"> 2012                            </label>
                        </li>
                                        <li>
                        <label>
                            <input                                 name="year"
                                value="older-2012"
                                type="radio"> Older
                        </label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    function filterMovies() {
        var genres = [];
        var countries = [];
        $('.genre-ids:checked').each(function () {
            genres.push($(this).val());
        });
        $('.country-ids:checked').each(function () {
            countries.push($(this).val());
        });
        if (genres.length > 0) {
            genres = genres.join('-');
        } else {
            genres = '';
        }
        if (countries.length > 0) {
            countries = countries.join('-');
        } else {
            countries = '';
        }
        var year = $('input[name=year]:checked').val();
        var quality = $('input[name=quality]:checked').val();
        var type = $('input[name=type]:checked').val();
        var url = '<?=SITE_URL?>/danh-sach/phim-moi/?bycat=' + genres + '&bycountry=' + countries + '&byyear=' + year + '&byquality=' + quality +'&bytype=' + type;
        window.location.href = url;
    }
</script>
                <div id="list" class="movies-list movies-list-full">

		<?php 
			for($i=0;$i<count($arr);$i++) {
				$filmid = $arr[$i][0];
				$title = $arr[$i][1];
				$filmlb = $arr[$i][10];
				$title_en = $arr[$i][2];
				$quality = $arr[$i][7];
				$year = $arr[$i][8];
				$duration = $arr[$i][9];
				$thumb = $arr[$i][3];
				$thuyetminh = $arr[$i][11];
				$cat = $arr[$i][12];
				$content = CutName(RemoveHtml(UnHtmlChars($arr[$i][6])),220);
				$url = get_url($arr[$i][0],$title,'Phim');
				$episode = MySql::dbselect('id,name','episode',"filmid = '$filmid' order by id desc limit 1");
				$epname = $episode[0][1];
				if($thuyetminh == 1){
					$phude = 'TM';
				}else{
					$phude = 'Vi';
				}
				if($arr[$i][9]!=0){
					$type[$i] = 'phimbo';
				}
				if($arr[$i][9]!=0) { $epnames[$i] = "<span class=\"mli-eps\">EPS<i>". substr(abs((int) filter_var($epname, FILTER_SANITIZE_NUMBER_INT)),0,3)."</i> </span>";
				}

echo ' <div class="ml-item">
            <a href="'.$url.'"
               data-url="'.SITE_URL.'/ajax/movie_load_info/'.$filmid.'"
               class="ml-mask jt"
               title="'.$title.'">
                            '.$epnames[$i].'        
                
                <img data-original="'.$thumb.'" class="lazy thumb mli-thumb"
                     alt="'.$title.'">
                <span class="mli-info"><h2>'.$title.'</h2></span>
            </a>
        </div>';

}
if($id=='phimle'){
	$flb = 0;
}elseif($id=='phimbo'){
	$flb = 0;
}
		?>
			<script type="text/javascript">
			$(function() {
				$(".filters").click(function() {
				var cat = $("#cat").val();
				var country = $("#country").val();
				var year = $("#year").val();			
				var dataString = 'cat='+ cat + '&country=' + country + '&year=' + year + '&filmlb=<?=$id?>';
				$.ajax({
				type:"GET",				
				url: base_url+"ajax/get_filter_box/",
				data: dataString,
					success: function(e){
						$("#list").html(e);
					}
				});
				});
			});
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
                    <div class="clearfix"></div>
				<div id="pagination">
                    <nav>
					<?=$allpage_site?>
                    </nav>
                </div>
                </div>
                
            </div>
            <!--/category-->


        </div>
<?php
include View::TemplateView('footer');
?>
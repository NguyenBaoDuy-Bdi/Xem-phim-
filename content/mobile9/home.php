<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
?>
<div class="content">
<div class="content-heading">
 
</div>
<div class="content-inner">
<div class="container">
<div class="row" style="margin-top: 50px;">
<div class="col-lg-12 col-md-12">
<nav class="tab-nav tab-nav-alt" style="position: fixed;z-index: 30;background-color: #fff;left: 0px;top: 23px;">
<ul class="nav nav-justified">
<li class="active">
<a class="waves-color-alt waves-effect" data-toggle="tab" href="#fnRTNew">Phim Lẻ</a>
</li>
<li>
<a class="waves-color-alt waves-effect" data-toggle="tab" href="#fnRTDrama">Phim Bộ</a>
</li>
<li>
<a class="waves-color-alt waves-effect" data-toggle="tab" href="#fnRTHot">Phim Hot</a>
</li>
</ul>
</nav>
<div id="InPage_1441867501" style="text-align:center"> </div>
<script type="text/javascript">
var _abdm = _abdm || [];
/* load placement for account: hayphim, site: http://hayphim.tv, size: 300x250 - mobile, zone: in_page */
_abdm.push(["1441866203","InPage","1441867501","InPage_1441867501"]);
</script>
<script src="http://media.m.ambientplatform.vn/js/m_adnetwork.js" type="text/javascript"></script>
<noscript><a href="http://click.m.ambientplatform.vn/247/admServerNs/zid_1441867501/wid_1441866203/" target="_blank"><img src="http://delivery.m.ambientplatform.vn/247/mnoscript/zid_1441867501/wid_1441866203/" /></a></noscript>
<div class="tab-pane fade" id="fnRTHot">
<div class="card-wrap">
<div class="row">
<?php echo li_filmALL('xemnhieu',20);?>
</div>
</div>
</div>
<div class="tab-pane fade active in" id="fnRTNew">
<div id="InPage_1441867470" style="text-align:center"> </div>
<script type="text/javascript">
var _abdm = _abdm || [];
/* load placement for account: hayphim, site: http://hayphim.tv, size: 320x54 - mobile, zone: in_page */
_abdm.push(["1441866203","InPage","1441867470","InPage_1441867470"]);
</script>
<script src="http://media.m.ambientplatform.vn/js/m_adnetwork.js" type="text/javascript"></script>
<noscript><a href="http://click.m.ambientplatform.vn/247/admServerNs/zid_1441867470/wid_1441866203/" target="_blank"><img src="http://delivery.m.ambientplatform.vn/247/mnoscript/zid_1441867470/wid_1441866203/" /></a></noscript>
<div class="card-wrap">
<div class="row">
<?php echo li_filmALL('phimle',20);?>
</div>
</div>
</div>
<div class="tab-pane fade" id="fnRTDrama">
<div class="card-wrap">
<div class="row">
<?php echo li_filmALL('phimbo',20);?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
include View::TemplateView('footer');
?>
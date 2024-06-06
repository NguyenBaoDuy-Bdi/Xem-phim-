<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
?>
<div class="container">
        <div class="pad"></div>
        <div class="main-content main-detail">
            <div id="bread">
                <ol class="breadcrumb">
                    <li><a href="<?=SITE_URL?>/">Home</a></li>
                    <li class="active"><?php echo $title;?></li>
                </ol>
            </div>
<div class="infopage">
                <div class="infopage-head"><?php echo $title;?></div>
                <div class="content">

			<?php echo $content;?>
		</div>
            </div>
        </div>
    </div>
</div>

<?php
include View::TemplateView('footer');
?>
<?php
define('RK_MEDIA',true);
require('init.php');
include View::TemplateView('functions');
$filmid = $_REQUEST['filmid'];
$epid2 = $_REQUEST['epid'];
$films = MySql::dbselect('title','film',"id = '$filmid' AND active=1 order by id asc limit 1");
$filmname = $films[0][0];				
echo list_episode($filmid,$filmname,$epid2);
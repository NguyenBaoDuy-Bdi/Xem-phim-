<?php
define('RK_MEDIA',true);
require_once 'config.php';
$connect  = @mysql_connect(SERVER_HOST, DATABASE_USER, DATABASE_PASS, true);
$dataconnect = @mysql_select_db(DATABASE_NAME, $connect);
mysql_set_charset('latin1', $connect);
$keyword = $_REQUEST['keyword'];
$mq = mysql_query("SELECT * FROM articles
    WHERE MATCH (title,body) AGAINST ('~$keyword')",$connect);
while($row = @mysql_fetch_array($mq))
{
   echo $row['title'] . '<br>';
}
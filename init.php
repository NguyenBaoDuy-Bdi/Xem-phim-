<?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('RK_MEDIA')) die("You does have access to this!");
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start('ob_gzhandler');
else ob_start();
session_start();
header("Content-Type: text/html; charset=UTF-8");
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (!ini_get('register_globals')) {
        $superglobals = array($_SERVER,$_ENV,$_FILES,$_COOKIE,$_POST,$_GET);
    if (isset($_SESSION)) {
        array_unshift($superglobals, $_SESSION);
    }
    foreach ($superglobals as $superglobal) {
        extract($superglobal, EXTR_SKIP);
    }
    ini_set('register_globals', true);
}
define('RK_ROOT', dirname(__FILE__));
require_once RK_ROOT.'/config.php';
define('CACHE_PATH', RK_ROOT.'/content/cache/');
define('CACHE_TIME', 86400); // Thời gian cache lần tiếp theo
define('CACHE_EXT', '.vantoan'); // Đuôi file cache
define('TEMPLATE_PATH', RK_ROOT.'/content/template/');
define('TEMPLATE_URL', SITE_URL.'/content/template/');
define('TEMPLATE_M_PATH', RK_ROOT.'/content/mobile/');
define('TEMPLATE_M_URL', SITE_URL.'/content/mobile/');
define('UPLOAD_PATH', RK_ROOT.'/upload/');
define('UPLOAD_URL', SITE_URL.'/upload/');
define('ADMINCP_PATH', RK_ROOT.'/content/admincp/');
define('ADMINCP_URL', SITE_URL.'/content/admincp/');
define('MEMUPLOAD_PATH', RK_ROOT.'/content/uploads/');
define('MEMUPLOAD_URL', SITE_URL.'/content/uploads/');
define('ADMINCP_NAME', 'admin'); // Thư mục admincp
define('MEMBER_UPLOAD', 'uploads'); // Thư mục dang phim
define('s404_URL', SITE_URL.'/ann/404/'); // Trang thông báo lỗi
require_once RK_ROOT.'/include/lib/mysql.php';
require_once RK_ROOT.'/include/lib/functions.php';
define('IS_LOGIN', LoginAuth::isLogin());
define('IS_ADMIN', LoginAuth::isLoginADMIN());
define('IS_UPLOADER', LoginAuth::isLoginUPLOAD());

<?php
/*======================================================================*\
|| #################################################################### ||
|| #                This file is part of SafeGuard Pro                # ||
|| # ---------------------------------------------------------------- # ||
|| #     Copyright © 2014 - 2015 Gewora.net. All Rights Reserved.     # ||
|| # This file may not be redistributed in whole or significant part  # ||
|| #                                                                  # ||
|| #            For more license information contact Gewora           # ||
|| #            and/or read the envato license details at:            # ||
|| #                  http://codecanyon.net/licenses                  # ||
|| # You are NOT allowed to modify/remove this copyright information  # ||
|| #                                                                  # ||
|| #              Any infringement of this copyright will             # ||
|| #               result in legal action by the holder               # ||
|| #                                                                  # ||
|| # ----------     SafeGuard Pro IS NOT FREE SOFTWARE     ---------- # ||
|| # -------------------- http://www.gewora.net --------------------- # ||
|| #################################################################### ||
\*======================================================================*/

require_once '../includes/global.inc.php';
require_once '../includes/global_admin.inc.php';


if(ini_get('magic_quotes_gpc')) {
    $magic_quotes_gpc = TRUE;
} else {
    $magic_quotes_gpc = FALSE;
}

if(ini_get('magic_quotes_runtime')) {
    $magic_quotes_runtime = TRUE;
} else {
    $magic_quotes_runtime = FALSE;
}

if(ini_get('magic_quotes_sybase')) {
    $magic_quotes_sybase = TRUE;
} else {
    $magic_quotes_sybase = FALSE;
}

if(ini_get('expose_php')) {
    $expose_php = TRUE;
} else {
    $expose_php = FALSE;
}

if(ini_get('display_errors')) {
    $display_errors = TRUE;
} else {
    $display_errors = FALSE;
}

if(ini_get('display_startup_errors')) {
    $display_startup_errors = TRUE;
} else {
    $display_startup_errors = FALSE;
}

if(ini_get('register_globals')) {
    $register_globals = TRUE;
} else {
    $register_globals = FALSE;
}

if(ini_get('allow_url_fopen')) {
    $allow_url_fopen = TRUE;
} else {
    $allow_url_fopen = FALSE;
}

if(ini_get('allow_url_include')) {
    $allow_url_include = TRUE;
} else {
    $allow_url_include = FALSE;
}

if(ini_get('allow_url_fopen')) {
    $allow_url_fopen = TRUE;
} else {
    $allow_url_fopen = FALSE;
}

if(ini_get('exec')) {
    $exec = TRUE;
} else {
    $exec = FALSE;
}

if(ini_get('shell_exec')) {
    $shell_exec = TRUE;
} else {
    $shell_exec = FALSE;
}

if(ini_get('proc_open')) {
    $proc_open = TRUE;
} else {
    $proc_open = FALSE;
}






$params = array(
    'magic_quotes_gpc' => $magic_quotes_gpc,
    'magic_quotes_runtime' => $magic_quotes_runtime,
    'magic_quotes_sybase' => $magic_quotes_sybase,
    'expose_php' => $expose_php,
    'display_errors' => $display_errors,
    'display_startup_errors' => $display_startup_errors,
    'register_globals' => $register_globals,
    'allow_url_include' => $allow_url_include,
    'allow_url_fopen' => $allow_url_fopen,
    'exec' => $exec,
    'shell_exec' => $shell_exec,
    'proc_open' => $proc_open,
);

# Get the system information
$php_version = phpversion();
$mysql_version = $db->server_info;
$system = array('php_version' => $php_version, 'mysql_version' => $mysql_version, 'system_time' => date(DATE_RFC822));

if(isset($_POST['action']) && $_POST['action'] == 'ip') {
    die($_SERVER['SERVER_ADDR']);
}

# Render template
$template = $twig->loadTemplate('security_check.html.twig');
echo $template->render(array(
    'msg' => $msg,
    'system' => $system,
    'params' => $params,
    'config' => $config['application'],
));


?>
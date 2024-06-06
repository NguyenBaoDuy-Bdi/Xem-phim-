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

use Gewora\SafeGuardPro\Log;

# Fetch the stats
$log = new Log($config, $db);
$stats = $log->stats();

# Get the system information
$php_version = phpversion();
$mysql_version = $db->server_info;
$system = array('php_version' => $php_version, 'mysql_version' => $mysql_version, 'system_time' => date(DATE_RFC822));

if(isset($_POST['action']) && $_POST['action'] == 'ip') {
    die($_SERVER['SERVER_ADDR']);
}

# Render template
$template = $twig->loadTemplate('dashboard.html.twig');
echo $template->render(array(
    'msg' => $msg,
    'stats' => $stats,
    'system' => $system,
    'config' => $config['application'],
));


?>
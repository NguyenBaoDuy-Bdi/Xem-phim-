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

use Gewora\SafeGuardPro\Config;

# Fetch the config
$config_class = new Config($config, $db);
$config = $config_class->fetch();

# Should we update the config
if(isset($_POST['update'])) {
    foreach($_POST as $key => $value) {
        if(isset($config[$key])) {
            # If it is a valid config key
           $config_class->update($key, $value);
        }
    }
    $msg->add('s', '<strong>Success!</strong> The data has been successfully updated.', 'settings_protection.php');
}

# Render template
$template = $twig->loadTemplate('settings_protection.html.twig');
echo $template->render(array(
    'msg' => $msg,
    'config' => $config,
));

?>
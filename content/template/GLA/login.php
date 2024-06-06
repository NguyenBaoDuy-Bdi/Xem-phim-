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

require_once 'includes/global.inc.php';

use Gewora\SafeGuardPro\Session;
use Gewora\SafeGuardPro\Hash;

# Should we perform a login
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    # Hash the password
    $hash = new Hash();
    $password = $hash->sha512(trim($password), 3);

    # Check the login data
    $session_class = new Session($config, $db);
    $check = $session_class->start($db, $username, $password);
    if($check === TRUE) {
        header("Location: admincp/dashboard.php");
    } else {
        $msg->add('e', '<strong>Error!</strong> The entered data is incorrect.', 'login.php');
    }
} elseif(isset($_POST['action']) && $_POST['action'] == 'ip') {
    exit($_SERVER['SERVER_ADDR']);
}

# Render template
$template = $twig->loadTemplate('login.html.twig');
echo $template->render(array(
    'msg' => $msg,
));

?>
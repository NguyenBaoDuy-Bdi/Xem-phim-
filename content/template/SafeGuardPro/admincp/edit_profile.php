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

use Gewora\SafeGuardPro\Hash;
use Gewora\SafeGuardPro\User;

# Should we update the account settings
if(isset($_POST['update'])) {
    if(isset($_POST['username']) && !empty($_POST['username'])) {
        $user_class = new User($config, $db);
        $hash = new Hash();

        # Hash the password if a new one has been defined
        if(!empty($_POST['password1'])) {
            $password = $hash->sha512(trim($_POST['password1']), 3);
        } else {
            $password = NULL;
        }

        # Current user id
        $id = $_SESSION['gewora_safe_guard']['id'];

        $update = $user_class->update_general($id, $_POST['username'], $password);
        if($update === TRUE) {
            $_SESSION['gewora_safe_guard']['username'] = $_POST['username'];
            $msg->add('s', '<strong>Success!</strong> The data has been successfully updated.', 'edit_profile.php');
        }
    }
    $msg->add('w', '<strong>Warning!</strong> Nothing to update.', 'edit_profile.php');
}

# Render template
$template = $twig->loadTemplate('edit_profile.html.twig');
echo $template->render(array(
    'msg' => $msg,
));

?>